<?php
namespace Meklis\AB\AbParser;


class AbResult
{
    protected $testTime;
    protected $countRequests;
    protected $rps;
    protected $transferRate;
    protected $waitingMin;
    protected $waitingAvg;
    protected $waitingMax;
    protected $totalAvg;
    protected $totalMax;
    protected $totalMin;
    protected $concurrency;
    protected $errors;
    protected $timePerRequest;

   function __construct()
   {
   }

    /**
     * @return mixed
     */
    public function getTestTime()
    {
        return $this->testTime;
    }

    /**
     * @param mixed $testTime
     * @return AbResult
     */
    public function setTestTime($testTime)
    {
        $this->testTime = $testTime;
        return $this;
    }



   function getAsArray() {
       return (array)[
           'test_time' => $this->testTime,
           'count_requests' => $this->countRequests,
           'rps' => $this->rps,
           'transfer_rate' => $this->transferRate,
           'waiting_min' => $this->waitingMin,
           'waiting_avg' => $this->waitingAvg,
           'waiting_max' => $this->waitingMax,
           'total_min' => $this->totalMin,
           'total_avg' => $this->totalAvg,
           'total_max' => $this->totalMax,
           'concurrency' => $this->concurrency,
           'time_per_request' => $this->timePerRequest,
           'errors' => $this->errors,
       ];
   }

    /**
     * @return mixed
     */
    public function getTimePerRequest()
    {
        return $this->timePerRequest;
    }

    /**
     * @param mixed $timePerRequest
     * @return AbResult
     */
    public function setTimePerRequest($timePerRequest)
    {
        $this->timePerRequest = $timePerRequest;
        return $this;
    }




    /**
     * @return mixed
     */
    public function getCountRequests()
    {
        return $this->countRequests;
    }

    /**
     * @param mixed $countRequests
     * @return AbResult
     */
    public function setCountRequests($countRequests)
    {
        $this->countRequests = $countRequests;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRps()
    {
        return $this->rps;
    }

    /**
     * @param mixed $rps
     * @return AbResult
     */
    public function setRps($rps)
    {
        $this->rps = $rps;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransferRate()
    {
        return $this->transferRate;
    }

    /**
     * @param mixed $transferRate
     * @return AbResult
     */
    public function setTransferRate($transferRate)
    {
        $this->transferRate = $transferRate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWaitingMin()
    {
        return $this->waitingMin;
    }

    /**
     * @param mixed $waitingMin
     * @return AbResult
     */
    public function setWaitingMin($waitingMin)
    {
        $this->waitingMin = $waitingMin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWaitingAvg()
    {
        return $this->waitingAvg;
    }

    /**
     * @param mixed $waitingAvg
     * @return AbResult
     */
    public function setWaitingAvg($waitingAvg)
    {
        $this->waitingAvg = $waitingAvg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWaitingMax()
    {
        return $this->waitingMax;
    }

    /**
     * @param mixed $waitingMax
     * @return AbResult
     */
    public function setWaitingMax($waitingMax)
    {
        $this->waitingMax = $waitingMax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalAvg()
    {
        return $this->totalAvg;
    }

    /**
     * @param mixed $totalAvg
     * @return AbResult
     */
    public function setTotalAvg($totalAvg)
    {
        $this->totalAvg = $totalAvg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalMax()
    {
        return $this->totalMax;
    }

    /**
     * @param mixed $totalMax
     * @return AbResult
     */
    public function setTotalMax($totalMax)
    {
        $this->totalMax = $totalMax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalMin()
    {
        return $this->totalMin;
    }

    /**
     * @param mixed $totalMin
     * @return AbResult
     */
    public function setTotalMin($totalMin)
    {
        $this->totalMin = $totalMin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConcurrency()
    {
        return $this->concurrency;
    }

    /**
     * @param mixed $concurrency
     * @return AbResult
     */
    public function setConcurrency($concurrency)
    {
        $this->concurrency = $concurrency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     * @return AbResult
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }


}