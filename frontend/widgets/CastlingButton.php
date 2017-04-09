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
    public static function widget($figures, KingComponent $king, $board, $whiteUser, $blackUser, $game)
    {

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

                    $rook = PlayPositions::findOne(['game_id' => $game->id, 'figure_id' => 14]);

                    if ($rook->already_moved == 0) {
                        self::checkRightPosition($figures, $castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game->id);
                    }
                } else if ($castling[0] == -2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] + 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game->id, 'figure_id' => 13]);

                    if ($rook->already_moved == 0) {
                        self::checkLeftPosition($figures, $castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game->id);
                    }
                }
            } else if ($king->color == 'black' && $blackUser->id == \Yii::$app->user->id
                && $game->move % 2 != 0 && $king->alreadyMoved == 0
                && $king->currentPositionX == $king->startPositionX &&
                $king->currentPositionY == $king->startPositionY) {
                if ($castling[0] == 2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] - 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game->id, 'figure_id' => 30]);

                    if ($rook->already_moved == 0) {
                        self::checkRightPosition($figures, $castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game->id);
                    }
                } else if ($castling[0] == -2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] + 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game->id, 'figure_id' => 29]);

                    if ($rook->already_moved == 0) {
                        self::checkLeftPosition($figures, $castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game->id);
                    }
                }
            }
        }
    }

    public static function checkRightFigures($figures, $figureMoveX, $figureMoveY, $castlingMoveX, $castlingMoveY) {
        foreach ($figures as $figure) {
            if ($figure->currentPositionX == $figureMoveX &&
                $figure->currentPositionY == $figureMoveY) {

                return $figure;
            }
        }

        foreach ($figures as $figure) {
            if ($figure->currentPositionX == $castlingMoveX &&
                $figure->currentPositionY == $castlingMoveY) {

                return $figure;
            }
        }
    }

    public static function checkLeftFigures($figures, $figureMoveX, $figureMoveY, $castlingMoveX, $castlingMoveY) {
        foreach ($figures as $figure) {
            if ($figure->currentPositionX == $figureMoveX &&
                $figure->currentPositionY == $figureMoveY) {

                return $figure;
            }
        }

        foreach ($figures as $figure) {
            if ($figure->currentPositionX == $castlingMoveX &&
                $figure->currentPositionY == $castlingMoveY) {

                return $figure;
            }
        }

        foreach ($figures as $figure) {
            if ($figure->currentPositionX == $castlingMoveX - 1 &&
                $figure->currentPositionY == $castlingMoveY) {

                return $figure;
            }
        }
    }

    public static function checkRightPosition($figures, $castlingMoveX, $castlingMoveY,
                                         $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id) {

        $figuresOnRight = self::checkRightFigures($figures, $figureMoveX, $figureMoveY, $castlingMoveX, $castlingMoveY);

        if (empty($figuresOnRight)) {
            self::displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook, $game_id);
        }
    }

    public static function checkLeftPosition($figures, $castlingMoveX, $castlingMoveY,
                                             $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id) {

        $figuresOnLeft = self::checkLeftFigures($figures, $figureMoveX, $figureMoveY, $castlingMoveX, $castlingMoveY);

        if (empty($figuresOnLeft)) {
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