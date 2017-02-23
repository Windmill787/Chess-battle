<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:44
 */

namespace frontend\components;

use Yii;

class FigureBuilderComponent
{
    public static function build($name)
    {
        $image = self::setImage($name);
        $figure = new FigureComponent($name, $image);
        return $figure;
    }

    public static function setImage($name)
    {
        return "/figureImages/".$name.".svg";
    }

    public static function setClass($name)
    {
        $class = Yii::$app->get($name);
        return $class;
    }
}