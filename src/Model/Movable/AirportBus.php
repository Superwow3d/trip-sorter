<?php

namespace TripSorter\Model\Movable;

use TripSorter\Movable;

class AirportBus extends Movable
{
    private $seat;

    /**
     * Bus constructor.
     * @param string $from
     * @param string $to
     * @param string $seat
     */
    public function __construct(string $from, string $to, string $seat = '')
    {
        $this->from = $from;
        $this->to = $to;
        $this->seat = $seat;
    }

    /**
     * @inheritdoc
     */
    public function display(): string
    {
        return 'Take the airport bus from ' . $this->from . ' to ' . $this->to . '.' .
            ($this->seat !== '' ? ' Sit in seat ' . $this->seat : ' No seat assignment');
    }
}