<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:44
 */

namespace frontend\components;

use app\models\Figure;

class FigureBuilderComponent
{
    public static function build($color, $name, $number)
    {
        $figure = Figure::findOne(['color' => $color,'name' => $name,'number' => $number]);
        $pawn = new PawnComponent($color, $name, $number);
        return $figure;
    }
}