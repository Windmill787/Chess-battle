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
use app\models\Game;

class FirstMoveButton extends Widget
{
    public static function widget(PawnComponent $figure, $board, $whiteUser, $blackUser, $game) {

        if ($figure->color == 'white' && $whiteUser->id == \Yii::$app->user->id /*&& $game->move %2 != 0*/) {
            $figureMoveX = $figure->currentPositionX + $figure->first_move[0];
            $figureMoveY = $figure->currentPositionY + $figure->first_move[1];
            self::checkPosition($figureMoveX, $figureMoveY, $figure, $board, $game->id);
        } else if ($figure->color == 'black' && $blackUser->id == \Yii::$app->user->id /*&& $game->move %2 == 0*/) {
            $figureMoveX = $figure->currentPositionX - $figure->first_move[0];
            $figureMoveY = $figure->currentPositionY - $figure->first_move[1];
            self::checkPosition($figureMoveX, $figureMoveY, $figure, $board, $game->id);
        }
    }

    public static function checkPosition($figureMoveX, $figureMoveY, $figure, $board, $game_id) {
        /*$desiredPosition1 = PlayPositions::findOne([
            'game_id' => $game_id,
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);

        $desiredPosition2 = PlayPositions::findOne([
            'game_id' => $game_id,
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY - 1
        ]);*/

        if (
            $figure->currentPositionX == $figure->startPositionX &&
            $figure->currentPositionY == $figure->startPositionY) {
            if ($board->x == $figureMoveX &&
                $board->y == $figureMoveY) {

                echo Html::beginForm();
                echo Html::submitButton('move', [
                    'class' => 'btn btn-xs btn-primary hidden move move' . $figure->id,
                    'name' => 'move' . $figure->id . $figureMoveX . $figureMoveY . $game_id,
                    'onclick' => 'hideButtons()'
                ]);
                echo Html::endForm();
            }
        }
    }
}