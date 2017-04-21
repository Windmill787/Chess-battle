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
use yii\widgets\ActiveForm;

class CastlingButton extends Widget
{
    public static function widget($figures, KingComponent $king, $board, $whiteUser, $blackUser, $game, $playPositions)
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
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game->id, $playPositions);
                    }
                } else if ($castling[0] == -2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] + 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game->id, 'figure_id' => 13]);

                    if ($rook->already_moved == 0) {
                        self::checkLeftPosition($figures, $castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game->id, $playPositions);
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
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game->id, $playPositions);
                    }
                } else if ($castling[0] == -2) {
                    $figureMoveX = $king->currentPositionX + $castling[0] + 1;
                    $figureMoveY = $king->currentPositionY + $castling[1];

                    $rook = PlayPositions::findOne(['game_id' => $game->id, 'figure_id' => 29]);

                    if ($rook->already_moved == 0) {
                        self::checkLeftPosition($figures, $castlingMoveX, $castlingMoveY,
                            $figureMoveX, $figureMoveY, $king, $board, $rook, $game->id, $playPositions);
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
                                         $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id, $playPositions) {

        $figuresOnRight = self::checkRightFigures($figures, $figureMoveX, $figureMoveY, $castlingMoveX, $castlingMoveY);

        if (empty($figuresOnRight)) {
            self::displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook, $game_id, $playPositions);
        }
    }

    public static function checkLeftPosition($figures, $castlingMoveX, $castlingMoveY,
                                             $figureMoveX, $figureMoveY, $king, $board, $rook, $game_id, $playPositions) {

        $figuresOnLeft = self::checkLeftFigures($figures, $figureMoveX, $figureMoveY, $castlingMoveX, $castlingMoveY);

        if (empty($figuresOnLeft)) {
            self::displayButton($king, $board, $castlingMoveX, $castlingMoveY, $rook, $game_id, $playPositions);
        }
    }

    public static function displayButton($king, $board, $castlingMoveX, $castlingMoveY, PlayPositions $rook, $game_id, $playPositions) {
        if ($board->x == $castlingMoveX &&
            $board->y == $castlingMoveY) {

            foreach ($playPositions as $playPosition) {
                if ($king->id == $playPosition->figure_id) {
                    $form = ActiveForm::begin([
                        'options' =>
                            [
                                'style' => [
                                    'position' => 'absolute',
                                    'margin-left' => '3px',
                                    'margin-top' => '-25px'
                                ]
                            ]
                    ]);

                    echo $form->field($playPosition, "id")
                        ->label(false)->hiddenInput();

                    echo $form->field($playPosition, "rook_id")
                        ->label(false)->hiddenInput(['value' => $rook->id]);

                    if ($rook->figure_id == 30 || $rook->figure_id == 14) {
                        echo $form->field($playPosition, "rook_current_x")
                            ->label(false)->hiddenInput(['value' => $castlingMoveX - 1]);

                        echo $form->field($playPosition, "rook_current_y")
                            ->label(false)->hiddenInput(['value' => $castlingMoveY]);

                    } else if ($rook->figure_id == 29 || $rook->figure_id == 13) {
                        echo $form->field($playPosition, "rook_current_x")
                            ->label(false)->hiddenInput(['value' => $castlingMoveX + 1]);

                        echo $form->field($playPosition, "rook_current_y")
                            ->label(false)->hiddenInput(['value' => $castlingMoveY]);
                    }

                    echo $form->field($playPosition, "current_x")
                        ->label(false)->hiddenInput(['value' => $castlingMoveX]);

                    echo $form->field($playPosition, "current_y")
                        ->label(false)->hiddenInput(['value' => $castlingMoveY]);

                    echo Html::submitButton(\Yii::t('app', 'Castling'), [
                        'class' => 'btn btn-xs btn-primary hidden move move' . $king->id,
                        'value' => 'castling',
                        'onclick' => 'hideButtons()'
                    ]);

                    /*echo $form->field($rook, "id")
                        ->label(false)->hiddenInput();

                    echo $form->field($rook, "current_x")
                        ->label(false)->hiddenInput(['value' => $castlingMoveX]);

                    echo $form->field($rook, "current_y")
                        ->label(false)->hiddenInput(['value' => $castlingMoveY]);*/

                    ActiveForm::end();
                }
            }
        }
    }
}