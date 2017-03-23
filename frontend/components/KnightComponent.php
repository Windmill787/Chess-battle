<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:43
 */

namespace frontend\components;

use app\models\PlayPositions;
use app\models\Figure;

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
                parent::move();
                $this->savePosition();
            }
        } else if ($this->color == 'black') {
            if ($this->currentPositionX > 1 && $this->currentPositionY > 1) {
                parent::move();
                $this->savePosition();
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

    public function setMoves()
    {
        $this->moveX = 1;
        $this->moveY = 2;
    }
}