<?php

use TripSorter\MovableBuilder;

require  __DIR__ . '/vendor/autoload.php';

$cards = [];
try {
    $builder = new MovableBuilder();
    $cards[] = $builder->setFrom('Madrid')
        ->setTo('Barcelona')
        ->byAirplane()
        ->setSeat('44F')
        ->setFlightNumber('MAU113')
        ->setGate('F')
        ->build();
    $cards[] = $builder->setFrom('Barcelona')
        ->setTo('Warsaw')
        ->byTrain()
        ->setSeat('23A')
        ->setTrainNumber('44')
        ->build();
    $cards[] = $builder->setFrom('Astana')
        ->setTo('Madrid')
        ->byAirplane()
        ->setSeat('12')
        ->setFlightNumber('44')
        ->addBaggage('123')
        ->setGate('T2')
        ->build();
    $cards[] = $builder->setFrom('Pavlodar')
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
