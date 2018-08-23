<?php

namespace TripSorter;

abstract class Movable
{
    protected $from;
    protected $to;

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    abstract function display(): string;
}