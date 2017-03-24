<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:08
 */

namespace frontend\widgets;

use frontend\components\FigureComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class FirstMoveButton extends Widget
{
    public static function widget(FigureComponent $figure) {
        $desiredPosition = $figure->desiredMovePosition();
        if (empty($desiredPosition->figure_id)) {
            if ($figure->name == 'pawn' && $figure->currentPositionY == $figure->startPositionY) {
                $desiredPosition = $figure->desiredFirstMovePosition();
                if (empty($desiredPosition->figure_id)) {
                    echo Html::beginForm();
                    echo Html::submitButton('move', [
                        'class' => 'btn btn-xs btn-primary hidden move',
                        'name' => 'firstMove' . $figure->color . $figure->name . $figure->number,
                        'id' => 'firstMove' . $figure->name . $figure->id,
                        'onclick' => 'hideButtons()'
                    ]);
                    echo Html::endForm();
                }
            }
        }
    }
}