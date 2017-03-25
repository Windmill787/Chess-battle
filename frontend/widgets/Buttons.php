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

class Buttons extends Widget
{
    public static function widget(BoardComponent $board, FigureComponent $figure)
    {
        if ($figure->color == 'white') {

            if ($board->x == $figure->currentPositionX + $figure->moveX &&
                $board->y == $figure->currentPositionY + $figure->moveY) {
                MoveButton::widget($figure);
            }

            if ($board->x == $figure->currentPositionX + $figure->moveX &&
                $board->y == $figure->currentPositionY + $figure->moveY + 1) {
                FirstMoveButton::widget($figure);
            }

            foreach ($figure->attackX as $attackX) {
                foreach ($figure->attackY as $attackY) {
                    if ($board->x == $figure->currentPositionX + $attackX &&
                        $board->y == $figure->currentPositionY + $attackY) {
                        AttackButton::widget($figure);
                    }
                }
            }

        } else if ($figure->color == 'black') {

            if ($board->x == $figure->currentPositionX - $figure->moveX &&
                $board->y == $figure->currentPositionY - $figure->moveY) {
                MoveButton::widget($figure);
            }

            if ($board->x == $figure->currentPositionX - $figure->moveX &&
                $board->y == $figure->currentPositionY - $figure->moveY - 1) {
                FirstMoveButton::widget($figure);
            }

            foreach ($figure->attackX as $attackX) {
                foreach ($figure->attackY as $attackY) {
                    if ($board->x == $figure->currentPositionX - $attackX &&
                        $board->y == $figure->currentPositionY - $attackY) {
                        AttackButton::widget($figure);
                    }
                }
            }

        }
    }
}