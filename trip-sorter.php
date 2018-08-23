<?php

use TripSorter\MovableBuilder;

require  __DIR__ . '/vendor/autoload.php';

$cards = [];
try {
    $cards[] = (new MovableBuilder())->setFrom('Madrid')
        ->setTo('Barcelona')
        ->byAirplane()
        ->setSeat('44F')
        ->setFlightNumber('MAU113')
        ->setGate('F')
        ->build();
    $cards[] = (new MovableBuilder())->setFrom('Barcelona')
        ->setTo('Warsaw')
        ->byTrain()
        ->setSeat('23A')
        ->setTrainNumber('44')
        ->build();
    $cards[] = (new MovableBuilder())->setFrom('Astana')
        ->setTo('Madrid')
        ->byAirplane()
        ->setSeat('12')
        ->setFlightNumber('44')
        ->addBaggage('123')
        ->setGate('T2')
        ->build();
    $cards[] = (new MovableBuilder())->setFrom('Pavlodar')
        ->setTo('Astana')
        ->byBus()
        ->setSeat('1C')
        ->build();
} catch (MovableBuilder\IncorrectDataException $e) {}

$sorter = new \TripSorter\Sorter\Sorter();
$cards = $sorter->sortCards($cards);

/** @var \TripSorter\Movable $card */
foreach ($cards as $card) {
    echo $card . PHP_EOL;
}


class Horse extends \TripSorter\Movable
{
    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function display(): string
    {
        return 'Ride horse from ' . $this->from . ' to ' . $this->to . '.';
    }
}

class HorseBuilder implements MovableBuilder\Buildable
{
    private $from;
    private $to;

    public function setFrom(string $from): self
    {
        $obj = clone $this;
        $obj->from = $from;
        return $obj;
    }

    /**
     * @param string $to
     * @return MovableBuilder
     */
    public function setTo(string $to): self
    {
        $obj = clone $this;
        $obj->to = $to;
        return $obj;
    }

    public function build(): \TripSorter\Movable
    {
        return new Horse($this->from, $this->to);
    }
}

$card = (new HorseBuilder())
    ->setFrom('Morrowind')
    ->setTo('Oblivion')
    ->build();

$sorter = new \TripSorter\Sorter\Sorter();
$cards = $sorter->sortCards([$card]);

/** @var \TripSorter\Movable $card */
foreach ($cards as $card) {
    echo $card . PHP_EOL;
}