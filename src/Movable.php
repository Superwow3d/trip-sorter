<?php

namespace TripSorter;

abstract class Movable
{
    protected $from;
    protected $to;

    abstract public function output();
}