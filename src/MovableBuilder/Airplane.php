<?php

namespace TripSorter\MovableBuilder;

use TripSorter\Movable;

class Airplane implements Buildable
{
    private $from;
    private $to;
    private $seat;
    private $flightNumber;
    protected $gate;
    protected $baggage;

    /**
     * Airplane constructor.
     * @param null|string $from
     * @param null|string $to
     */
    public function __construct(?string $from, ?string $to)
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
        $obj->baggage[] = $number;
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
     * @return Movable
     * @throws IncorrectDataException
     */
    public function build(): Movable
    {
        if (is_null($this->from) || is_null($this->to) || is_null($this->flightNumber || is_null($this->gate))) {
            throw new IncorrectDataException('Invalid data');
        }

        $airplane = new \TripSorter\Model\Movable\Airplane($this->from, $this->to, $this->flightNumber, $this->gate, $this->seat);
        foreach ($this->baggage as $baggage) {
            $airplane->addBaggage($baggage);
        }
        return $airplane;
    }
}