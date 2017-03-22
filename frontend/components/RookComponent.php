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
    public $moveX = 1;
    public $moveY = 0;

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move()
    {
        $this->currentPositionX = $this->currentPositionX + $this->moveX;
        $this->currentPositionY = $this->currentPositionY + $this->moveY;
        parent::move();
    }
}