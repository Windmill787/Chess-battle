<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 27.02.17
 * Time: 11:54
 */

namespace frontend\components;

use app\models\Figure;

class BishopComponent extends FigureComponent
{
    public $name = 'bishop';

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
        $this->moveX = 1;
        $this->moveY = 1;
    }
}