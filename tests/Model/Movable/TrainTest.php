<?php

namespace tests\Model\Movable;

use PHPUnit\Framework\TestCase;
use TripSorter\Model\Movable\Train;

class TrainTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testPrint($from, $to, $seat, $result)
    {
        $train = new Train($from, $to, $seat);
        $this->assertSame($result, $train->display());
    }

    public function dataProvider()
    {
        return [
            ['Madrid', 'Barcelona', '4B', 'Take train from Madrid to Barcelona. Sit in seat 4B'],
            ['Barcelona', 'Madrid', '', 'Take train from Barcelona to Madrid. No seat assignment']
        ];
    }
}