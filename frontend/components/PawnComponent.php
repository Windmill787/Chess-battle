<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:42
 */

namespace frontend\components;

use app\models\PlayPositions;

class PawnComponent extends FigureComponent
{
    public $name = 'pawn';
    public $availableMoves = 2;
    public $attackX = 1;
    public $attackY = 1;

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move()
    {
        if ($this->color == 'white') {
            if ($this->currentPositionX && $this->currentPositionY < 8) {
                $this->currentPositionX = $this->currentPositionX + $this->moveX;
                $this->currentPositionY = $this->currentPositionY + $this->moveY;
                parent::move();
            }
        } else if ($this->color == 'black') {
            if ($this->currentPositionX && $this->currentPositionY > 1) {
                $this->currentPositionX = $this->currentPositionX - $this->moveX;
                $this->currentPositionY = $this->currentPositionY - $this->moveY;
                parent::move();
            }
        }
    }

    public function attack()
    {
        if ($this->color == 'white') {
            $this->currentPositionX = $this->currentPositionX + $this->attackX;
            $this->currentPositionY = $this->currentPositionY + $this->attackY;
            parent::move();
        } else if ($this->color == 'black') {
            $this->currentPositionX = $this->currentPositionX - $this->attackX;
            $this->currentPositionY = $this->currentPositionY - $this->attackY;
            parent::move();
        }
    }

    public function setMoves() {
        $this->moveX = 0;
        $this->moveY = 1;
    }

    public function firstMove()
    {
        if ($this->color == 'white') {
            if ($this->currentPositionX == $this->startPositionX && $this->currentPositionY == $this->startPositionY) {
                $square = PlayPositions::findOne([
                    'current_x' => $this->currentPositionX + $this->moveX,
                    'current_y' => $this->currentPositionY + $this->moveY + 1
                ]);

                if (empty($square->figure_id)) {
                    $this->currentPositionX = $this->currentPositionX + $this->moveX;
                    $this->currentPositionY = $this->currentPositionY + $this->moveY + 1;
                    parent::move();
                }
            }
        } else if ($this->color == 'black') {
            if ($this->currentPositionX == $this->startPositionX && $this->currentPositionY == $this->startPositionY) {
                $square = PlayPositions::findOne([
                    'current_x' => $this->currentPositionX - $this->moveX,
                    'current_y' => $this->currentPositionY - $this->moveY - 1
                ]);

                if (empty($square->figure_id)) {
                    $this->currentPositionX = $this->currentPositionX - $this->moveX;
                    $this->currentPositionY = $this->currentPositionY - $this->moveY - 1;
                    parent::move();
                }
            }
        }
    }
}