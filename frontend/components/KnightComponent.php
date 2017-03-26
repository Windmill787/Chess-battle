<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:43
 */

namespace frontend\components;

use app\models\Figure;

class KnightComponent extends FigureComponent
{
    public $name = 'knight';

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
        $this->moveX = [1, -1];
        $this->moveY = [2, -2];
    }

    public function setAttacks() {
        $this->attackX = $this->moveX;
        $this->attackY = $this->moveY;
    }
}