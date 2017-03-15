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

class ChessBoard extends Widget
{
    public $symbolLabel = [
        '','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
    ];

    public function init()
    {
        echo Html::beginTag('table', [
            'class' => 'table-bordered'
        ]);
        echo Html::beginTag('tfoot');
        echo Html::beginTag('tr');
        foreach($this->symbolLabel as $label) :

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

        for($row=8;$row>=1;$row--) {

            echo Html::beginTag('tr');

            echo Html::beginTag('th', [
                'style' => [
                    'text-align' => 'center',
                    'vertical-align' => 'middle'
                ]
            ]);
            echo Html::encode($row);
            echo Html::endTag('th');

            for ($col = 1; $col <= 8; $col++) {
                $total = $row + $col;
                if ($total % 2 == 0) {

                    echo Html::beginTag('td', [
                        'height' => 50,
                        'width' => 50,
                        'bgcolor' => '#AF5200',
                        'align' => 'center',
                        'valign' => 'center'
                    ]);
                    /*if ($row == $whitePawn->startPositionRow && $col == $whitePawn->startPositionCol) {
                        echo Html::img($whitePawn->image);
                    }*/
                    echo Html::endTag('td');

                } else {

                    echo Html::beginTag('td', [
                        'height' => 50,
                        'width' => 50,
                        'bgcolor' => '#FFFFFF',
                        'align' => 'center',
                        'valign' => 'center'
                    ]);

                    /*if ($row == $whitePawn->startPositionRow && $col == $whitePawn->startPositionCol) {
                        echo Html::img($whitePawn->image);
                    }*/

                    echo Html::endTag('td');
                }
            }
        }
        echo Html::endTag('tr');

        echo Html::endTag('table');
    }
}