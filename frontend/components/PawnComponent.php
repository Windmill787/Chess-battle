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

    public function __construct($color, $number = null, $game_id, $config = []) {
        parent::__construct($color, $this->name, $number, $game_id, $config);
        $this->setFirstMove();
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