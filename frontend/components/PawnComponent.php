<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:42
 */

namespace frontend\components;

use app\models\Figure;
use app\models\PlayPositions;

class PawnComponent extends FigureComponent
{
    public $name = 'pawn';
    public $availableMoves = 2;

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move()
    {
        $square = PlayPositions::findOne([
            'current_x' => $this->currentPositionX + $this->moveX,
            'current_y' => $this->currentPositionY + $this->moveY
        ]);

        if (empty($square->figure_id)) {

            if ($this->currentPositionX == $this->startPositionX && $this->currentPositionY == $this->startPositionY) {
                $this->currentPositionX = $this->currentPositionX + $this->moveX;
                $this->currentPositionY = $this->currentPositionY + $this->moveY + 1;
                parent::move();
            } else if ($this->currentPositionX && $this->currentPositionY < 8) {
                $this->currentPositionX = $this->currentPositionX + $this->moveX;
                $this->currentPositionY = $this->currentPositionY + $this->moveY;
                parent::move();
            } else {
                $whiteQueen = new QueenComponent('white');
                $this->name = $whiteQueen->name;
                $this->color = $whiteQueen->color;
            }
        }
    }

    public function setMoves() {
        $this->moveX = 0;
        $this->moveY = 1;
    }
}