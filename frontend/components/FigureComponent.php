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
        $this->status = $figure->status;
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
    }

    public function setMoves() {

    }

    public function setAttacks() {

    }

    public function savePosition($game_id) {
        $position = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => $this->id]);
        $position->figure_id = $this->id;
        $position->current_x = $this->currentPositionX;
        $position->current_y = $this->currentPositionY;
        $position->save();
    }

    public function attack($figure, $game_id) {
        $attackPosition = PlayPositions::findOne(['figure_id' => $figure->id]);
        $this->currentPositionX = $attackPosition->current_x;
        $this->currentPositionY = $attackPosition->current_y;
        $this->savePosition($game_id);
    }

    public function move($figureMoveX, $figureMoveY, $game_id) {
        $this->currentPositionX = $figureMoveX;
        $this->currentPositionY = $figureMoveY;
        $this->savePosition($game_id);
    }

    public function count() {

    }

    public function changeStatus(Figure $figure, $game_id) {
        $position = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => $figure->id]);
        $position->current_x = 0;
        $position->current_y = 0;
        $position->save();
        $figure->status = 'killed';
        $figure->save();
    }
}