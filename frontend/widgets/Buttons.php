<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:07
 */

namespace frontend\widgets;

use app\models\Game;
use frontend\components\FigureComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use app\models\PlayPositions;
use app\models\Figure;

class Buttons extends Widget
{
    public static function widget($figures, $figure, $board, $whiteUser, $blackUser, $game) {

        if ($figure->name == 'king' && $figure->check == 1) {
            foreach ($figure->moves as $moves) {
                if ($figure->color == 'white' && $whiteUser->id == \Yii::$app->user->id/* && $game->move %2 != 0*/) {

                    $figureMoveX = $figure->currentPositionX + $moves[0];
                    $figureMoveY = $figure->currentPositionY + $moves[1];

                    foreach ($figures as $item) {
                        foreach ($item->attacks as $itemAttack) {
                            if ($itemAttack[0] != $figureMoveX && $itemAttack[1] != $figureMoveY) {
                                self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                            }
                        }
                    }
                }
            }

        } else {

            foreach ($figure->moves as $moves) {
                if ($figure->color == 'white'
                    /*&& $whiteUser->id == \Yii::$app->user->id
                    && $game->move %2 != 0*/) {

                    $figureMoveX = $figure->currentPositionX + $moves[0];
                    $figureMoveY = $figure->currentPositionY + $moves[1];
                    self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                } else if ($figure->color == 'black'
                    /*&& $blackUser->id == \Yii::$app->user->id
                    && $game->move %2 == 0*/) {

                    $figureMoveX = $figure->currentPositionX - $moves[0];
                    $figureMoveY = $figure->currentPositionY - $moves[1];
                    self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                }

            }

            foreach ($figure->attacks as $attack) {
                if ($figure->color == 'white'
                    /*&& $whiteUser->id == \Yii::$app->user->id && $game->move %2 != 0*/) {

                    $figureAttackX = $figure->currentPositionX + $attack[0];
                    $figureAttackY = $figure->currentPositionY + $attack[1];
                    self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game);
                } else if ($figure->color == 'black') {
                    $figureAttackX = $figure->currentPositionX - $attack[0];
                    $figureAttackY = $figure->currentPositionY - $attack[1];
                    self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game);
                }

            }
        }
    }

    public static function checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game)
    {
        foreach ($figures as $item) {
            if ($item->currentPositionX == $figureAttackX &&
                $item->currentPositionY == $figureAttackY &&
                $board->x == $figureAttackX &&
                $board->y == $figureAttackY &&
                $item->color != $figure->color) {

                echo Html::beginForm();
                echo Html::submitButton('attack', [
                    'class' => 'btn btn-xs btn-danger hidden attack attack' . $figure->id,
                    'name' => 'attack' . $item->id . $figure->id . $game->id,
                    'onclick' => 'hideButtons()'
                ]);
                echo Html::endForm();
            }
        }
    }

    public static function checkAnyFigure($figures, $figureMoveX, $figureMoveY) {
        foreach ($figures as $figure) {
            if ($figure->currentPositionX == $figureMoveX &&
                $figure->currentPositionY == $figureMoveY) {

                return $figure;
            }
        }
    }

    public static function checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game)
    {
        $anyFigure = self::checkAnyFigure($figures, $figureMoveX, $figureMoveY);

        if (empty($anyFigure) && $board->x == $figureMoveX && $board->y == $figureMoveY) {

            echo Html::beginForm();
            echo Html::submitButton('move', [
                'class' => 'btn btn-xs btn-primary hidden move move' . $figure->id,
                'name' => 'move' . $figure->id . $figureMoveX . $figureMoveY . $game->id,
                'onclick' => 'hideButtons()'
            ]);
            echo Html::endForm();
        }
    }
}