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

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move() {
        $desiredPosition = $this->desiredMovePosition();

        if (empty($desiredPosition->figure_id)) {
            parent::move();
        } else {
            $figure = Figure::findOne(['id' => $desiredPosition->figure_id]);
            if ($figure->status == 'killed') {
                parent::move();
            }
        }
    }

    public function attack() {
        $desiredPosition = $this->desiredAttackPosition();

        if (empty($desiredPosition->figure_id) == false) {
            $figure = Figure::findOne(['id' => $desiredPosition->figure_id]);
            if ($figure->status == 'active' && $figure->color != $this->color) {
                parent::changeStatus($figure);
                parent::attack();
            }
        }
    }

    public function setMoves() {
        $this->moveX = 0;
        $this->moveY = 1;
    }

    public function setAttacks() {
        $this->attackX = 1;
        $this->attackY = 1;
    }

    public function desiredFirstMovePosition() {
        if ($this->currentPositionX == $this->startPositionX && $this->currentPositionY == $this->startPositionY) {
            if ($this->color == 'white') {
                $desiredPosition = PlayPositions::findOne([
                    'current_x' => $this->currentPositionX + $this->moveX,
                    'current_y' => $this->currentPositionY + $this->moveY + 1
                ]);
                return $desiredPosition;
            } else if ($this->color == 'black') {
                $desiredPosition = PlayPositions::findOne([
                    'current_x' => $this->currentPositionX - $this->moveX,
                    'current_y' => $this->currentPositionY - $this->moveY - 1
                ]);
                return $desiredPosition;
            }
        }
    }

    public function firstMove() {
        $desiredPosition = $this->desiredFirstMovePosition();

        if ($this->color == 'white') {
            if (empty($desiredPosition->figure_id)) {
                $this->currentPositionX = $this->currentPositionX + $this->moveX;
                $this->currentPositionY = $this->currentPositionY + $this->moveY + 1;
                $this->savePosition();
            }
        } else if ($this->color == 'black') {
            if (empty($desiredPosition->figure_id)) {
                $this->currentPositionX = $this->currentPositionX - $this->moveX;
                $this->currentPositionY = $this->currentPositionY - $this->moveY - 1;
                $this->savePosition();
            }
        }
    }
}