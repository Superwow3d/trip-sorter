<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use TripSorter\Model\Movable\Airplane;
use TripSorter\Model\Movable\AirportBus;
use TripSorter\Model\Movable\Train;
use TripSorter\MovableBuilder;

class MovableBuilderTest extends TestCase
{
    public function testBusBuild()
    {
        $builder = new MovableBuilder();
        $card = $builder->setFrom('Madrid')
            ->setTo('Barcelona')
            ->byBus()
            ->setSeat('23A')
            ->build();

        $this->assertInstanceOf(AirportBus::class, $card);
    }

    public function testTrainBuild()
    {
        $card = (new MovableBuilder())->setFrom('Madrid')
            ->setTo('Barcelona')
            ->byTrain()
            ->setSeat('23A')
            ->setTrainNumber('44')
            ->build();

        $this->assertInstanceOf(Train::class, $card);
    }

    public function testAirplaneBuild()
    {
        $card = (new MovableBuilder())->setFrom('Madrid')
            ->setTo('Barcelona')
            ->byAirplane()
            ->setSeat('23A')
            ->setFlightNumber('44')
            ->setGate('F')
            ->build();

        $this->assertInstanceOf(Airplane::class, $card);
    }

    public function testAirplaneFailed()
    {
        $this->expectException(MovableBuilder\IncorrectDataException::class);

        $card = (new MovableBuilder())->byAirplane()
            ->build();
    }

    public function testTrainFailed()
    {
        $this->expectException(MovableBuilder\IncorrectDataException::class);

        $card = (new MovableBuilder())->byTrain()
            ->build();
    }
}