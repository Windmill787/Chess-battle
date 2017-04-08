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
}