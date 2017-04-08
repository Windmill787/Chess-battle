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
    public $check;

    public function __construct($color, $game_id, $config = [])
    {
        parent::__construct($color, $this->name, null, $game_id, $config);
        $this->setCastlingMove();
        $this->check = 0;
    }

    public function setCastlingMove() {
        $allMoves = Moves::findOne(['figure_id' => $this->id]);
        $this->castlingMove = unserialize($allMoves->first_move);
    }

    public function castling($figureMoveX, $figureMoveY, $rook, $castling,  $game_id) {
        $rookPosition = PlayPositions::findOne(['id' => $rook]);
        if ($castling == 2) {
            $rookPosition->current_x = $figureMoveX - 1;
            $rookPosition->current_y = $figureMoveY;
            $rookPosition->save();
        } else if ($castling == -2) {
            $rookPosition->current_x = $figureMoveX + 1;
            $rookPosition->current_y = $figureMoveY;
            $rookPosition->save();
        }
        parent::move($figureMoveX, $figureMoveY, $game_id);
    }

    public function move($figureMoveX, $figureMoveY, $game_id) {
        $king = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => $this->id]);
        if ($king->already_moved == 0) {
            $king->already_moved = 1;
            $king->save();
        }
        parent::move($figureMoveX, $figureMoveY, $game_id);
    }
}