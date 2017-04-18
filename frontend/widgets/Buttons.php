<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:07
 */

namespace frontend\widgets;

use app\models\PlayPositions;
use frontend\components\KingComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class Buttons extends Widget
{
    public static function widget($figures, $figure, $board, $whiteUser, $blackUser, $game)
    {

        if ($figures[15]->check == true) {
            if ($figure->name == 'king' && $figure->id == 16) {
                foreach ($figure->moves as $moves) {
                    $figureMoveX = $figure->currentPositionX + $moves[0];
                    $figureMoveY = $figure->currentPositionY + $moves[1];

                    $anyFigureAttack = self::checkKingMovePosition($figures, $figure, $figureMoveX, $figureMoveY);

                    if (empty($anyFigureAttack)) {
                        self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                    }
                }
            }
        } else if ($figures[31]->check == true) {
            if ($figure->name == 'king' && $figure->id == 32) {
                foreach ($figure->moves as $moves) {
                    $figureMoveX = $figure->currentPositionX - $moves[0];
                    $figureMoveY = $figure->currentPositionY - $moves[1];

                    $anyFigureAttack = self::checkKingMovePosition($figures, $figure, $figureMoveX, $figureMoveY);

                    if (empty($anyFigureAttack)) {
                        self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                    }
                }
            }
        } else {
            //moves
            foreach ($figure->moves as $moves) {
                if ($figure->color == 'white'
                    /*&& $whiteUser->id == \Yii::$app->user->id
                    && $game->move %2 != 0*/
                ) {

                    if ($figure->name == 'king') {
                        $figureMoveX = $figure->currentPositionX + $moves[0];
                        $figureMoveY = $figure->currentPositionY + $moves[1];

                        $anyFigureAttack = self::checkKingMovePosition($figures, $figure, $figureMoveX, $figureMoveY);

                        if (empty($anyFigureAttack)) {
                            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                        }
                    } else if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            $figureMoveX = $figure->currentPositionX + $moves[0] * $i;
                            $figureMoveY = $figure->currentPositionY + $moves[1] * $i;

                            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);

                            foreach ($figures as $item) {
                                if ($figureMoveX == $item->currentPositionX &&
                                    $figureMoveY == $item->currentPositionY
                                ) {

                                    break 2;
                                }
                            }
                        }
                    } else {
                        $figureMoveX = $figure->currentPositionX + $moves[0];
                        $figureMoveY = $figure->currentPositionY + $moves[1];
                        self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                    }
                } else if ($figure->color == 'black'
                    /*&& $blackUser->id == \Yii::$app->user->id
                    && $game->move %2 == 0*/
                ) {

                    if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            $figureMoveX = $figure->currentPositionX - $moves[0] * $i;
                            $figureMoveY = $figure->currentPositionY - $moves[1] * $i;
                            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);

                            foreach ($figures as $item) {
                                if ($figureMoveX == $item->currentPositionX &&
                                    $figureMoveY == $item->currentPositionY
                                ) {

                                    break 2;
                                }
                            }
                        }
                    } else {
                        $figureMoveX = $figure->currentPositionX - $moves[0];
                        $figureMoveY = $figure->currentPositionY - $moves[1];
                        self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game);
                    }
                }
            }

            foreach ($figure->attacks as $attack) {
                if ($figure->color == 'white'
                    /*&& $whiteUser->id == \Yii::$app->user->id && $game->move %2 != 0*/
                ) {

                    if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            $figureAttackX = $figure->currentPositionX + $attack[0] * $i;
                            $figureAttackY = $figure->currentPositionY + $attack[1] * $i;

                            self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game);

                            foreach ($figures as $item) {
                                if ($figureAttackX == $item->currentPositionX &&
                                    $figureAttackY == $item->currentPositionY
                                ) {
                                    break 2;
                                }
                            }
                        }
                    } else {
                        $figureAttackX = $figure->currentPositionX + $attack[0];
                        $figureAttackY = $figure->currentPositionY + $attack[1];
                        self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game);
                    }
                } else if ($figure->color == 'black') {
                    if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            $figureAttackX = $figure->currentPositionX - $attack[0] * $i;
                            $figureAttackY = $figure->currentPositionY - $attack[1] * $i;

                            self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game);

                            foreach ($figures as $item) {
                                if ($figureAttackX == $item->currentPositionX &&
                                    $figureAttackY == $item->currentPositionY
                                ) {
                                    break 2;
                                }
                            }
                        }
                    } else {
                        $figureAttackX = $figure->currentPositionX - $attack[0];
                        $figureAttackY = $figure->currentPositionY - $attack[1];
                        self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game);
                    }
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
                break;
            }
        }
    }

    public static function checkKingMovePosition($figures, KingComponent $king, $figureMoveX, $figureMoveY)
    {
        foreach ($figures as $figure) {
            if ($figure->color != $king->color) {
                foreach ($figure->attacks as $attack) {

                    if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook' &&
                        $figure->status == 'active'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            foreach ($figures as $item) {
                                if ($figure->currentPositionX - $attack[0] * $i == $item->currentPositionX &&
                                    $figure->currentPositionY - $attack[1] * $i == $item->currentPositionY &&
                                    $item->name != $king->name) {

                                    break 2;
                                } else if ($figure->currentPositionX - $attack[0] * $i == $figureMoveX &&
                                        $figure->currentPositionY - $attack[1] * $i == $figureMoveY) {

                                        return $figure;
                                    }
                            }
                        }
                    } else {
                        if ($figureMoveX == $figure->currentPositionX - $attack[0]  &&
                            $figureMoveY == $figure->currentPositionY - $attack[1]) {

                            return $figure;
                        }
                    }
                }
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
?>
