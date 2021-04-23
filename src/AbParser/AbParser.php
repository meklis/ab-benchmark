<?php

namespace Meklis\AB\AbParser;

use Meklis\AB\AbParser\AbResult;

class AbParser
{
    function __construct()
    {
    }

    /**
     * @param $data
     * @return AbResult
     */
    function parse($data) {
       $lines = explode("\n", $data);
       $result = new AbResult();
       if(count($lines) <= 6) {
            throw new \Exception($lines[count($lines)-1]);
        }
       foreach ($lines as $lineNum=>$line) {
           if(preg_match('/^Concurrency Level:(.*)/', $line, $m)) {
               $result->setConcurrency((int)trim($m[1]));
           } elseif (preg_match('/^Complete requests:(.*)/', $line, $m)) {
               $result->setCountRequests((int)trim($m[1]));
           } elseif (preg_match('/^Failed requests:(.*)/', $line, $m)) {
               $result->setErrors((int)trim($m[1]));
           } elseif (preg_match('/^Time per request:(.*) \[ms\] \(mean\)/', $line, $m)) {
               $result->setTimePerRequest((float)trim($m[1]));
           } elseif (preg_match('/^Requests per second: (.*) \[#\/sec\] \(mean\)/', $line, $m)) {
               $result->setRps((float)trim($m[1]));
           } elseif (preg_match('/^Transfer rate:(.*) \[Kbytes\/sec\] received/', $line, $m)) {
               $result->setTransferRate((float)trim($m[1]));
           } elseif (preg_match('/^Time taken for tests: (.*) seconds/', $line, $m)) {
               $result->setTestTime((float)trim($m[1]));
           } elseif (preg_match('/^Total:.*? ([0-9].*?) ([0-9].*?) ([0-9].*?) ([0-9].*?) ([0-9].*)/', $line, $m)) {
               $result->setTotalMin((float)trim($m[1]));
               $result->setTotalAvg((float)trim($m[2]));
               $result->setTotalMax((float)trim($m[5]));
           } elseif (preg_match('/^Waiting:.*? ([0-9].*?) ([0-9].*?) ([0-9].*?) ([0-9].*?) ([0-9].*)/', $line, $m)) {
               $result->setWaitingMin((float)trim($m[1]));
               $result->setWaitingAvg((float)trim($m[2]));
               $result->setWaitingMax((float)trim($m[5]));
           }
       }
       return $result;
    }
}