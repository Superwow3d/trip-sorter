<?php

namespace TripSorter\MovableBuilder;

use TripSorter\Movable;

class Train implements Buildable
{
    private $from;
    private $to;
    private $seat;
    private $trainNumber;

    /**
     * Train constructor.
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
     * @return Movable
     * @throws IncorrectDataException
     */
    public function build(): Movable
    {
        if (is_null($this->from) || is_null($this->to) || is_null($this->trainNumber)) {
            throw new IncorrectDataException('Invalid data');
        }
        return new \TripSorter\Model\Movable\Train($this->from, $this->to, $this->seat);
    }
}