<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 23/08/2018
 * Time: 10:12
 */

namespace TripSorter\Model\Movable;

use TripSorter\iDisplayable;
use TripSorter\Movable;

class Train extends Movable implements iDisplayable
{
    private $seat;

    /**
     * Bus constructor.
     * @param string $from
     * @param string $to
     * @param string $seat
     */
    public function __construct(string $from, string $to, string $seat = '')
    {
        $this->from = $from;
        $this->to = $to;
        $this->seat = $seat;
    }

    /**
     * @inheritdoc
     */
    public function display(): string
    {
        return 'Take train from ' . $this->from . ' to ' . $this->to . '.' .
            ($this->seat !== '' ? ' Sit in seat ' . $this->seat : ' No seat assignment');
    }
}