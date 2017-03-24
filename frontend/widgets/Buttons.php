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

        foreach ($figures as $figure) {

            // default move
            $desiredPosition = $figure->desiredMovePosition();

            if (empty($desiredPosition->figure_id) || $desiredPosition->status == 'killed') {
                echo Html::submitButton('Move', [
                    'class' => 'btn btn-primary hidden move',
                    'name' => 'move' . $figure->color . $figure->name . $figure->number,
                    'id' => 'move' . $figure->name . $figure->id
                ]);

                if ($figure->name == 'pawn' && $figure->currentPositionY == $figure->startPositionY) {
                    $desiredPosition = $figure->desiredFirstMovePosition();
                    if (empty($desiredPosition->figure_id) || $desiredPosition->status == 'killed') {
                        echo Html::submitButton('Move +2', [
                            'class' => 'btn btn-primary hidden move',
                            'name' => 'firstMove' . $figure->color . $figure->name . $figure->number,
                            'id' => 'firstMove' . $figure->name . $figure->id
                        ]);
                    }
                }
            }

            // attack move
            $desiredPosition = $figure->desiredAttackPosition();

            if (empty($desiredPosition->figure_id) == false && $desiredPosition->status == 'active') {
                $desiredFigure = Figure::findOne(['id' => $desiredPosition->figure_id]);
                if ($desiredFigure->color != $figure->color && $desiredFigure->status == 'active') {
                    echo Html::submitButton('Attack ' . $desiredFigure->name, [
                        'class' => 'btn btn-danger hidden move',
                        'name' => 'attack' . $figure->color . $figure->name . $figure->number,
                        'id' => 'attack' . $figure->name . $figure->id
                    ]);
                }
            }
        }
    }
}