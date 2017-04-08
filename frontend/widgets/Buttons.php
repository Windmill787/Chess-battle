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
    public static function widget($figures, FigureComponent $figure, $board, $whiteUser, $blackUser, $game) {

        foreach ($figure->moves as $moves) {
            if ($figure->color == 'white'
                && $whiteUser->id == \Yii::$app->user->id/* && $game->move %2 != 0*/) {

                if ($figure->name == 'bishop' || $figure->name == 'queen' || $figure->name == 'rook') {
                    for ($i = 1;$i<8;$i++) {
                        $figureMoveX = $figure->currentPositionX + $moves[0] * $i;
                        $figureMoveY = $figure->currentPositionY + $moves[1] * $i;
                        self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                    }
                } else {

                    $figureMoveX = $figure->currentPositionX + $moves[0];
                    $figureMoveY = $figure->currentPositionY + $moves[1];
                    self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                }

            } /*else if ($figure->color == 'black' && $blackUser->id == \Yii::$app->user->id && $game->move %2 == 0) {

                $figureMoveX = $figure->currentPositionX - $moves[0];
                $figureMoveY = $figure->currentPositionY - $moves[1];
                self::checkPosition($figureMoveX, $figureMoveY, $figure, $board, $game);
            }*/
        }

        foreach ($figure->attacks as $attack) {
            if ($figure->color == 'white'
                && $whiteUser->id == \Yii::$app->user->id/* && $game->move %2 != 0*/) {

                if ($figure->name == 'bishop' || $figure->name == 'queen' || $figure->name == 'rook') {
                    for ($i = 1;$i<8;$i++) {
                        $figureMoveX = $figure->currentPositionX + $attack[0] * $i;
                        $figureMoveY = $figure->currentPositionY + $attack[1] * $i;
                        self::checkFigure($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                    }
                } else {

                    $figureAttackX = $figure->currentPositionX + $attack[0];
                    $figureAttackY = $figure->currentPositionY + $attack[1];
                    self::checkFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game);
                }
            }
        }
    }

    /*public static function desiredAttackPosition($color, $figure, $attack, $whiteUser, $blackUser, $game) {
        if ($color == 'white' && $whiteUser->id == \Yii::$app->user->id && $game->move %2 != 0) {
            $desiredPosition = PlayPositions::findOne([
                'game_id' => $game->id,
                'current_x' => $figure->currentPositionX + $attack[0],
                'current_y' => $figure->currentPositionY + $attack[1]
            ]);
            return $desiredPosition;
        } else if ($color == 'black' && $blackUser->id == \Yii::$app->user->id && $game->move %2 == 0) {
            $desiredPosition = PlayPositions::findOne([
                'game_id' => $game->id,
                'current_x' => $figure->currentPositionX - $attack[0],
                'current_y' => $figure->currentPositionY - $attack[1]
            ]);
            return $desiredPosition;
        }
    }*/

    /*public static function checkFigure($figure, $board, $attack, $desiredPosition) {

        if ($figure->color == 'white') {

            if ($board->x == $figure->currentPositionX + $attack[0] &&
                $board->y == $figure->currentPositionY + $attack[1]) {
                self::displayAttackButton($figure, $desiredPosition);
            }

        } else if ($figure->color == 'black') {

            if ($board->x == $figure->currentPositionX - $attack[0] &&
                $board->y == $figure->currentPositionY - $attack[1]) {
                self::displayAttackButton($figure, $desiredPosition);
            }
        }
    }*/

    public static function checkFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game)
    {
        foreach ($figures as $item) {
            if ($item->currentPositionX == $figureAttackX
                && $item->currentPositionY == $figureAttackY
                && $board->x == $figureAttackX
                && $board->y == $figureAttackY
                && $item->color != $figure->color) {

                echo Html::beginForm();
                echo Html::submitButton('attack', [
                    'class' => 'btn btn-xs btn-danger hidden attack attack' . $figure->id,
                    'name' => 'attack' . $item->id . $game->id,
                    'onclick' => 'hideButtons()'
                ]);
                echo Html::endForm();
            }
        }
    }

    public static function checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game)
    {

        if ($board->x == $figureMoveX
            && $board->y == $figureMoveY
        ) {

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