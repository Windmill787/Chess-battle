<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:52
 */

/* @var $this yii\web\View */
/* @var $figures \frontend\components\FigureComponent */
/* @var $board \frontend\components\BoardComponent */
/* @var $model \app\models\Game */
/* @var $whiteUser \common\models\User */
/* @var $blackUser \common\models\User */
/* @var $history \app\models\History */
/* @var $playPositions \app\models\PlayPositions */

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\widgets\Board;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Play');
?>
<div class="game-play">

    <div class="col-lg-6">
        <div class="row thumbnail">
            <div class="caption">

                <?= Board::widget($board, $figures, $whiteUser, $blackUser, $playPositions); ?>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row thumbnail" align="right">
            <div class="caption">
                <?php
                echo Html::beginTag('p');
                echo Html::encode(Yii::t('app', 'Moves'));
                echo Html::endTag('p');
                ?>
                <div class="thumbnail">
                    <div class="caption pre-scrollable thumbnail-history" id="thumbnail-history">

                        <?php

                        echo Html::beginTag('table', [
                            'class' => 'table table-condensed table-hover'
                        ]);
                        if (empty($history) == false) {
                            foreach ($history as $item) {
                                $figure = \app\models\Figure::findOne($item->figure_id);
                                echo Html::beginTag('tbody');
                                echo Html::beginTag('tr');

                                echo Html::beginTag('td');
                                echo Html::encode($figure->name);
                                echo Html::endTag('td');

                                echo Html::beginTag('td');
                                echo Html::encode($board->symbolLabel[$item->to_x]);
                                echo Html::endTag('td');

                                echo Html::beginTag('td');
                                echo Html::encode($item->to_y);
                                echo Html::endTag('td');
                                echo Html::endTag('tr');
                                echo Html::endTag('tbody');
                            }
                        }
                        echo Html::endTag('table');
                        ?>

                    </div>
                </div>

                    <?php /*Modal::begin([
                        'header' => '<h2 align="center">You lose!</h2>',
                        'toggleButton' => [
                            'label' => Yii::t('app', 'Resign'),
                            'class' => 'btn btn-danger',
                            'id' => 'resignButton'
                        ],
                    ]);
                    echo 'You lose';
                    echo Html::button(Yii::t('app', 'Back'),
                        ['class' => 'btn btn-primary']);
                    Modal::end();*/
                    ?>

                    <?php
                    print_r($figures[15]->check);
                    echo Html::beginForm();
                    echo Html::submitButton('New game', [
                        'class' => 'btn btn-primary',
                        'name' => 'back'
                    ]);
                    echo Html::endForm();
                    ?>

            </div>
        </div>
    </div>
</div>
<?php

if ($whiteUser->id != \Yii::$app->user->id && $blackUser->id != \Yii::$app->user->id) {
    $script = <<< JS
                    $(document).ready(function() {
                        setInterval(function(){ $("#refreshButton").click(); }, 7000);
                    });
JS;
    $this->registerJs($script);
}
?>
<?php Pjax::begin(); ?>
<?= Html::a("Refresh", ['game/play?id='.$model->id], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']) ?>
<?php Pjax::end(); ?>
<?php //acceptance tests, jenkins, selenium, driver, config(WebDriver: url, browser(better firefox, chrome), Yii parts, config...
        //fixture-data from tables, -f -fails(codeseption),
        //consept build, run ) ?>