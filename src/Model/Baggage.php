<?php

namespace TripSorter\Model;


use TripSorter\iDisplayable;

class Baggage implements iDisplayable
{
    private $number;

    /**
     * Baggage constructor.
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @inheritdoc
     */
    public function display(): string
    {
        return 'Baggage drop at ticket counter ' . $this->number;
    }
}