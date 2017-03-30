<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:08
 */

namespace frontend\widgets;

use frontend\components\KingComponent;
use yii\base\Widget;
use app\models\PlayPositions;
use yii\helpers\Html;

class CastlingButton extends Widget
{
    public static function widget(KingComponent $figure, $board)
    {
        foreach ($figure->castlingMove as $castling) {
                $castlingMoveX = $figure->currentPositionX + $castling[0];
                $castlingMoveY = $figure->currentPositionY + $castling[1];

                if ($castling[0] == 2) {
                    $figureMoveX = $figure->currentPositionX + $castling[0] - 1;
                    $figureMoveY = $figure->currentPositionY + $castling[1];
                } else if ($castling[0] == -2) {
                    $figureMoveX = $figure->currentPositionX + $castling[0] + 1;
                    $figureMoveY = $figure->currentPositionY + $castling[1];
                }

                self::displayButton($castlingMoveX, $castlingMoveY,
                    $figureMoveX, $figureMoveY, $figure, $board);
            }
    }

    public static function displayButton($castlingMoveX, $castlingMoveY,
                                         $figureMoveX, $figureMoveY, $figure, $board) {
        $desiredPosition1 = PlayPositions::findOne([
            'current_x' => $castlingMoveX,
            'current_y' => $castlingMoveY
        ]);

        $desiredPosition2 = PlayPositions::findOne([
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);

        if (empty($desiredPosition1->figure_id) && empty($desiredPosition2->figure_id)) {
            if ($board->x == $castlingMoveX &&
                $board->y == $castlingMoveY) {

                echo Html::beginForm();
                echo Html::submitButton('cast', [
                    'class' => 'btn btn-xs btn-primary hidden move move' . $figure->id,
                    'name' => 'cast' . $figure->id . $castlingMoveX . $castlingMoveY,
                    'onclick' => 'hideButtons()'
                ]);
                echo Html::endForm();
            }
        }
    }
}