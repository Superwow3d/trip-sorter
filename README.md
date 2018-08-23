# Trip Sorter

This package sorts a set of boarding passes containing information about the type of transport, 
departure point and destination. I suggested that the departure and destination points can not be repeated. 
Also, the journey can not be looped (the departure point coincides with the destination).

## Getting Started

It is possible to install package in composer "ajaminov/trip-sorter",
or just download repository.

### Installing

For download use

```
git clone https://github.com/Superwow3d/trip-sorter.git
```

Run 'composer install' in project root directory

```
composer install
```

After that you can test it

```
composer test
```
### Alternative

Run in terminal
```
composer require ajaminov/trip-sorter dev-master
```
Requires  php: >=7.0


## How to execute

As it was said earlier, you can install the package through the composer. 
But if you downloaded the repository, then just run the trip-sorter.php file via composer

```
composer execute
```


**TripSorter\MovableBuilder**

Set departure and destination points by methods **setFrom** and **setTo** respectively

Select transport with methods **byTrain** / **byAirplane** / **byBus** 

Set seat, transport number and other information. 

Method **build** will return you instance of **Movable** class (boarding pass).

Create as many as you like for boarding passes and sort it with method **sortCards** of **\TripSorter\Sorter\Sorter** class, which return array of string.

For example

```
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
```

This code will output next
```
1. Take the airport bus from Pavlodar to Astana. Sit in seat 1C
2. From Astana, take flight 44 to Madrid. Gate T2, seat 12. Baggage drop at ticket counter 123. 
3. From Madrid, take flight MAU113 to Barcelona. Gate F, seat 44F.
4. Take train from Barcelona to Warsaw. Sit in seat 23A
5. You have arrived at your final destination

```