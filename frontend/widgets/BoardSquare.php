<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 26.03.17
 * Time: 12:57
 */

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\PlayPositions;
use app\models\Figure;

class BoardSquare extends Widget
{
    public static function widget($color, $board, $figures) {

        echo Html::beginTag('td', [
            'height' => 50,
            'width' => 50,
            'bgcolor' => $color,
            'align' => 'center',
            'valign' => 'center'
        ]);
        foreach ($figures as $figure) {

            if ($board->x == $figure->currentPositionX && $board->y == $figure->currentPositionY) {
                if ($figure->status != 'killed') {
                    echo Html::img($figure->image, [
                        'id' => 'figure'.$figure->id,
                        'onclick' => "light(".$figure->name.', '.$figure->id.")"
                    ]);
                }
            }
            Buttons::widget($board, $figure);
        }
        echo Html::endTag('td');
    }
}