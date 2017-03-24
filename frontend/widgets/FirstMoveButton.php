<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 24.03.17
 * Time: 16:08
 */

namespace frontend\widgets;

use app\models\Figure;
use frontend\components\FigureComponent;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class FirstMoveButton extends Widget
{
    public static function widget($figure)
    {
        $desiredPosition = $figure->desiredMovePosition();
        if (empty($desiredPosition->figure_id) || $desiredPosition->status == 'killed') {
            if ($figure->name == 'pawn' && $figure->currentPositionY == $figure->startPositionY) {
                $desiredPosition = $figure->desiredFirstMovePosition();
                if (empty($desiredPosition->figure_id) || $desiredPosition->status == 'killed') {
                    echo Html::submitButton('Move', [
                        'class' => 'btn btn-xs btn-primary hidden move',
                        'name' => 'firstMove' . $figure->color . $figure->name . $figure->number,
                        'id' => 'firstMove' . $figure->name . $figure->id
                    ]);
                }
            }
        }
    }
}