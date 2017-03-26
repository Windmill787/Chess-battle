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

class MoveButton extends Widget
{
    public static function widget(FigureComponent $figure, $board) {

        foreach ($figure->moveX as $moveX) {
            foreach ($figure->moveY as $moveY) {
                if ($figure->color == 'white') {
                    $figureMoveX = $figure->currentPositionX + $moveX;
                    $figureMoveY = $figure->currentPositionY + $moveY;

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
                } else if ($figure->color == 'black') {
                    $figureMoveX = $figure->currentPositionX - $moveX;
                    $figureMoveY = $figure->currentPositionY - $moveY;

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
            }
        }
    }
}