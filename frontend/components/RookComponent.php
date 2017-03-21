<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 27.02.17
 * Time: 11:54
 */

namespace frontend\components;


class RookComponent extends FigureComponent
{
    public $name = 'rook';
    public $count = 7;
    public $moveX = 0;
    public $moveY = 1;

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move()
    {
        $this->currentPositionX = $this->currentPositionX + $this->moveX;
        $this->currentPositionY = $this->currentPositionY + $this->moveY * $this->count;
        parent::move();
    }
}