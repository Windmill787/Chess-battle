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
use app\models\Game;

class CastlingButton extends Widget
{
    public static function widget(KingComponent $king, $board, $whiteUser, $blackUser, $game_id)
    {
        $game = Game::findOne(['id' => $game_id]);

        foreach ($king->castlingMove as $castling) {
            $castlingMoveX = $king->currentPositionX + $castling[0];
            $castlingMoveY = $king->currentPositionY + $castling[1];

            if ($king->color == 'white' && $whiteUser->id == \Yii::$app->user->id
                && $game->move % 2 != 0 && $king->alreadyMoved == 0
                && $king->currentPositionX == $king->startPositionX &&
                    $king->currentPositionY == $king->startPositionY) {
                if ($castling[0] == 2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] - 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => 14]);

                    if ($rook->already_moved == 0) {
                        self::checkRightPosition($castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id);
                    }
                } else if ($castling[0] == -2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] + 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => 13]);

                    if ($rook->already_moved == 0) {
                        self::checkRightPosition($castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id);
                    }
                }
            } else if ($king->color == 'black' && $blackUser->id == \Yii::$app->user->id
                && $game->move % 2 != 0 && $king->alreadyMoved == 0
                && $king->currentPositionX == $king->startPositionX &&
                $king->currentPositionY == $king->startPositionY) {
                if ($castling[0] == 2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] - 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => 30]);

                    if ($rook->already_moved == 0) {
                        self::checkRightPosition($castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id);
                    }
                } else if ($castling[0] == -2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] + 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => 29]);

                    if ($rook->already_moved == 0) {
                        self::checkRightPosition($castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id);
                    }
                }
            }
        }
    }

    public static function checkRightPosition($castlingMoveX, $castlingMoveY,
                                         $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id) {
        $desiredPosition1 = PlayPositions::findOne([
            'game_id' => $game_id,
            'current_x' => $castlingMoveX,
            'current_y' => $castlingMoveY
        ]);

        $desiredPosition2 = PlayPositions::findOne([
            'game_id' => $game_id,
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);

        if (empty($desiredPosition1->figure_id) && empty($desiredPosition2->figure_id)) {
            self::displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook, $game_id);
        }
    }

    public static function checkLeftPosition($castlingMoveX, $castlingMoveY,
                                             $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id) {
        $desiredPosition1 = PlayPositions::findOne([
            'game_id' => $game_id,
            'current_x' => $castlingMoveX,
            'current_y' => $castlingMoveY
        ]);

        $desiredPosition2 = PlayPositions::findOne([
            'game_id' => $game_id,
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);

        $desiredPosition3 = PlayPositions::findOne([
            'game_id' => $game_id,
            'current_x' => $castlingMoveX - 1,
            'current_y' => $castlingMoveY
        ]);

        if (empty($desiredPosition1->figure_id)
            && empty($desiredPosition2->figure_id)
            && empty($desiredPosition3->figure_id)) {
            self::displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook, $game_id);
        }
    }

    public static function displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook, $game_id) {
        if ($board->x == $castlingMoveX &&
            $board->y == $castlingMoveY) {

            echo Html::beginForm();
            echo Html::submitButton('cast', [
                'class' => 'btn btn-xs btn-primary hidden move move' . $king->id,
                'name' => 'cast' . $king->id . $castlingMoveX . $castlingMoveY . $rook->id . $game_id,
                'onclick' => 'hideButtons()'
            ]);
            echo Html::endForm();
        }
    }
}