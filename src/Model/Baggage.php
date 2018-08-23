<?php

namespace TripSorter\Model;


class Baggage
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
        return 'Baggage drop at ticket counter ' . $this->number . '. ';
    }
}