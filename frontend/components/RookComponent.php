<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 27.02.17
 * Time: 11:54
 */

namespace frontend\components;

use app\models\Figure;
use app\models\Moves;
use app\models\PlayPositions;

class RookComponent extends FigureComponent
{
    public $name = 'rook';

    public function __construct($color, $number = null, $game_id, $config = [])
    {
        parent::__construct($color, $this->name, $number, $game_id, $config);
    }

    public function move($figureMoveX, $figureMoveY, $game_id) {
        $rook = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => $this->id]);
        if ($rook->already_moved == 0) {
            $rook->already_moved = 1;
            $rook->save();
        }
        parent::move($figureMoveX, $figureMoveY, $game_id);
    }

    public function attack($id, $game_id) {
        $figure = Figure::findOne(['id' => $id]);
        if ($figure->status == 'active' && $figure->color != $this->color) {
            parent::attack($figure, $game_id);
            parent::changeStatus($figure, $game_id);
        }
    }

    public function setMoves()
    {
        $allMoves = Moves::findOne(['figure_id' => $this->id]);
        $this->moves = unserialize($allMoves->move);
    }

    public function setAttacks()
    {
        $this->attacks = $this->moves;
    }
}