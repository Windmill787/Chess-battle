<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:08
 */

namespace frontend\widgets;

use app\models\Figure;
use frontend\components\KingComponent;
use yii\base\Widget;
use app\models\PlayPositions;
use yii\helpers\Html;

class CastlingButton extends Widget
{
    public static function widget(KingComponent $king, $board)
    {
        foreach ($king->castlingMove as $castling) {
            $castlingMoveX = $king->currentPositionX + $castling[0];
            $castlingMoveY = $king->currentPositionY + $castling[1];

            if ($castling[0] == 2) {
                $figureMoveX = $king->currentPositionX + $castling[0] - 1;
                $figureMoveY = $king->currentPositionY + $castling[1];

                $rook = Figure::findOne(['color' => $king->color, 'number' => 2]);

                self::checkRightPosition($castlingMoveX, $castlingMoveY,
                    $figureMoveX, $figureMoveY, $king, $board, $rook);

            } else if ($castling[0] == -2) {
                $figureMoveX = $king->currentPositionX + $castling[0] + 1;
                $figureMoveY = $king->currentPositionY + $castling[1];

                $rook = Figure::findOne(['color' => $king->color, 'number' => 1]);

                self::checkLeftPosition($castlingMoveX, $castlingMoveY,
                    $figureMoveX, $figureMoveY, $king, $board, $rook);
            }
        }
    }

    public static function checkRightPosition($castlingMoveX, $castlingMoveY,
                                         $figureMoveX, $figureMoveY, $king, $board, $rook) {
        $desiredPosition1 = PlayPositions::findOne([
            'current_x' => $castlingMoveX,
            'current_y' => $castlingMoveY
        ]);

        $desiredPosition2 = PlayPositions::findOne([
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);

        if (empty($desiredPosition1->figure_id) && empty($desiredPosition2->figure_id)) {
            self::displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook);
        }
    }

    public static function checkLeftPosition($castlingMoveX, $castlingMoveY,
                                             $figureMoveX, $figureMoveY, $king, $board, $rook) {
        $desiredPosition1 = PlayPositions::findOne([
            'current_x' => $castlingMoveX,
            'current_y' => $castlingMoveY
        ]);

        $desiredPosition2 = PlayPositions::findOne([
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);

        $desiredPosition3 = PlayPositions::findOne([
            'current_x' => $castlingMoveX - 1,
            'current_y' => $castlingMoveY
        ]);

        if (empty($desiredPosition1->figure_id)
            && empty($desiredPosition2->figure_id)
            && empty($desiredPosition3->figure_id)) {
            self::displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook);
        }
    }

    public static function displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook) {
        if ($board->x == $castlingMoveX &&
            $board->y == $castlingMoveY) {

            echo Html::beginForm();
            echo Html::submitButton('cast', [
                'class' => 'btn btn-xs btn-primary hidden move move' . $king->id,
                'name' => 'cast' . $king->id . $castlingMoveX . $castlingMoveY . $rook->id,
                'onclick' => 'hideButtons()'
            ]);
            echo Html::endForm();
        }
    }
}