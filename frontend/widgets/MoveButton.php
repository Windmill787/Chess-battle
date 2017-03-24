<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:07
 */

namespace frontend\widgets;

use frontend\components\FigureComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class MoveButton extends Widget
{
    public static function widget(FigureComponent $figure) {
        $desiredPosition = $figure->desiredMovePosition();

        if (empty($desiredPosition->figure_id)) {
            echo Html::beginForm();
            echo Html::submitButton('move', [
                'class' => 'btn btn-xs btn-primary hidden move',
                'name' => 'move' . $figure->color . $figure->name . $figure->number,
                'id' => 'move' . $figure->name . $figure->id,
                'onclick' => 'hideButtons()'
            ]);
            echo Html::endForm();
        }
    }
}