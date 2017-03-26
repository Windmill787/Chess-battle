<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 27.02.17
 * Time: 11:54
 */

namespace frontend\components;

use app\models\Figure;

class QueenComponent extends FigureComponent
{
    public $name = 'queen';

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }

    public function move($figureMoveX, $figureMoveY) {
        parent::move($figureMoveX, $figureMoveY);
    }

    public function attack($id) {
        $figure = Figure::findOne(['id' => $id]);
        if ($figure->status == 'active' && $figure->color != $this->color) {
            parent::attack($figure);
            parent::changeStatus($figure);
        }
    }

    public function setMoves() {
        $this->moveX = [0, 1, -1];
        $this->moveY = [0, 1, -1];
    }

    public function setAttacks()
    {
        $this->attackX = $this->moveX;
        $this->attackX = $this->moveX;
    }
}