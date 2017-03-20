<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:42
 */

namespace frontend\components;

class PawnComponent extends FigureComponent
{
    public $name = 'pawn';

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move()
    {
        if ($this->currentPositionX && $this->currentPositionY < 8) {
            $this->currentPositionX = $this->currentPositionX + $this->moveX;
            $this->currentPositionY = $this->currentPositionY + $this->moveY;
            parent::move();
        } else {
            $this->currentPositionX = $this->currentPositionX + 0;
            $this->currentPositionY = $this->currentPositionY + 0;
        }
    }

    public function firstMove() {
        $this->currentPositionX = $this->currentPositionX + $this->moveX;
        $this->currentPositionY = $this->currentPositionY + $this->moveY + 1;
        parent::move();
    }
}