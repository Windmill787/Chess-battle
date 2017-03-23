<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:43
 */

namespace frontend\components;

use app\models\PlayPositions;

class KnightComponent extends FigureComponent
{
    public $name = 'knight';
    public $attackX = 1;
    public $attackY = 2;

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move()
    {
        if ($this->color == 'white') {
            if ($this->currentPositionX < 8 && $this->currentPositionY < 8) {
                $this->currentPositionX = $this->currentPositionX + $this->moveX;
                $this->currentPositionY = $this->currentPositionY + $this->moveY;
                $this->savePosition();
            } else {
                $this->currentPositionX = $this->currentPositionX + 0;
                $this->currentPositionY = $this->currentPositionY + 0;
            }
        } else if ($this->color == 'black') {
            if ($this->currentPositionX > 1 && $this->currentPositionY > 1) {
                $this->currentPositionX = $this->currentPositionX - $this->moveX;
                $this->currentPositionY = $this->currentPositionY - $this->moveY;
                $this->savePosition();
            } else {
                $this->currentPositionX = $this->currentPositionX - 0;
                $this->currentPositionY = $this->currentPositionY - 0;
            }
        }
    }

    public function attack()
    {
        if ($this->color == 'white') {
            $square = PlayPositions::findOne([
                'current_x' => $this->currentPositionX + $this->attackX,
                'current_y' => $this->currentPositionY + $this->attackY
            ]);

            if (empty($square->figure_id) == false) {
                $this->currentPositionX = $this->currentPositionX + $this->attackX;
                $this->currentPositionY = $this->currentPositionY + $this->attackY;
                $this->savePosition();
            }
        } else if ($this->color == 'black') {
            $square = PlayPositions::findOne([
                'current_x' => $this->currentPositionX - $this->attackX,
                'current_y' => $this->currentPositionY - $this->attackY
            ]);

            if (empty($square->figure_id) == false) {
                $this->currentPositionX = $this->currentPositionX - $this->attackX;
                $this->currentPositionY = $this->currentPositionY - $this->attackY;
                $this->savePosition();
            }
        }
    }

    public function setMoves()
    {
        $this->moveX = 1;
        $this->moveY = 2;
    }
}