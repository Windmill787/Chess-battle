<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 23.03.17
 * Time: 11:25
 */

namespace frontend\widgets;

use app\models\Figure;
use yii\bootstrap\Widget;
use app\models\PlayPositions;
use yii\helpers\Html;

class Buttons extends Widget
{
    public static function widget($figures) {

        foreach ($figures as $item) {

            // default move
            $desiredPosition = $item->desiredMovePosition();

            if (empty($desiredPosition->figure_id)) {
                echo Html::submitButton('Move', [
                    'class' => 'btn btn-primary hidden move',
                    'name' => 'move' . $item->color . $item->name . $item->number,
                    'id' => 'move' . $item->name . $item->id
                ]);

                if ($item->name == 'pawn' && $item->currentPositionY == $item->startPositionY) {
                    $desiredPosition = $item->desiredFirstMovePosition();
                    if (empty($desiredPosition->figure_id)) {
                        echo Html::submitButton('Move +2', [
                            'class' => 'btn btn-primary hidden move',
                            'name' => 'firstMove' . $item->color . $item->name . $item->number,
                            'id' => 'firstMove' . $item->name . $item->id
                        ]);
                    }
                }
            }

            // attack move
            if ($item->color == 'white') {
                $desiredPosition = $item->desiredAttackPosition();
                if (empty($desiredPosition->figure_id) == false) {
                    $figure = Figure::findOne(['id' => $desiredPosition->figure_id]);
                    if ($figure->color != 'white') {
                        echo Html::submitButton('Attack ' . $figure->name, [
                            'class' => 'btn btn-danger hidden move',
                            'name' => 'attack' . $item->color . $item->name . $item->number,
                            'id' => 'attack' . $item->name . $item->id
                        ]);
                    }
                }
            } else if ($item->color == 'black') {
                $desiredPosition = $item->desiredAttackPosition();
                if (empty($desiredPosition->figure_id) == false) {
                    $figure = Figure::findOne(['id' => $desiredPosition->figure_id]);
                    if ($figure->color != 'black') {
                        echo Html::submitButton('Attack ' . $figure->name, [
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