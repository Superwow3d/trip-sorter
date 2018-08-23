<?php

namespace tests\Model\Movable;

use PHPUnit\Framework\TestCase;
use TripSorter\Model\Movable\Airplane;

class AirplaneTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testPrint($from, $to, $flightNumber, $seat, $gate, $baggage, $result)
    {
        $airplane = new Airplane($from, $to, $flightNumber, $gate, $seat);
        $airplane->addBaggage($baggage);
        $this->assertSame($result, $airplane->display());
    }

    public function dataProvider()
    {
        return [
            ['Madrid', 'Barcelona', '234SS', '4A', 'F', '345', 'From Madrid, take flight 234SS to Barcelona. Gate F, seat 4A. Baggage drop at ticket counter 345. '],
            ['Barcelona', 'Madrid', '234SS', '4A', 'F', '', 'From Barcelona, take flight 234SS to Madrid. Gate F, seat 4A.'],
        ];
    }
}