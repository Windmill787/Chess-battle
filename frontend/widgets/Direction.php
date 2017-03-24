<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 15:49
 */

namespace frontend\widgets;

use frontend\components\BoardComponent;
use frontend\components\FigureComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class Direction extends Widget
{
    public static function widget(BoardComponent $board, FigureComponent $figure)
    {
        if ($figure->color == 'white') {

            if ($board->x == $figure->currentPositionX + $figure->moveX &&
                $board->y == $figure->currentPositionY + $figure->moveY) {
                echo Html::beginForm();
                MoveButton::widget($figure);
                echo Html::endForm();
            }

                if ($board->x == $figure->currentPositionX + $figure->moveX &&
                    $board->y == $figure->currentPositionY + $figure->moveY + 1) {
                    echo Html::beginForm();
                    FirstMoveButton::widget($figure);
                    echo Html::endForm();
                }

            if ($board->x == $figure->currentPositionX + $figure->attackX &&
                $board->y == $figure->currentPositionY + $figure->attackY) {
                echo Html::beginForm();
                AttackButton::widget($figure);
                echo Html::endForm();
            }
        } else if ($figure->color == 'black') {

            if ($board->x == $figure->currentPositionX - $figure->moveX &&
                $board->y == $figure->currentPositionY - $figure->moveY) {
                echo Html::beginForm();
                MoveButton::widget($figure);
                echo Html::endForm();

                if ($board->x == $figure->currentPositionX - $figure->moveX &&
                    $board->y == $figure->currentPositionY - $figure->moveY - 1) {
                    echo Html::beginForm();
                    FirstMoveButton::widget($figure);
                    echo Html::endForm();
                }
            }

            if ($board->x == $figure->currentPositionX - $figure->attackX &&
                $board->y == $figure->currentPositionY - $figure->attackY) {
                echo Html::beginForm();
                AttackButton::widget($figure);
                echo Html::endForm();
            }
        }
    }
}