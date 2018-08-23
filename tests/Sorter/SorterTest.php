<?php

namespace tests\Sorter;

use PHPUnit\Framework\TestCase;
use TripSorter\MovableBuilder;
use TripSorter\Sorter\Sorter;

class SorterTest extends TestCase
{
    public function testSortCardsWithEmpty()
    {
        $sorter = new Sorter();
        $result = $sorter->sortCards([]);

        $this->assertSame(['Trip is empty'], $result);
    }

    public function testSortCardsWithDoubleStart()
    {
        $cards = [];
        try {
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Madrid')
                ->setTo('Barcelona')
                ->byAirplane()
                ->setSeat('23A')
                ->setFlightNumber('44')
                ->setGate('F')
                ->build();
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Madrid')
                ->setTo('Warsaw')
                ->byTrain()
                ->setSeat('23A')
                ->setTrainNumber('44')
                ->build();
        } catch (MovableBuilder\IncorrectDataException $e) {}

        $sorter = new Sorter();
        $result = $sorter->sortCards($cards);

        $this->assertSame(['Double start point error'], $result);
    }

    public function testSortCardsWithDoubleEnd()
    {
        $cards = [];
        try {
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Madrid')
                ->setTo('Barcelona')
                ->byAirplane()
                ->setSeat('23A')
                ->setFlightNumber('44')
                ->setGate('F')
                ->build();
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Warsaw')
                ->setTo('Barcelona')
                ->byTrain()
                ->setSeat('23A')
                ->setTrainNumber('44')
                ->build();
        } catch (MovableBuilder\IncorrectDataException $e) {}

        $sorter = new Sorter();
        $result = $sorter->sortCards($cards);

        $this->assertSame(['Double end point error'], $result);
    }

    public function testSortCardsIsLoop()
    {
        $cards = [];
        try {
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Madrid')
                ->setTo('Barcelona')
                ->byAirplane()
                ->setSeat('23A')
                ->setFlightNumber('44')
                ->setGate('F')
                ->build();
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Barcelona')
                ->setTo('Madrid')
                ->byTrain()
                ->setSeat('23A')
                ->setTrainNumber('44')
                ->build();
        } catch (MovableBuilder\IncorrectDataException $e) {}

        $sorter = new Sorter();
        $result = $sorter->sortCards($cards);

        $this->assertSame(['Trip is looped'], $result);
    }

    public function testSortCards()
    {
        $cards = [];
        try {
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Madrid')
                ->setTo('Barcelona')
                ->byAirplane()
                ->setSeat('23A')
                ->setFlightNumber('MAU113')
                ->setGate('F')
                ->build();
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Barcelona')
                ->setTo('Warsaw')
                ->byTrain()
                ->setSeat('23A')
                ->setTrainNumber('44')
                ->build();
        } catch (MovableBuilder\IncorrectDataException $e) {}

        $sorter = new Sorter();
        $result = $sorter->sortCards($cards);

        $expect = [
            'From Madrid, take flight MAU113 to Barcelona. Gate F, seat 23A.',
            'Take train from Barcelona to Warsaw. Sit in seat 23A',
            'You have arrived at your final destination'
        ];
        $this->assertSame($expect, $result);
    }

    public function testSortCardsWithOneCity()
    {
        $cards = [];
        try {
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Madrid')
                ->setTo('Barcelona')
                ->byAirplane()
                ->setSeat('23A')
                ->setFlightNumber('MAU113')
                ->setGate('F')
                ->build();
        } catch (MovableBuilder\IncorrectDataException $e) {}

        $sorter = new Sorter();
        $result = $sorter->sortCards($cards);

        $expect = [
            'From Madrid, take flight MAU113 to Barcelona. Gate F, seat 23A.',
            'You have arrived at your final destination'
        ];
        $this->assertSame($expect, $result);
    }

    public function testSortCardsManyCity()
    {
        $cards = [];
        try {
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Madrid')
                ->setTo('Barcelona')
                ->byAirplane()
                ->setSeat('23A')
                ->setFlightNumber('MAU113')
                ->setGate('F')
                ->build();
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Barcelona')
                ->setTo('Warsaw')
                ->byTrain()
                ->setSeat('23A')
                ->setTrainNumber('44')
                ->build();
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Astana')
                ->setTo('Madrid')
                ->byAirplane()
                ->setSeat('23A')
                ->setFlightNumber('44')
                ->addBaggage('123')
                ->addBaggage('13')
                ->setGate('T2')
                ->build();
            $builder = new MovableBuilder();
            $cards[] = $builder->setFrom('Pavlodar')
                ->setTo('Astana')
                ->byTrain()
                ->setSeat('23A')
                ->setTrainNumber('44')
                ->build();
        } catch (MovableBuilder\IncorrectDataException $e) {}

        $sorter = new Sorter();
        $result = $sorter->sortCards($cards);

        $expect = [
            'Take train from Pavlodar to Astana. Sit in seat 23A',
            'From Astana, take flight 44 to Madrid. Gate T2, seat 23A. Baggage drop at ticket counter 123. Baggage drop at ticket counter 13. ',
            'From Madrid, take flight MAU113 to Barcelona. Gate F, seat 23A.',
            'Take train from Barcelona to Warsaw. Sit in seat 23A',
            'You have arrived at your final destination',
        ];
        $this->assertSame($expect, $result);
    }
}