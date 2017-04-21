<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 26.03.17
 * Time: 12:57
 */

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class BoardSquare extends Widget
{
    public static function widget($color, $board, $figures, $whiteUser, $blackUser, $game, $playPositions)
    {
        echo Html::beginTag('td', [
            'height' => 60,
            'width' => 60,
            'bgcolor' => $color,
            'align' => 'center',
            'valign' => 'center'
        ]);
        foreach ($figures as $figure) {

            if ($board->x == $figure->currentPositionX && $board->y == $figure->currentPositionY) {
                if ($figure->status != 'killed') {
                    if ($figure->name == 'king' && $figure->check == true) {
                        echo Html::img($figure->image, [
                            'id' => 'figure' . $figure->id,
                            'onclick' => "light(" . $figure->name . ', ' . $figure->id . ")",
                            'style' => [
                                'border' => '2px solid red',
                                'width' => '60px',
                                'height' => '60px',
                                'z-index' => '1000'
                            ]
                        ]);
                    } else {
                        echo Html::img($figure->image, [
                            'id' => 'figure' . $figure->id,
                            'onclick' => "light(" . $figure->name . ', ' . $figure->id . ")",
                            'style' => [
                                'width' => '60px',
                                'height' => '60px',
                                'z-index' => '1000'
                            ]
                        ]);
                    }
                }
            }

            if ($figure->name == 'pawn') {
                FirstMoveButton::widget($figures, $figure, $board, $whiteUser, $blackUser, $game, $playPositions);
            }
            if ($figure->name == 'king') {
                CastlingButton::widget($figures, $figure, $board, $whiteUser, $blackUser, $game, $playPositions);
            }
            Buttons::widget($figures, $figure, $board, $whiteUser, $blackUser, $game, $playPositions);
        }
        echo Html::endTag('td');
    }
}