<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 27.02.17
 * Time: 11:54
 */

namespace frontend\components;

use app\models\PlayPositions;

class BishopComponent extends FigureComponent
{
    public $name = 'bishop';
    public $moveX = 1;
    public $moveY = 1;

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move()
    {
        if ($this->currentPositionX < 8 && $this->currentPositionY < 8) {
            $this->currentPositionX = $this->currentPositionX + $this->moveX;
            $this->currentPositionY = $this->currentPositionY + $this->moveY;
            parent::move();
        }
    }
}