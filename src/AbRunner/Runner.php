<?php


namespace Meklis\AB\AbRunner;


use Meklis\AB\AbParser\AbParser;
use Meklis\AB\AbParser\AbResult;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Runner
{
    /**
     * @var string
     */
    protected $address;

    /**
     * @var Step[]
     */
    protected $steps;
    /**
     * @var ConsoleOutputInterface
     */
    protected $output;

    function __construct($output = null)
    {
        if ($output) {
            $this->output = $output;
        }
    }
    function setConsoleOutput(OutputInterface $output) {
        $this->output = $output;
        return $this;
    }

    /**
     * @param Step[] $steps
     * @return $this
     */
    function setSteps($steps, $printDebug = true)
    {
        $this->steps = $steps;
        if ($this->output && $printDebug) {
            foreach ($this->steps as $step) {
                $this->output->writeln("Added step with concurency {$step->getConcurrency()} and count {$step->getCount()}");
            }
        }
        return $this;
    }

    function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param bool $printOutput
     * @return AbResult[]
     * @throws \Exception
     */
    function startBySteps($printOutput = true)
    {
        $responses = [];
        foreach ($this->steps as $step) {
            if ($this->output && $printOutput) {
                $this->output->writeln("");
                $this->output->writeln("Start step ". json_encode($step->getAsArray()));
            }
            $response = $this->run($this->address, $step->getConcurrency(), $step->getCount(), $step->getTime());
            if ($this->output && $printOutput) {
                $this->output->writeln("Step ". json_encode($step->getAsArray())." test finished with time {$response->getTestTime()}");
                $this->output->writeln("\tCompletedRequests:\t{$response->getCountRequests()}");
                $this->output->writeln("\tConcurrencyLevel:\t{$response->getConcurrency()}");
                $this->output->writeln("\tRPS:\t{$response->getRps()} req/sec");
                $this->output->writeln("\tErrors:\t{$response->getErrors()}");
                $this->output->writeln("\tTransferRate:\t{$response->getTransferRate()} kbytes/sec received");
                $this->output->writeln("\tTimePerRequest:\t{$response->getTimePerRequest()} ms");
                $this->output->writeln("\tTotal min/avg/max:\t{$response->getTotalMin()}/{$response->getTotalAvg()}/{$response->getTotalMax()} ms");
                $this->output->writeln("\tWaiting min/avg/max:\t{$response->getWaitingMin()}/{$response->getWaitingAvg()}/{$response->getWaitingMax()} ms");
            }
            $responses[] = $response;
        }
        return $responses;
    }


    /**
     * @param $address
     * @param $concurrency
     * @param int $count
     * @param int $time
     * @return \Meklis\AB\AbParser\AbResult
     * @throws \Exception
     */
    protected function run($address, $concurrency, $count = 0, $time = 0)
    {
        $arguments = "";
        if($count) {
            $arguments .= " -n {$count}";
        }
        if($time) {
            $arguments .= " -t {$time}";
        }
        if (!$code = exec("/usr/bin/ab -c {$concurrency} {$arguments} \"{$address}\" 2>&1", $output)) {
            throw new \Exception(join("\n", $output), $code);
        }
        return (new AbParser())->parse(join("\n", $output));
    }
}