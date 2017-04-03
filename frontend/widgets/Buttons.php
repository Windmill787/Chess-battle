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
use app\models\Figure;

class Buttons extends Widget
{
    public static function widget(FigureComponent $figure, $board, $whiteUser, $blackUser) {

        foreach ($figure->moves as $moves) {
            if ($figure->color == 'white' && $whiteUser->id == \Yii::$app->user->id) {

                $figureMoveX = $figure->currentPositionX + $moves[0];
                $figureMoveY = $figure->currentPositionY + $moves[1];
                self::checkPosition($figureMoveX, $figureMoveY, $figure, $board);

            } else if ($figure->color == 'black' && $blackUser->id == \Yii::$app->user->id) {

                $figureMoveX = $figure->currentPositionX - $moves[0];
                $figureMoveY = $figure->currentPositionY - $moves[1];
                self::checkPosition($figureMoveX, $figureMoveY, $figure, $board);
            }
        }

        foreach ($figure->attacks as $attack) {
            $desiredPosition = self::desiredAttackPosition($figure->color, $figure, $attack, $whiteUser, $blackUser);

            self::checkFigure($figure, $board, $attack, $desiredPosition);
        }
    }

    public static function desiredAttackPosition($color, $figure, $attack, $whiteUser, $blackUser) {
        if ($color == 'white' && $whiteUser->id == \Yii::$app->user->id) {
            $desiredPosition = PlayPositions::findOne([
                'current_x' => $figure->currentPositionX + $attack[0],
                'current_y' => $figure->currentPositionY + $attack[1]
            ]);
            return $desiredPosition;
        } else if ($color == 'black' && $blackUser->id == \Yii::$app->user->id) {
            $desiredPosition = PlayPositions::findOne([
                'current_x' => $figure->currentPositionX - $attack[0],
                'current_y' => $figure->currentPositionY - $attack[1]
            ]);
            return $desiredPosition;
        }
    }

    public static function checkPosition($figureMoveX, $figureMoveY, $figure, $board) {

        $desiredPosition = PlayPositions::findOne([
                'current_x' => $figureMoveX,
                'current_y' => $figureMoveY
        ]);

        if (empty($desiredPosition->figure_id)) {
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

    public static function checkFigure($figure, $board, $attack, $desiredPosition) {

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
    }

    public static function displayAttackButton($figure, $desiredPosition) {
        if (empty($desiredPosition->figure_id) == false) {

            $desiredFigure = Figure::findOne(['id' => $desiredPosition->id]);

            if ($desiredFigure->color != $figure->color && $desiredFigure->status == 'active') {
                echo Html::beginForm();
                echo Html::submitButton('attack', [
                    'class' => 'btn btn-xs btn-danger hidden attack attack' . $figure->id,
                    'name' => 'attack' . $desiredFigure->id,
                    'onclick' => 'hideButtons('.$desiredFigure->id.')'
                ]);
                echo Html::endForm();
            }
        }
    }

    /*public static function widget(FigureComponent $figure, $board) {

        foreach ($figure->moves as $moves) {

            $figureMoveXY = self::desiredMovePosition($figure->color, $figure, $moves);

            self::checkPosition($figureMoveXY[0], $figureMoveXY[1], $figure, $board);
        }

        foreach ($figure->attacks as $attack) {

            $desiredPosition = self::desiredAttackPosition($figure->color, $figure, $attack);

            self::checkFigure($figure, $desiredPosition);
        }
    }

    public static function desiredMovePosition($color, $figure, $moves) {
        if ($color == 'white') {

            $figureMoveX = $figure->currentPositionX + $moves[0];
            $figureMoveY = $figure->currentPositionY + $moves[1];

        } else if ($color == 'black') {

            $figureMoveX = $figure->currentPositionX - $moves[0];
            $figureMoveY = $figure->currentPositionY - $moves[1];
        }
        return [$figureMoveX, $figureMoveY];
    }

    public static function desiredAttackPosition($color, $figure, $attack) {
        if ($color == 'white') {
            $desiredPosition = PlayPositions::findOne([
                'current_x' => $figure->currentPositionX + $attack[0],
                'current_y' => $figure->currentPositionY + $attack[1]
            ]);
        } else if ($color == 'black') {
            $desiredPosition = PlayPositions::findOne([
                'current_x' => $figure->currentPositionX - $attack[0],
                'current_y' => $figure->currentPositionY - $attack[1]
            ]);
        }
        return $desiredPosition;
    }

    public static function checkPosition($figureMoveX, $figureMoveY, $figure, $board) {

        $desiredPosition = PlayPositions::findOne([
            'current_x' => $figureMoveX,
            'current_y' => $figureMoveY
        ]);

        if (empty($desiredPosition->figure_id)) {
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

    public static function checkFigure($figure, $desiredPosition) {

        if (empty($desiredPosition->figure_id) == false) {

            $desiredFigure = Figure::findOne(['id' => $desiredPosition->id]);

            if ($desiredFigure->color != $figure->color && $desiredFigure->status == 'active') {
                echo Html::beginForm();
                echo Html::submitButton('attack', [
                    'class' => 'btn btn-xs btn-danger hidden attack attack' . $figure->id,
                    'name' => 'attack' . $desiredFigure->id,
                    'onclick' => 'hideButtons('.$desiredFigure->id.')'
                ]);
                echo Html::endForm();
            }
        }
    }*/
}