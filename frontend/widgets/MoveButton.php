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

class MoveButton extends Widget
{
    public static function widget(FigureComponent $figure, $board) {

        foreach ($figure->moves as $moves) {
                if ($figure->color == 'white') {
                    $figureMoveX = $figure->currentPositionX + $moves[0];
                    $figureMoveY = $figure->currentPositionY + $moves[1];

                    self::displayButton($figureMoveX, $figureMoveY, $figure, $board);

                } else if ($figure->color == 'black') {
                    $figureMoveX = $figure->currentPositionX - $moves[0];
                    $figureMoveY = $figure->currentPositionY - $moves[1];

                    self::displayButton($figureMoveX, $figureMoveY, $figure, $board);
                }
        }
    }

    public static function displayButton($figureMoveX, $figureMoveY, $figure, $board) {
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
}