<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 17.04.17
 * Time: 15:26
 */

namespace frontend\widgets;

use frontend\components\KingComponent;
use yii\base\Widget;

class CheckedKingMoves extends Widget
{
    public static function widget(KingComponent $king, $figures, $board, $game)
    {
        foreach ($king->moves as $moves) {
            $figureMoveX = $king->currentPositionX + $moves[0];
            $figureMoveY = $king->currentPositionY + $moves[1];

            $anyFigureAttack = Buttons::checkKingMovePosition($figures, $king, $figureMoveX, $figureMoveY);

            if (empty($anyFigureAttack)) {
                Buttons::checkPosition($figures, $figureMoveX, $figureMoveY, $king, $board, $game);
            }
        }
    }
}