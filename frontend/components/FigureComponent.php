<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 20.02.17
 * Time: 19:49
 */

namespace frontend\components;

use app\models\Chessboard;
use app\models\Figure;
use app\models\History;
use app\models\Moves;
use app\models\PlayPositions;
use frontend\interfaces\FigureInterface;

class FigureComponent
{
    public $id;
    public $color;
    public $name;
    public $image;
    public $number;
    public $status;
    public $startPositionX;
    public $startPositionY;
    public $currentPositionX;
    public $currentPositionY;
    public $moves = [];
    public $attacks = [];
    public $alreadyMoved;

    public function __construct($color, $name, $number = null, $game_id, $config = [])
    {
        $figure = Figure::findOne(['color' => $color,'name' => $name,'number' => $number]);
        $this->id = $figure->id;
        $this->name = $figure->name;
        $this->color = $figure->color;
        $this->number = $figure->number;
        $this->setStartPositions($figure->start_position);
        $this->setMoves();
        $this->setAttacks();
        $this->setCurrentPositions($this->id, $game_id);
        $this->image = $this->setImage($color, $name);
    }

    public function setImage($color, $name) {
        $image = "/figureImages/".$color.ucfirst($name).".svg";
        return $image;
    }
    public function setStartPositions($id) {
        $position = Chessboard::findOne(['id' => $id]);
        $this->startPositionX = $position->x;
        $this->startPositionY = $position->y;
    }

    public function setCurrentPositions($figure_id, $game_id) {
        $position = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => $figure_id]);
        $this->currentPositionX = $position->current_x;
        $this->currentPositionY = $position->current_y;
        $this->alreadyMoved = $position->already_moved;
        $this->status = $position->status;
    }

    public function setMoves() {
        $allMoves = Moves::findOne(['figure_id' => $this->id]);
        $this->moves = unserialize($allMoves->move);
    }

    public function setAttacks() {
        $this->attacks = $this->moves;
    }

    public static function killFigureOn(PlayPositions $figure) {
        $figure->current_x = 0;
        $figure->current_y = 0;
        $figure->status = 'killed';
        $figure->save();
    }

    public static function saveInHistory(PlayPositions $playPosition, $moveX, $moveY) {
        $history = new History();
        $history->game_id = $playPosition->game_id;
        $history->figure_id = $playPosition->figure_id;
        $history->from_x = $playPosition->current_x;
        $history->from_y = $playPosition->current_y;
        $history->to_x = $moveX;
        $history->to_y = $moveY;
        $history->save();
    }
}