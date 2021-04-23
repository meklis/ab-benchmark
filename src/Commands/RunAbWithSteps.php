<?php


namespace Meklis\AB\Commands;


use Meklis\AB\AbRunner\Step;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RunAbWithSteps extends AbstractCommand
{
    function configure()
    {
        $this->setName("ab:load")
            ->addOption('concurrency', 'C', InputOption::VALUE_OPTIONAL , "Set list of concurencies","10,20,30,40,50")
            ->addOption("timeout", 'T', InputOption::VALUE_OPTIONAL, "Set timeout for iteration of cuncurencies", 0)
            ->addOption("number", 'N', InputOption::VALUE_OPTIONAL, "Number of requests", 0)
            ->addOption("format", 'f', InputOption::VALUE_OPTIONAL, "Type of output, variants: table|json|yaml|csv", 'table')
            ->addArgument('address', InputArgument::REQUIRED, "Address of page to testing");
    }

    function exec(InputInterface $input, OutputInterface $output)
    {
        $concurrency = $input->getOption('concurrency');
        $timeout = $input->getOption('timeout');
        $number = $input->getOption('number');
        $address = $input->getArgument('address');

        $steps = [];
        if(!is_array($concurrency)) {
            $concurrency = array_map(function ($e){return trim($e);}, explode(",", $concurrency));
        }
        foreach ($concurrency as $conc) {
            $step = new Step();
            if($timeout) {
                $step->setTime($timeout);
            }
            if($number) {
                $step->setCount($number);
            }
            $step->setConcurrency($conc);
            $steps[] = $step;
        }


        $runner = new \Meklis\AB\AbRunner\Runner();
        $result = $runner->setSteps($steps)->setAddress($address)->setConsoleOutput($output)->startBySteps($output->isVerbose());
        $result = array_map(function ($e){
            return $e->getAsArray();
        }, $result);
        switch ($input->getOption('format')) {
            case 'table': $this->toTable($result)->render(); return self::SUCCESS;
            case 'yaml': $output->writeln($this->toYaml($result)); return self::SUCCESS;
            case 'json': $output->writeln($this->toJson($result)); return self::SUCCESS;
            case 'csv':
                if(count($result) <= 0) return self::FAILURE;
                $output->writeln(join(";", array_keys($result[0])));
                foreach ($result as $res) {
                    $output->writeln(join(";", array_values(array_map(function ($e) {return str_replace(".", ",", (string)round($e, 2));},$res))));
                }
                return self::SUCCESS;
        }
        return  self::FAILURE;
    }

}