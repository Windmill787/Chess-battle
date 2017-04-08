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

class BishopComponent extends FigureComponent
{
    public $name = 'bishop';

    public function __construct($color, $number = null, $game_id, $config = []) {
        parent::__construct($color, $this->name, $number, $game_id, $config);
    }
}