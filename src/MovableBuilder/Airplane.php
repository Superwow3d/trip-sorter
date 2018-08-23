<?php

namespace TripSorter\MovableBuilder;

class Airplane
{
    private $from;
    private $to;
    private $seat;
    private $flightNumber;
    protected $gate;
    protected $baggage;

    /**
     * Airplane constructor.
     * @param string $from
     * @param string $to
     */
    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->baggage = [];
        $this->seat = '';
    }

    /**
     * @param string $flightNumber
     * @return Airplane
     */
    public function setFlightNumber(string $flightNumber): self
    {
        $obj = clone $this;
        $obj->flightNumber = $flightNumber;
        return $obj;
    }

    /**
     * @param string $gate
     * @return Airplane
     */
    public function setGate(string $gate): self
    {
        $obj = clone $this;
        $obj->gate = $gate;
        return $obj;
    }

    /**
     * @param $number
     * @return Airplane
     */
    public function addBaggage($number): self
    {
        $obj = clone $this;
        $this->baggage[] = $number;
        return $obj;
    }

    /**
     * @param string $seat
     * @return Airplane
     */
    public function setSeat(string $seat): self
    {
        $obj = clone $this;
        $obj->seat = $seat;
        return $obj;
    }

    /**
     * @return \TripSorter\Model\Movable\Airplane
     */
    public function build(): \TripSorter\Model\Movable\Airplane
    {
        $airplane = new \TripSorter\Model\Movable\Airplane($this->from, $this->to, $this->flightNumber, $this->gate, $this->seat);
        foreach ($this->baggage as $baggage) {
            $airplane->addBaggage($baggage);
        }
        return $airplane;
    }
}