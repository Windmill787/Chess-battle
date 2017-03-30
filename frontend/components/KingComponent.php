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

class KingComponent extends FigureComponent
{
    public $name = 'king';
    public $castlingMove = [];

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
        $this->setCastling();
    }

    public function castling($figureMoveX, $figureMoveY) {
        parent::move($figureMoveX, $figureMoveY);
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