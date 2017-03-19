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
use app\models\StartPosition;
use frontend\interfaces\FigureInterface;
use yii\base\Component;

class FigureComponent extends Component implements FigureInterface
{
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

    public function setImage($color, $name) {
        $image = "/figureImages/".$color.ucfirst($name).".svg";
        return $image;
    }

    public function __construct($color, $name, $number = null, $config = [])
    {
        $figure = Figure::findOne(['color' => $color,'name' => $name,'number' => $number]);
        $this->name = $figure->name;
        $this->color = $figure->color;
        $this->number = $figure->number;
        $this->setStartPositions($figure->start_position);
        $this->setMoves($figure->id);
        $this->currentPositionX = $this->startPositionX;
        $this->currentPositionY = $this->startPositionY;
        $this->image = $this->setImage($color, $name);
        parent::__construct($config);
    }

    public function setStartPositions($id) {
        $startPosition = Chessboard::findOne(['id' => $id]);
        $this->startPositionX = $startPosition->x;
        $this->startPositionY = $startPosition->y;
    }

    public function setMoves($figure_id) {
        $move = Move::findOne(['figure_id' => $figure_id]);
        $this->moveX = $move->move_x;
        $this->moveY = $move->move_y;
    }

    public function move() {

    }

    public function getMoves() {
        return [
            'X' => $this->moveX,
            'Y' => $this->moveY
        ];
    }
}