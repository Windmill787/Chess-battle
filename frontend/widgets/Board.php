<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 14.03.17
 * Time: 18:40
 */

namespace frontend\widgets;

use common\models\User;
use frontend\components\BoardComponent;
use yii\helpers\Html;
use yii\bootstrap\Widget;

class Board extends Widget
{
    public static function widget(BoardComponent $board, $figures, $whiteUser, $blackUser, $game)
    {
        echo Html::beginTag('table', [
            'class' => 'table-bordered'
        ]);
        echo Html::beginTag('tfoot');
        echo Html::beginTag('tr');

        if ($blackUser->id == \Yii::$app->user->id) {

            PhotoAndName::enemyPhoto($whiteUser, $whiteUser, $blackUser);

            foreach ($board->reversedSymbolLabel as $label) :

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
                for ($board->y = 1; $board->y <= 8; $board->y++) {

                    echo Html::beginTag('tr');

                    echo Html::beginTag('th', [
                        'width' => 20,
                        'style' => [
                            'text-align' => 'center'
                        ]
                    ]);
                    echo Html::encode($board->y);
                    echo Html::endTag('th');

                    for ($board->x = 8; $board->x >= 1; $board->x--) {

                        $total = $board->y + $board->x;
                        if ($total % 2 == 0) {

                            BoardSquare::widget('#AF5200', $board, $figures, $whiteUser, $blackUser, $game);

                        } else {

                            BoardSquare::widget('#FFFFFF', $board, $figures, $whiteUser, $blackUser, $game);

                        }
                    }
                }
            } else {

            PhotoAndName::enemyPhoto($blackUser, $whiteUser, $blackUser);

            foreach ($board->symbolLabel as $label) :

                echo Html::beginTag('th', [
                    'width' => 20,
                    'style' => [
                        'text-align' => 'center'
                    ]
                ]);
                echo Html::encode($label);
                echo Html::endTag('th');
            endforeach;
            echo Html::endTag('tr');
            echo Html::endTag('tfoot');

            for ($board->y = 8; $board->y >= 1; $board->y--) {

                echo Html::beginTag('tr');

                echo Html::beginTag('th', [
                    'style' => [
                        'text-align' => 'center',
                        'vertical-align' => 'middle'
                    ]
                ]);
                echo Html::encode($board->y);
                echo Html::endTag('th');

                for ($board->x = 1; $board->x <= 8; $board->x++) {

                    $total = $board->y + $board->x;
                    if ($total % 2 == 0) {

                        BoardSquare::widget('#AF5200', $board, $figures, $whiteUser, $blackUser, $game);

                    } else {

                        BoardSquare::widget('#FFFFFF', $board, $figures, $whiteUser, $blackUser, $game);

                    }
                }
            }
        }
        echo Html::endTag('tr');

        echo Html::endTag('table');

        PhotoAndName::myPhoto($whiteUser, $blackUser);
    }
}