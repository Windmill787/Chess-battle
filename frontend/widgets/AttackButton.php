<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:07
 */

namespace frontend\widgets;

use app\models\Figure;
use app\models\PlayPositions;
use frontend\components\FigureComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class AttackButton extends Widget
{
    public static function widget(FigureComponent $figure, $board) {

        foreach ($figure->attackX as $attackX) {
            foreach ($figure->attackY as $attackY) {
                if ($figure->color == 'white') {
                    $desiredPosition = PlayPositions::findOne([
                        'current_x' => $figure->currentPositionX + $attackX,
                        'current_y' => $figure->currentPositionY + $attackY
                    ]);
                    if ($board->x == $figure->currentPositionX + $attackX &&
                        $board->y == $figure->currentPositionY + $attackY) {
                        self::checkFigure($figure, $desiredPosition);
                    }
                } else if ($figure->color == 'black') {
                    $desiredPosition = PlayPositions::findOne([
                        'current_x' => $figure->currentPositionX - $attackX,
                        'current_y' => $figure->currentPositionY - $attackY
                    ]);
                    if ($board->x == $figure->currentPositionX - $attackX &&
                        $board->y == $figure->currentPositionY - $attackY) {
                        self::checkFigure($figure, $desiredPosition);
                    }
                }
            }
        }
    }

    public static function checkFigure($figure, $desiredPosition) {

        if (empty($desiredPosition->figure_id) == false) {
            $desiredFigure = Figure::findOne(['id' => $desiredPosition->id]);

            if ($desiredFigure->color != $figure->color && $desiredFigure->status == 'active') {
                echo Html::beginForm();
                echo Html::submitButton('attack', [
                    'class' => 'btn btn-xs btn-danger hidden attack attack' . $figure->id,
                    'name' => 'attack' . $desiredFigure->id,
                    'onclick' => 'hideButtons()'
                ]);
                echo Html::endForm();
            }
        }
    }
}