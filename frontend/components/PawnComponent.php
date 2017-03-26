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
        $this->moveX = [0];
        $this->moveY = [1];
    }

    public function setAttacks() {
        $this->attackX = [-1, 1];
        $this->attackY = [1];
    }
}