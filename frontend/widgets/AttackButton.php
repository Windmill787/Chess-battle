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

        foreach ($figure->attacks as $attack) {
                if ($figure->color == 'white') {
                    $desiredPosition = PlayPositions::findOne([
                        'current_x' => $figure->currentPositionX + $attack[0],
                        'current_y' => $figure->currentPositionY + $attack[1]
                    ]);
                    if ($board->x == $figure->currentPositionX + $attack[0] &&
                        $board->y == $figure->currentPositionY + $attack[1]) {
                        self::checkFigure($figure, $desiredPosition);
                    }
                } else if ($figure->color == 'black') {
                    $desiredPosition = PlayPositions::findOne([
                        'current_x' => $figure->currentPositionX - $attack[0],
                        'current_y' => $figure->currentPositionY - $attack[1]
                    ]);
                    if ($board->x == $figure->currentPositionX - $attack[0] &&
                        $board->y == $figure->currentPositionY - $attack[1]) {
                        self::checkFigure($figure, $desiredPosition);
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