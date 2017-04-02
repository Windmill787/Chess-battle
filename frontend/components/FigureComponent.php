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

class FigureComponent implements FigureInterface
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

    public function __construct($color, $name, $number = null, $config = [])
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
        $this->getCurrentPositions($this->id);
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

    public function getCurrentPositions($figure_id) {
        $position = PlayPositions::findOne(['figure_id' => $figure_id]);
        $this->currentPositionX = $position->current_x;
        $this->currentPositionY = $position->current_y;
    }

    public function setMoves() {

    }

    public function setAttacks() {

    }

    public function savePosition() {
        $position = PlayPositions::findOne(['figure_id' => $this->id]);
        $position->figure_id = $this->id;
        $position->current_x = $this->currentPositionX;
        $position->current_y = $this->currentPositionY;
        $position->save();
    }

    public function attack($figure) {
        $attackPosition = PlayPositions::findOne(['figure_id' => $figure->id]);
        $this->currentPositionX = $attackPosition->current_x;
        $this->currentPositionY = $attackPosition->current_y;
        $this->savePosition();
    }

    public function move($figureMoveX, $figureMoveY) {
        $this->currentPositionX = $figureMoveX;
        $this->currentPositionY = $figureMoveY;
        $this->savePosition();
    }

    public function count() {

    }

    public function changeStatus(Figure $figure) {
        $position = PlayPositions::findOne(['figure_id' => $figure->id]);
        $position->current_x = 0;
        $position->current_y = 0;
        $position->save();
        $figure->status = 'killed';
        $figure->save();
    }


}