<?php

namespace TripSorter\MovableBuilder;

use TripSorter\Movable;

class AirportBus implements Buildable
{
    private $from;
    private $to;
    private $seat;

    /**
     * AirportBus constructor.
     * @param null|string $from
     * @param null|string $to
     */
    public function __construct(?string $from, ?string $to)
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
     * @return Movable
     */
    public function build(): Movable
    {
        return new \TripSorter\Model\Movable\AirportBus($this->from, $this->to, $this->seat);
    }
}