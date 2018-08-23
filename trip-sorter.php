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
        ->setSeat('12')
        ->setFlightNumber('44')
        ->addBaggage('123')
        ->setGate('T2')
        ->build();
    $builder = new MovableBuilder();
    $cards[] = $builder->setFrom('Pavlodar')
        ->setTo('Astana')
        ->byTrain()
        ->setSeat('1C')
        ->setTrainNumber('44')
        ->build();
} catch (MovableBuilder\IncorrectDataException $e) {}

$sorter = new \TripSorter\Sorter\Sorter();
$cards = $sorter->sortCards($cards);

/** @var \TripSorter\Movable $card */
foreach ($cards as $card) {
    echo $card . PHP_EOL;
}
