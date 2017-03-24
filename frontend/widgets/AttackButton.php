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

class AttackButton extends Widget
{
    public static function widget(FigureComponent $figure) {
        $desiredPosition = $figure->desiredAttackPosition();

        if (empty($desiredPosition->figure_id) == false) {
            $desiredFigure = Figure::findOne(['id' => $desiredPosition->figure_id]);
            if ($desiredFigure->color != $figure->color && $desiredFigure->status == 'active') {
                echo Html::beginForm();
                echo Html::submitButton('attack', [
                    'class' => 'btn btn-xs btn-danger hidden move',
                    'name' => 'attack' . $figure->color . $figure->name . $figure->number,
                    'id' => 'attack' . $figure->name . $figure->id,
                    'onclick' => 'hideButtons()'
                ]);
                echo Html::endForm();
            }
        }
    }
}