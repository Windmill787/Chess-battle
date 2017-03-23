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
        if ($this->color == 'white') {
            if ($this->currentPositionX && $this->currentPositionY < 8) {
                parent::move();
                $this->savePosition();
            }
        } else if ($this->color == 'black') {
            if ($this->currentPositionX && $this->currentPositionY > 1) {
                parent::move();
                $this->savePosition();
            }
        }
    }

    public function attack() {
        if ($this->color == 'white') {
                $square = PlayPositions::findOne([
                    'current_x' => $this->currentPositionX + $this->attackX,
                    'current_y' => $this->currentPositionY + $this->attackY
                ]);

                if (empty($square->figure_id) == false) {
                    $figure = Figure::findOne(['id' => $square->figure_id]);
                    $figure->status = 'killed';
                    $figure->save();
                    parent::attack();
                    $this->savePosition();
                }
        } else if ($this->color == 'black') {
            $square = PlayPositions::findOne([
                'current_x' => $this->currentPositionX - $this->attackX,
                'current_y' => $this->currentPositionY - $this->attackY
            ]);

            if (empty($square->figure_id) == false) {
                $figure = Figure::findOne(['id' => $square->figure_id]);
                $figure->status = 'killed';
                $figure->save();
                parent::attack();
                $this->savePosition();
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

    public function firstMove() {
        if ($this->color == 'white') {
            if ($this->currentPositionX == $this->startPositionX && $this->currentPositionY == $this->startPositionY) {
                $square = PlayPositions::findOne([
                    'current_x' => $this->currentPositionX + $this->moveX,
                    'current_y' => $this->currentPositionY + $this->moveY + 1
                ]);

                if (empty($square->figure_id)) {
                    $this->currentPositionX = $this->currentPositionX + $this->moveX;
                    $this->currentPositionY = $this->currentPositionY + $this->moveY + 1;
                    $this->savePosition();
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
                    $this->savePosition();
                }
            }
        }
    }
}