<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:43
 */

namespace frontend\components;

class KnightComponent extends FigureComponent
{
    public $name = 'knight';

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move()
    {
        if ($this->currentPositionX && $this->currentPositionY < 7) {
            $this->currentPositionX = $this->currentPositionX + $this->moveX;
            $this->currentPositionY = $this->currentPositionY + $this->moveY;
            parent::move();
        } else {
            $this->currentPositionX = $this->currentPositionX + 0;
            $this->currentPositionY = $this->currentPositionY + 0;
        }
    }
}