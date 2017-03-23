<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 23.03.17
 * Time: 11:25
 */

namespace common\widgets;

use app\models\Chessboard;
use app\models\Figure;
use yii\bootstrap\Widget;
use app\models\PlayPositions;
use yii\helpers\Html;

class Buttons extends Widget
{
    public static function widget($figures)
    {
        foreach ($figures as $item) {

            if ($item->color == 'white') {
                // default move
                $square = PlayPositions::findOne([
                    'current_x' => $item->currentPositionX + $item->moveX,
                    'current_y' => $item->currentPositionY + $item->moveY
                ]);

                if (empty($square->figure_id)) {
                    echo Html::submitButton('Move', [
                        'class' => 'btn btn-primary hidden move',
                        'name' => 'move' . $item->color . $item->name . $item->number,
                        'id' => 'move' . $item->name . $item->id
                    ]);

                    $square = PlayPositions::findOne([
                        'current_x' => $item->currentPositionX + $item->moveX,
                        'current_y' => $item->currentPositionY + $item->moveY + 1
                    ]);

                    if (empty($square->figure_id)) {
                        if ($item->name == 'pawn' && $item->currentPositionY == $item->startPositionY) {

                            echo Html::submitButton('Move +2', [
                                'class' => 'btn btn-primary hidden move',
                                'name' => 'firstMove' . $item->color . $item->name . $item->number,
                                'id' => 'firstMove' . $item->name . $item->id
                            ]);
                        }
                    }
                }

                // first move

                // attack move
                $square = PlayPositions::findOne([
                    'current_x' => $item->currentPositionX + $item->attackX,
                    'current_y' => $item->currentPositionY + $item->attackY
                ]);

                if (empty($square->figure_id) == false) {
                    $figure = Figure::findOne(['id' => $square->figure_id]);
                    if ($figure->color != 'white') {
                        echo Html::submitButton('Attack '.$figure->name, [
                            'class' => 'btn btn-danger hidden move',
                            'name' => 'attack' . $item->color . $item->name . $item->number,
                            'id' => 'attack' . $item->name . $item->id,
                            'onclick' => 'hideVictim('.$figure->id.')'
                        ]);
                    }
                }
            }

            if ($item->color == 'black') {
                // default move
                $square = PlayPositions::findOne([
                    'current_x' => $item->currentPositionX - $item->moveX,
                    'current_y' => $item->currentPositionY - $item->moveY
                ]);

                if (empty($square->figure_id)) {
                    echo Html::submitButton('Move', [
                        'class' => 'btn btn-primary hidden move',
                        'name' => 'move' . $item->color . $item->name . $item->number,
                        'id' => 'move' . $item->name . $item->id
                    ]);
                }

                // first move
                $square = PlayPositions::findOne([
                    'current_x' => $item->currentPositionX - $item->moveX,
                    'current_y' => $item->currentPositionY - $item->moveY - 1
                ]);

                if (empty($square->figure_id)) {
                    if ($item->name == 'pawn' && $item->currentPositionY == $item->startPositionY) {

                        echo Html::submitButton('Move +2', [
                            'class' => 'btn btn-primary hidden move',
                            'name' => 'firstMove' . $item->color . $item->name . $item->number,
                            'id' => 'firstMove' . $item->name . $item->id
                        ]);
                    }
                }

                // attack move
                $square = PlayPositions::findOne([
                    'current_x' => $item->currentPositionX - $item->attackX,
                    'current_y' => $item->currentPositionY - $item->attackY
                ]);

                if (empty($square->figure_id) == false) {
                    $figure = Figure::findOne(['id' => $square->figure_id]);
                    if ($figure->color != 'black') {
                        echo Html::submitButton('Attack '.$figure->name, [
                            'class' => 'btn btn-danger hidden move',
                            'name' => 'attack' . $item->color . $item->name . $item->number,
                            'id' => 'attack' . $item->name . $item->id
                        ]);
                    }
                }
            }
        }
    }
}