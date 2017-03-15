<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:52
 */

/* @var $this yii\web\View */
/* @var $whitePawn \frontend\components\PawnComponent */

use yii\helpers\Html;
use russ666\widgets\Countdown;
use yii\bootstrap\Modal;
use common\widgets\ChessBoard;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Play');
//$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">

                <h1>
                    <div class="label label-default">
                        <?= Countdown::widget([
                            'id' => 'enemy',
                            'datetime' => date('Y-m-d H:i:s O', time() + 0),
                            'format' => '%M:%S'
                        ])
                        ?>
                    </div>
                </h1>
                <?php Pjax::begin() ?>

                <?php
                if (Yii::$app->request->post()) {
                    $whitePawn->startPositionRow = $whitePawn->startPositionRow + 2;
                }

                $symbolLabel = [
                    '','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
                ];

                echo Html::beginTag('table', [
                    'class' => 'table-bordered'
                ]);
                echo Html::beginTag('tfoot');
                echo Html::beginTag('tr');
                foreach($symbolLabel as $label) :

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
                            if ($row == $whitePawn->startPositionRow && $col == $whitePawn->startPositionCol) {
                                echo Html::img($whitePawn->image);
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

                            if ($row == $whitePawn->startPositionRow && $col == $whitePawn->startPositionCol) {
                                echo Html::img($whitePawn->image);
                            }

                            echo Html::endTag('td');
                        }
                    }
                }
                echo Html::endTag('tr');

                echo Html::endTag('table');

                ?>

                <?= Html::beginForm(); ?>

                <?= Html::submitButton('Move pawn', [
                    'class' => 'btn btn-primary',
                    'name' => 'pawn-button'

                ]) ?>

                <?= Html::endForm() ?>

                <?php Pjax::end() ?>

                <h1>
                    <div class="label label-default">
                        <?= Countdown::widget([
                            'id' => 'my',
                            'datetime' => date('Y-m-d H:i:s O', time() + 0),
                            'format' => '%M:%S'
                        ])
                        ?>
                    </div>
                </h1>

            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="row thumbnail" align="right">
            <div class="caption">

                <div class="form-group">
                    <?= Html::button(Yii::t('app', 'Me'),
                        ['class' => 'btn btn-primary', 'id' => 'myMoveButton']) ?>

                    <?= Html::button(Yii::t('app', 'Enemy'),
                        ['class' => 'btn btn-primary', 'id' => 'enemyMoveButton']) ?>
                </div>

                <div class="thumbnail">
                    <div class="caption">

                    </div>
                </div>

                <div class="form-group">

                    <?php Modal::begin([
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
                    Modal::end();
                    ?>

                    <?= Html::button(Yii::t('app', 'Offer Draw'),
                        ['class' => 'btn btn-primary', 'id' => 'drawButton']) ?>

                </div>

            </div>
        </div>
    </div>

<?php //acceptance tests, jenkins, selenium, driver, config(WebDriver: url, browser(better firefox, chrome), Yii parts, config...
        //fixture-data from tables, -f -fails(codeseption),
        //consept build, run ) ?>