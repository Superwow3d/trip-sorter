<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 23/08/2018
 * Time: 21:58
 */

namespace TripSorter\MovableBuilder;

use TripSorter\Movable;

interface Buildable
{
    public function build(): Movable;
}