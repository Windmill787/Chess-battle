<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 30.03.17
 * Time: 18:52
 */

namespace frontend\widgets;

use app\models\PlayPositions;
use frontend\components\PawnComponent;
use yii\helpers\Html;
use yii\base\Widget;

class FirstMoveButton extends Widget
{
    public static function widget(PawnComponent $figure, $board) {

        if ($figure->color == 'white') {
            $figureMoveX = $figure->currentPositionX + $figure->first_move[0];
            $figureMoveY = $figure->currentPositionY + $figure->first_move[1];
            self::checkPosition($figureMoveX, $figureMoveY, $figure, $board);
        } else if ($figure->color == 'black') {
            $figureMoveX = $figure->currentPositionX - $figure->first_move[0];
            $figureMoveY = $figure->currentPositionY - $figure->first_move[1];
            self::checkPosition($figureMoveX, $figureMoveY, $figure, $board);
        }
    }

    public static function checkPosition($figureMoveX, $figureMoveY, $figure, $board) {
        $desiredPosition1 = PlayPositions::findOne([
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);

        $desiredPosition2 = PlayPositions::findOne([
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY - 1
        ]);

        if (empty($desiredPosition1->figure_id) && empty($desiredPosition2->figure_id) &&
            $figure->currentPositionX == $figure->startPositionX &&
            $figure->currentPositionY == $figure->startPositionY) {
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