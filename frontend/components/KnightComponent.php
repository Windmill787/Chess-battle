<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:43
 */

namespace frontend\components;

use app\models\Figure;
use app\models\Moves;

class KnightComponent extends FigureComponent
{
    public $name = 'knight';

    public function __construct($color, $number = null, $game_id, $config = [])
    {
        parent::__construct($color, $this->name, $number, $game_id, $config);
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
}