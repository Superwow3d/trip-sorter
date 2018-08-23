<?php

namespace tests\Model\Movable;

use PHPUnit\Framework\TestCase;
use TripSorter\Model\Movable\AirportBus;

class BusTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testPrint($from, $to, $seat, $result)
    {
        $bus = new AirportBus($from, $to, $seat);
        $this->assertSame($result, $bus->display());
    }

    public function dataProvider()
    {
        return [
            ['Madrid', 'Barcelona', '4B', 'Take the airport bus from Madrid to Barcelona. Sit in seat 4B'],
            ['Barcelona', 'Madrid', '', 'Take the airport bus from Barcelona to Madrid. No seat assignment']
        ];
    }
}