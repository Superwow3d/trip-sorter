<?php

namespace TripSorter\Model\Movable;

use TripSorter\Model\Baggage;
use TripSorter\Movable;

class Airplane extends Movable
{
    private $flightNumber;
    private $seat;
    private $gate;
    /** @var Baggage[] */
    private $baggage;

    /**
     * Airplane constructor.
     * @param string $from
     * @param string $to
     * @param string $flightNumber
     * @param string $gate
     * @param string $seat
     */
    public function __construct(string $from, string $to, string $flightNumber, string $gate, string $seat)
    {
        $this->from = $from;
        $this->to = $to;
        $this->seat = $seat;
        $this->gate = $gate;
        $this->flightNumber = $flightNumber;
        $this->baggage = [];
    }

    /**
     * @param string $baggageNumber
     */
    public function addBaggage(string $baggageNumber)
    {
        if ($baggageNumber !== '') {
            $baggageModel = new Baggage($baggageNumber);
            array_push($this->baggage, $baggageModel);
        }
    }

    /**
     * @inheritdoc
     */
    public function display(): string
    {
        $baggageOutput = '';
        foreach ($this->baggage as $baggage) {
            $baggageOutput .= $baggage->display();
        }
        return 'From ' . $this->from . ', take flight ' . $this->flightNumber . ' to ' . $this->to . '. Gate ' . $this->gate . ', seat ' . $this->seat . '.' .
            ($baggageOutput === '' ? ' Baggage will be automatically transferred from you last leg' : ' ' . $baggageOutput);
    }
}