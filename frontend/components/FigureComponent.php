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
use app\models\Move;
use app\models\PlayPositions;
use app\models\StartPosition;
use frontend\interfaces\FigureInterface;
use yii\base\Component;

class FigureComponent extends Component implements FigureInterface
{
    public $id;
    public $color;
    public $name;
    public $image;
    public $number;
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
        $this->setStartPositions($figure->start_position);
        $this->setMoves();
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

    public function move() {
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
            $this->move();
        } else if ($this->color == 'black') {
            $this->currentPositionX = $this->currentPositionX - $this->attackX;
            $this->currentPositionY = $this->currentPositionY - $this->attackY;
            $this->move();
        }
    }

    public function getMoves() {
        return [
            'X' => $this->moveX,
            'Y' => $this->moveY
        ];
    }
}