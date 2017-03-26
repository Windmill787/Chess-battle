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
        $this->moveX = [1, -1];
        $this->moveY = [2, -2];
    }
}