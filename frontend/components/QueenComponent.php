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

class QueenComponent extends FigureComponent
{
    public $name = 'queen';

    public function __construct($color, $game_id, $config = [])
    {
        parent::__construct($color, $this->name, null, $game_id, $config);
    }
}