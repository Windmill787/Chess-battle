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
use yii\base\Component;

class FigureComponent extends Component implements FigureInterface
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
    public $moveX;
    public $moveY;
    public $attackX;
    public $attackY;

    public function setImage($color, $name) {
        $image = "/figureImages/".$color.ucfirst($name).".svg";
        return $image;
    }

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
        parent::__construct($config);
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

    public function setAttacks()
    {
        $this->attackX = $this->moveX;
        $this->attackY = $this->moveY;
    }

    public function savePosition() {
        $position = PlayPositions::findOne(['figure_id' => $this->id]);
        $position->figure_id = $this->id;
        $position->current_x = $this->currentPositionX;
        $position->current_y = $this->currentPositionY;
        $position->save();
    }

    public function attack()
    {
        if ($this->color == 'white') {
            $this->currentPositionX = $this->currentPositionX + $this->attackX;
            $this->currentPositionY = $this->currentPositionY + $this->attackY;
            $this->savePosition();
        } else if ($this->color == 'black') {
            $this->currentPositionX = $this->currentPositionX - $this->attackX;
            $this->currentPositionY = $this->currentPositionY - $this->attackY;
            $this->savePosition();
        }
    }

    public function move() {
        if ($this->color == 'white') {
            $this->currentPositionX = $this->currentPositionX + $this->moveX;
            $this->currentPositionY = $this->currentPositionY + $this->moveY;
            $this->savePosition();
        } else if ($this->color == 'black') {
            $this->currentPositionX = $this->currentPositionX - $this->moveX;
            $this->currentPositionY = $this->currentPositionY - $this->moveY;
            $this->savePosition();
        }
    }

    public function desiredAttackPosition() {
        if ($this->color == 'white') {
            $desiredPosition = PlayPositions::findOne([
                'current_x' => $this->currentPositionX + $this->attackX,
                'current_y' => $this->currentPositionY + $this->attackY
            ]);
            return $desiredPosition;
        } else if ($this->color == 'black') {
            $desiredPosition = PlayPositions::findOne([
                'current_x' => $this->currentPositionX - $this->attackX,
                'current_y' => $this->currentPositionY - $this->attackY
            ]);
            return $desiredPosition;
        }
    }

    public function desiredMovePosition() {
        if ($this->color == 'white') {
            $desiredPosition = PlayPositions::findOne([
                'current_x' => $this->currentPositionX + $this->moveX,
                'current_y' => $this->currentPositionY + $this->moveY
            ]);
            return $desiredPosition;
        } else if ($this->color == 'black') {
            $desiredPosition = PlayPositions::findOne([
                'current_x' => $this->currentPositionX - $this->moveX,
                'current_y' => $this->currentPositionY - $this->moveY
            ]);
            return $desiredPosition;
        }
    }

    public function changeStatus($desiredPosition) {
        $figure = Figure::findOne(['id' => $desiredPosition->figure_id]);
        $figure->status = 'killed';
        $figure->save();
    }


}