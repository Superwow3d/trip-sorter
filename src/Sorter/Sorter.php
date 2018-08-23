<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 23/08/2018
 * Time: 13:09
 */

namespace TripSorter\Sorter;

use TripSorter\Movable;

class Sorter
{
    /**
     * @var Movable[]
     */
    private $cards;

    private $fromArray;
    private $toArray;

    private $start;
    private $end;

    /**
     * @param Movable[] $cards
     * @throws InvalidCardException
     */
    private function init($cards)
    {
        $this->fromArray = [];
        $this->toArray = [];
        if (count($cards) === 0) {
            throw new InvalidCardException('Trip is empty');
        }
        foreach ($cards as $card) {
            $key = $card->getFrom();
            if (isset($this->cards[$key])) {
                throw new InvalidCardException('Double start point error');
            }
            $this->cards[$key] = $card;
            $this->fromArray[] = $card->getFrom();
            $this->toArray[] = $card->getTo();
        }

        $checkArray = array_unique($this->toArray);
        if (count($checkArray) !== count($this->toArray)) {
            throw new InvalidCardException('Double end point error');
        }

        $startPoints = array_diff($this->fromArray, $this->toArray);

        if (count($startPoints) === 0) { // The same array
            throw new InvalidCardException('Trip is looped');
        }

        $endPoints = array_diff($this->toArray, $this->fromArray);

        if (count($startPoints) !== 1 && count($endPoints) !== 1) {
            throw new InvalidCardException('Break in trip');
        }

        $this->start = array_shift($startPoints);
        $this->end = array_shift($endPoints);
    }

    private function sort()
    {
        $sortedArray = [];
        $next = $this->start;
        while ($next !== $this->end) {
            $sortedArray[] = $this->cards[$next];
            $next = $this->cards[$next]->getTo();
        }

        $this->cards = $sortedArray;
    }

    private function output()
    {
        $counter = 0;
        $output = [];
        foreach ($this->cards as $card) {
            $counter++;
            $output[] = $counter . '. ' . $card->display();
        }

        $counter++;
        $output[] = $counter . '. ' . 'You have arrived at your final destination';

        return $output;
    }

    /**
     * @param Movable[] $cards
     * @return string[]
     */
    public function sortCards(array $cards): array
    {
        try {
            $this->init($cards);
        } catch (InvalidCardException $e) {
            return [$e->getMessage()];
        }

        $this->sort();
        return $this->output();
    }
}