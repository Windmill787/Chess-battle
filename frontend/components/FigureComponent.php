<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 20.02.17
 * Time: 19:49
 */

namespace frontend\components;

use app\models\Figure;
use app\models\StartPosition;
use yii\base\Component;

class FigureComponent extends Component
{
    public $color;
    public $name;
    public $image;
    public $number;
    public $startPositionRow;
    public $startPositionCol;

    public function setImage($color, $name){
        $image = "/figureImages/".$color.ucfirst($name).".svg";
        return $image;
    }

    public function __construct($color, $name, $number = null, $config = [])
    {
        $figure = Figure::findOne(['color' => $color,'name' => $name,'number' => $number]);
        $this->name = $figure->name;
        $this->color = $figure->color;
        $this->number = $figure->number;
        $this->setStartPositions($figure->id);
        $this->image = $this->setImage($color, $name);
        parent::__construct($config);
    }

    public function setStartPositions($id) {
        $startPosition = StartPosition::findOne(['id' => $id]);
        $this->startPositionCol = $startPosition->start_col;
        $this->startPositionRow = $startPosition->start_row;
    }
}