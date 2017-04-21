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
use yii\widgets\ActiveForm;

class FirstMoveButton extends Widget
{
    public static function widget($figures, PawnComponent $figure, $board, $whiteUser, $blackUser, $game, $playPositions) {

        if ($figure->color == 'white' && $whiteUser->id == \Yii::$app->user->id && $game->move %2 != 0) {
            $figureMoveX = $figure->currentPositionX + $figure->first_move[0];
            $figureMoveY = $figure->currentPositionY + $figure->first_move[1];
            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $playPositions);
        } else if ($figure->color == 'black' && $blackUser->id == \Yii::$app->user->id && $game->move %2 == 0) {
            $figureMoveX = $figure->currentPositionX - $figure->first_move[0];
            $figureMoveY = $figure->currentPositionY - $figure->first_move[1];
            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $playPositions);
        }
    }

    public static function checkFigure($figures, $figure, $figureMoveX, $figureMoveY) {
        foreach ($figures as $item) {
            if ($figure->color == 'white') {
                if ($item->currentPositionX == $figureMoveX &&
                    $item->currentPositionY == $figureMoveY - 1
                ) {

                    return $item;
                }
            } else if ($figure->color == 'black') {
                if ($item->currentPositionX == $figureMoveX &&
                    $item->currentPositionY == $figureMoveY + 1
                ) {

                    return $item;
                }
            }
            if ($item->currentPositionX == $figureMoveX &&
                $item->currentPositionY == $figureMoveY) {

                return $item;
            }
        }
    }

    public static function checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $playPositions) {

        $figuresOnPosition = self::checkFigure($figures, $figure, $figureMoveX, $figureMoveY);

        if (empty($figuresOnPosition) &&
            $figure->currentPositionX == $figure->startPositionX &&
            $figure->currentPositionY == $figure->startPositionY) {
            if ($board->x == $figureMoveX &&
                $board->y == $figureMoveY) {

                foreach ($playPositions as $playPosition) {
                    if ($figure->id == $playPosition->figure_id) {
                        $form = ActiveForm::begin([
                            'options'=>
                                [
                                    'style' => [
                                        'position' => 'absolute',
                                        'margin-left' =>  '9px',
                                        'margin-top' => '-25px'
                                    ]
                                ]
                        ]);

                        echo $form->field($playPosition, "id")
                            ->label(false)->hiddenInput();

                        echo $form->field($playPosition, "current_x")
                            ->label(false)->hiddenInput(['value' => $figureMoveX]);

                        echo $form->field($playPosition, "current_y")
                            ->label(false)->hiddenInput(['value' => $figureMoveY]);

                        echo Html::submitButton(\Yii::t('app', 'Move'), [
                            'class' => 'btn btn-xs btn-primary hidden move move' . $figure->id,
                            'onclick' => 'hideButtons()'
                        ]);
                        ActiveForm::end();
                    }
                }
            }
        }
    }
}