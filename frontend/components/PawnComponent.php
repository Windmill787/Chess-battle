<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:42
 */

namespace frontend\components;

use app\models\Figure;
use app\models\Moves;
use app\models\PlayPositions;

class PawnComponent extends FigureComponent
{
    public $name = 'pawn';
    public $first_move = [];

    public function __construct($color, $number = null, $config = []) {
        parent::__construct($color, $this->name, $number, $config);
        $this->setFirstMove();
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
        $allMoves = Moves::findOne(['figure_id' => $this->id]);
        $this->moves = unserialize($allMoves->move);
    }

    public function setAttacks() {
        $allMoves = Moves::findOne(['figure_id' => $this->id]);
        $this->attacks = unserialize($allMoves->attack);
    }

    public function setFirstMove() {
        $allMoves = Moves::findOne(['figure_id' => $this->id]);
        $this->first_move = unserialize($allMoves->first_move);
    }
}