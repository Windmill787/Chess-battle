<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:07
 */

namespace frontend\widgets;

use app\models\Figure;
use frontend\components\FigureComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class MoveButton extends Widget
{
    public static function widget($figure)
    {
        $desiredPosition = $figure->desiredMovePosition();

        if (empty($desiredPosition->figure_id) || $desiredPosition->status == 'killed') {
            echo Html::submitButton('Move', [
                'class' => 'btn btn-xs btn-primary hidden move',
                'name' => 'move' . $figure->color . $figure->name . $figure->number,
                'id' => 'move' . $figure->name . $figure->id
            ]);
        }
    }
}