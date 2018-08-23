<?php

namespace tests\Model;


use PHPUnit\Framework\TestCase;
use TripSorter\Model\Baggage;

class BaggageTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testOutput($number, $result)
    {
        $baggage = new Baggage($number);
        $this->assertSame($result, $baggage->display());
    }

    public function dataProvider()
    {
        return [
            ['123', 'Baggage drop at ticket counter 123. '],
            ['AAA', 'Baggage drop at ticket counter AAA. ']
        ];
    }
}