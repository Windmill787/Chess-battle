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
use app\models\PlayPositions;
use app\models\Figure;

class Buttons extends Widget
{
    public static function widget(FigureComponent $figure, $board) {

        foreach ($figure->moves as $moves) {
                if ($figure->color == 'white') {
                    $figureMoveX = $figure->currentPositionX + $moves[0];
                    $figureMoveY = $figure->currentPositionY + $moves[1];

                    self::displayButton($figureMoveX, $figureMoveY, $figure, $board);

                } else if ($figure->color == 'black') {
                    $figureMoveX = $figure->currentPositionX - $moves[0];
                    $figureMoveY = $figure->currentPositionY - $moves[1];

                    self::displayButton($figureMoveX, $figureMoveY, $figure, $board);
                }
        }

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

    public static function displayButton($figureMoveX, $figureMoveY, $figure, $board) {
        $desiredPosition = PlayPositions::findOne([
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);
        if (empty($desiredPosition->figure_id)) {
            if ($board->x == $figureMoveX &&
                $board->y == $figureMoveY) {

                echo Html::beginForm();
                echo Html::submitButton('move', [
                    'class' => 'btn btn-xs btn-primary hidden move move' . $figure->id,
                    'name' => 'move' . $figure->id . $figureMoveX . $figureMoveY,
                    'onclick' => 'hideButtons()'
                ]);
                echo Html::endForm();
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