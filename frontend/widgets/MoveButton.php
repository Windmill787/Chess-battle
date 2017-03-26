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
                    $desiredPosition = PlayPositions::findOne([
                        'current_x' => $figure->currentPositionX + $moveX,
                        'current_y' => $figure->currentPositionY + $moveY
                    ]);
                    if ($board->x == $figure->currentPositionX + $moveX &&
                        $board->y == $figure->currentPositionY + $moveY) {
                        self::checkPosition($figure, $desiredPosition);
                    }
                } else if ($figure->color == 'black') {
                    $desiredPosition = PlayPositions::findOne([
                        'current_x' => $figure->currentPositionX - $moveX,
                        'current_y' => $figure->currentPositionY - $moveY
                    ]);
                    if ($board->x == $figure->currentPositionX - $moveX &&
                        $board->y == $figure->currentPositionY - $moveY) {
                        self::checkPosition($figure, $desiredPosition);
                    }
                }
            }
        }
    }

    public static function checkPosition($figure, $desiredPosition) {
        if (empty($desiredPosition->figure_id)) {
                echo Html::beginForm();
                echo Html::submitButton('move', [
                    'class' => 'btn btn-xs btn-primary hidden move move' . $figure->id,
                    'name' => 'move' . $figure->id . $figure->moveCount,
                    'onclick' => 'hideButtons()'
                ]);
                echo Html::endForm();
            }
    }
}