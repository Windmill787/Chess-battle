<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 15:49
 */

namespace frontend\widgets;

use frontend\components\BoardComponent;
use frontend\components\FigureComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class Buttons extends Widget
{
    public static function widget($board, $figure)
    {
        if ($figure->color == 'white') {

            MoveButton::widget($figure, $board);

            AttackButton::widget($figure, $board);

        } else if ($figure->color == 'black') {

            MoveButton::widget($figure, $board);

            AttackButton::widget($figure, $board);

        }
    }
}