<?php

namespace TripSorter\MovableBuilder;

class Train
{
    private $seat;
    private $trainNumber;

    /**
     * Train constructor.
     * @param string $from
     * @param string $to
     */
    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->seat = '';
    }

    /**
     * @param string $trainNumber
     * @return Train
     */
    public function setTrainNumber(string $trainNumber): self
    {
        $obj = clone $this;
        $obj->trainNumber = $trainNumber;
        return $obj;
    }

    /**
     * @param string $seat
     * @return Train
     */
    public function setSeat(string $seat): self
    {
        $obj = clone $this;
        $obj->seat = $seat;
        return $obj;
    }

    /**
     * @return \TripSorter\Model\Movable\Train
     */
    public function build(): \TripSorter\Model\Movable\Train
    {
        return new \TripSorter\Model\Movable\Train($this->from, $this->to, $this->seat);
    }
}