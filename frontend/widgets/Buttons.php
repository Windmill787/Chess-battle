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
use yii\widgets\ActiveForm;

class Buttons extends Widget
{
    public static function widget($figures, $figure, $board, $whiteUser, $blackUser, $game, $playPositions)
    {
            foreach ($figure->moves as $moves) {
                if ($figure->color == 'white'
                    && $whiteUser->id == \Yii::$app->user->id
                    && $game->move %2 != 0
                ) {

                    if ($figure->name == 'king') {
                        $figureMoveX = $figure->currentPositionX + $moves[0];
                        $figureMoveY = $figure->currentPositionY + $moves[1];

                        $anyFigureAttack = self::checkKingMovePosition($figures, $figure, $figureMoveX, $figureMoveY);

                        if (empty($anyFigureAttack)) {
                            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);
                        }
                    } else if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            $figureMoveX = $figure->currentPositionX + $moves[0] * $i;
                            $figureMoveY = $figure->currentPositionY + $moves[1] * $i;

                            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);

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
                        /*if ($figure->currentPositionY == 7) {
                            self::checkPawnMorph($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);
                        } else {*/
                        self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);
                    }
                } else if ($figure->color == 'black'
                    && $blackUser->id == \Yii::$app->user->id
                    && $game->move %2 == 0
                ) {

                    if ($figure->name == 'king') {
                        $figureMoveX = $figure->currentPositionX - $moves[0];
                        $figureMoveY = $figure->currentPositionY - $moves[1];

                        $anyFigureAttack = self::checkKingMovePosition($figures, $figure, $figureMoveX, $figureMoveY);

                        if (empty($anyFigureAttack)) {
                            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);
                        }
                    } else if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            $figureMoveX = $figure->currentPositionX - $moves[0] * $i;
                            $figureMoveY = $figure->currentPositionY - $moves[1] * $i;
                            self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);

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
                        /*if ($figure->currentPositionY == 7) {
                            self::checkPawnMorph($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);
                        } else {*/
                        self::checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);
                    }
                }
            }

            foreach ($figure->attacks as $attack) {
                if ($figure->color == 'white' &&
                    $whiteUser->id == \Yii::$app->user->id &&
                    $game->move %2 != 0
                ) {

                    if ($figure->name == 'king') {
                        $figureMoveX = $figure->currentPositionX + $attack[0];
                        $figureMoveY = $figure->currentPositionY + $attack[1];

                        $anyFigureAttack = self::checkKingAttackPosition($figures, $figure, $figureMoveX, $figureMoveY);

                        if (empty($anyFigureAttack)) {
                            self::checkEnemyFigure($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);
                        }
                    } else if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            $figureAttackX = $figure->currentPositionX + $attack[0] * $i;
                            $figureAttackY = $figure->currentPositionY + $attack[1] * $i;

                            self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game, $playPositions);

                            $king = $figures[31];

                            if ($figureAttackX == $king->currentPositionX &&
                                $figureAttackY == $king->currentPositionY
                            ) {
                                $king->check = true;
                            }
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
                        self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game, $playPositions);
                        $king = $figures[31];

                        if ($figureAttackX == $king->currentPositionX &&
                            $figureAttackY == $king->currentPositionY
                        ) {
                            $king->check = true;
                        }
                    }
                } else if ($figure->color == 'black' &&
                    $blackUser->id == \Yii::$app->user->id &&
                    $game->move %2 == 0
                ) {

                    if ($figure->name == 'king') {
                        $figureMoveX = $figure->currentPositionX - $attack[0];
                        $figureMoveY = $figure->currentPositionY - $attack[1];

                        $anyFigureAttack = self::checkKingAttackPosition($figures, $figure, $figureMoveX, $figureMoveY);

                        if (empty($anyFigureAttack)) {
                            self::checkEnemyFigure($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions);
                        }
                    } else if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            $figureAttackX = $figure->currentPositionX - $attack[0] * $i;
                            $figureAttackY = $figure->currentPositionY - $attack[1] * $i;

                            self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game, $playPositions);
                            $king = $figures[15];

                            if ($figureAttackX == $king->currentPositionX &&
                                $figureAttackY == $king->currentPositionY
                            ) {
                                $king->check = true;
                            }

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
                        self::checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game, $playPositions);
                        $king = $figures[15];

                        if ($figureAttackX == $king->currentPositionX &&
                            $figureAttackY == $king->currentPositionY
                        ) {
                            $king->check = true;
                        }
                    }
                }
            }
    }

    public static function checkEnemyFigure($figures, $figureAttackX, $figureAttackY, $figure, $board, $game, $playPositions)
    {
        foreach ($figures as $item) {
            if ($item->currentPositionX == $figureAttackX &&
                $item->currentPositionY == $figureAttackY &&
                $board->x == $figureAttackX &&
                $board->y == $figureAttackY &&
                $item->color != $figure->color) {
                foreach ($playPositions as $playPosition) {
                    if ($figure->id == $playPosition->figure_id) {
                        $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'options' => [
                                    'tag' => false,
                                ],
                            ],
                            'options'=>
                                [
                                    'style' => [
                                        'position' => 'absolute',
                                        'margin-left' =>  '7px',
                                        'margin-top' => '-10px'
                                    ]
                                ]
                        ]);

                        echo $form->field($playPosition, "id")
                            ->label(false)->hiddenInput();

                        echo $form->field($playPosition, "current_x")
                            ->label(false)->hiddenInput(['value' => $figureAttackX]);

                        echo $form->field($playPosition, "current_y")
                            ->label(false)->hiddenInput(['value' => $figureAttackY]);

                        echo Html::submitButton(\Yii::t('app', 'Attack'), [
                            'class' => 'btn btn-xs btn-danger hidden attack attack' . $figure->id,
                            'onclick' => 'hideButtons()'
                        ]);
                        ActiveForm::end();
                    }
                }
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
            if ($figure->color == 'black') {
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
            } else if ($figure->color == 'white') {
                foreach ($figure->attacks as $attack) {

                    if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook' &&
                        $figure->status == 'active'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            foreach ($figures as $item) {
                                if ($figure->currentPositionX + $attack[0] * $i == $item->currentPositionX &&
                                    $figure->currentPositionY + $attack[1] * $i == $item->currentPositionY &&
                                    $item->name != $king->name) {

                                    break 2;
                                } else if ($figure->currentPositionX + $attack[0] * $i == $figureMoveX &&
                                    $figure->currentPositionY + $attack[1] * $i == $figureMoveY) {

                                    return $figure;
                                }
                            }
                        }
                    } else {
                        if ($figureMoveX == $figure->currentPositionX + $attack[0]  &&
                            $figureMoveY == $figure->currentPositionY + $attack[1]) {

                            return $figure;
                        }
                    }
                }
            }
        }
    }

    public static function checkKingAttackPosition($figures, KingComponent $king, $figureMoveX, $figureMoveY) {
        foreach ($figures as $figure) {
            if ($figure->color == 'black') {
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
            } else if ($figure->color == 'white') {
                foreach ($figure->attacks as $attack) {

                    if ($figure->name == 'bishop' ||
                        $figure->name == 'queen' ||
                        $figure->name == 'rook' &&
                        $figure->status == 'active'
                    ) {
                        for ($i = 1; $i <= 8; $i++) {
                            foreach ($figures as $item) {
                                if ($figure->currentPositionX + $attack[0] * $i == $item->currentPositionX &&
                                    $figure->currentPositionY + $attack[1] * $i == $item->currentPositionY &&
                                    $item->name != $king->name) {

                                    break 2;
                                } else if ($figure->currentPositionX + $attack[0] * $i == $figureMoveX &&
                                    $figure->currentPositionY + $attack[1] * $i == $figureMoveY) {

                                    return $figure;
                                }
                            }
                        }
                    } else {
                        if ($figureMoveX == $figure->currentPositionX + $attack[0]  &&
                            $figureMoveY == $figure->currentPositionY + $attack[1]) {

                            return $figure;
                        }
                    }
                }
            }
        }
    }

    public static function checkPosition($figures, $figureMoveX, $figureMoveY, $figure, $board, $game, $playPositions)
    {
        $anyFigure = self::checkAnyFigure($figures, $figureMoveX, $figureMoveY);

        if (empty($anyFigure) && $board->x == $figureMoveX && $board->y == $figureMoveY) {

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
?>
