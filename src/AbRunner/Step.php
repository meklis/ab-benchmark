<?php


namespace Meklis\AB\AbRunner;


class Step
{
    protected $concurrency;
    protected $count;
    protected $time;


    public function getAsArray() {
        $resp = [];
        if($this->concurrency) {$resp['concurrency'] = $this->concurrency;}
        if($this->count) {$resp['count'] = $this->count;}
        if($this->time) {$resp['time'] = $this->time;}
        return $resp;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     * @return Step
     */
    public function setTime($time)
    {
        $this->time = $time;
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
     * @return Step
     */
    public function setConcurrency($concurrency)
    {
        $this->concurrency = $concurrency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     * @return Step
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }


}