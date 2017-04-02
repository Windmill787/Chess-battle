<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 31.03.17
 * Time: 14:49
 */

namespace frontend\widgets;

use frontend\components\RookComponent;
use yii\base\Widget;

class RookCastling extends Widget
{
    public static function widget(RookComponent $rook, $castling, $king) {
        if ($castling[0] == 2) {
            if ($rook->color == $king->color && $rook->number == $castling[0]) {
                $rook->currentPositionX = $rook->currentPositionX - $castling [0];
            }

        } else if ($castling[0] == -2) {
            if ($rook->color == $king->color && $rook->number == $castling[0]) {
                $rook->currentPositionX = $rook->currentPositionX - $castling [0] + 1;
            }
        }
    }
}