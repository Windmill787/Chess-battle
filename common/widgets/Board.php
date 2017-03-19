<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 14.03.17
 * Time: 18:40
 */

namespace common\widgets;

use yii\helpers\Html;
use yii\bootstrap\Widget;
use yii\widgets\Pjax;

class Board extends Widget
{
    public static function widget($object, $figure)
    {
        Pjax::begin();
        echo Html::beginTag('table', [
            'class' => 'table-bordered'
        ]);
        echo Html::beginTag('tfoot');
        echo Html::beginTag('tr');
        foreach ($object->symbolLabel as $label) :

            echo Html::beginTag('th', [
                'style' => [
                    'text-align' => 'center',
                    'vertical-align' => 'middle'
                ]
            ]);
            echo Html::encode($label);
            echo Html::endTag('th');
        endforeach;
        echo Html::endTag('tr');
        echo Html::endTag('tfoot');

        for ($object->y = 8; $object->y >= 1; $object->y--) {

            echo Html::beginTag('tr');

            echo Html::beginTag('th', [
                'style' => [
                    'text-align' => 'center',
                    'vertical-align' => 'middle'
                ]
            ]);
            echo Html::encode($object->y);
            echo Html::endTag('th');

            for ($object->x = 1; $object->x <= 8; $object->x++) {

                $total = $object->y + $object->x;
                if ($total % 2 == 0) {

                    echo Html::beginTag('td', [
                        'height' => 50,
                        'width' => 50,
                        'bgcolor' => '#AF5200',
                        'align' => 'center',
                        'valign' => 'center'
                    ]);
                    foreach ($figure as $item) {
                        if ($object->x == $item->currentPositionX && $object->y == $item->currentPositionY) {
                            echo Html::img($item->image, [
                                'id' => 'figure1'
                            ]);
                        }
                    }
                    echo Html::endTag('td');

                } else {

                    echo Html::beginTag('td', [
                        'height' => 50,
                        'width' => 50,
                        'bgcolor' => '#FFFFFF',
                        'align' => 'center',
                        'valign' => 'center'
                    ]);

                    foreach ($figure as $item) {
                        if ($object->x == $item->currentPositionX && $object->y == $item->currentPositionY) {
                            echo Html::img($item->image, [
                                'id' => 'figure'
                            ]);
                        }
                    }

                    echo Html::endTag('td');

                }
            }
        }
        echo Html::endTag('tr');

        echo Html::endTag('table');
        echo Html::beginForm();
        echo Html::submitButton('Move pawn 1', [
            'class' => 'btn btn-primary hidden',
            'name' => 'pawn',
            'id' => 'pawn1'
        ]);
        echo Html::submitButton('Move pawn 2', [
            'class' => 'btn btn-primary hidden',
            'name' => 'pawn2',
            'id' => 'pawn2'
        ]);
        echo Html::endForm();

        Pjax::end();


    }
}