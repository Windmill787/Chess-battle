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

class KingComponent extends FigureComponent
{
    public $name = 'king';
    public $castlingMove = [];

    public function __construct($color, $game_id, $config = [])
    {
        parent::__construct($color, $this->name, null, $game_id, $config);
        $this->setCastling();
    }

    public function castling($figureMoveX, $figureMoveY, $game_id) {
        parent::move($figureMoveX, $figureMoveY, $game_id);
    }

    public function move($figureMoveX, $figureMoveY, $game_id) {
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

    public function setCastling() {
        $allMoves = Moves::findOne(['figure_id' => $this->id]);
        $this->castlingMove = unserialize($allMoves->first_move);
    }
}