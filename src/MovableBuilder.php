<?php

namespace TripSorter;

use TripSorter\MovableBuilder\Airplane;
use TripSorter\MovableBuilder\AirportBus;
use TripSorter\MovableBuilder\Train;

class MovableBuilder
{
    protected $from;
    protected $to;

    /**
     * @param string $from
     * @return MovableBuilder
     */
    public function setFrom(string $from): self
    {
        $obj = clone $this;
        $obj->from = $from;
        return $obj;
    }

    /**
     * @param string $to
     * @return MovableBuilder
     */
    public function setTo(string $to): self
    {
        $obj = clone $this;
        $obj->to = $to;
        return $obj;
    }

    /**
     * @return AirportBus
     */
    public function byBus(): AirportBus
    {
        return new AirportBus($this->from, $this->to);
    }

    /**
     * @return Train
     */
    public function byTrain(): Train
    {
        return new Train($this->from, $this->to);
    }

    /**
     * @return Airplane
     */
    public function byAirplane(): Airplane
    {
        return new Airplane($this->from, $this->to);
    }
}