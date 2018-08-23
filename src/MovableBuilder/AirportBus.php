<?php

namespace TripSorter\MovableBuilder;

class AirportBus
{
    private $seat;

    /**
     * AirportBus constructor.
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
     * @param string $seat
     * @return AirportBus
     */
    public function setSeat(string $seat): self
    {
        $obj = clone $this;
        $obj->seat = $seat;
        return $obj;
    }

    /**
     * @return \TripSorter\Model\Movable\AirportBus
     */
    public function build(): \TripSorter\Model\Movable\AirportBus
    {
        return new \TripSorter\Model\Movable\AirportBus($this->from, $this->to, $this->seat);
    }
}