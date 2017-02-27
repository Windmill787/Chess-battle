<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:52
 */

/* @var $this yii\web\View */
/* @var $pawn \frontend\components\FigureComponent */
/* @var $knight \frontend\components\FigureComponent */
/* @var $bishop \frontend\components\FigureComponent */
/* @var $king \frontend\components\FigureComponent */
/* @var $queen \frontend\components\FigureComponent */
/* @var $rook \frontend\components\FigureComponent */

use yii\helpers\Html;
use russ666\widgets\Countdown;
use yii\bootstrap\Modal;
use Ryanhs\Chess\Chess;

$this->title = Yii::t('app', 'Game');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">

                <h1>
                    <div class="label label-default" id="enemy">
                        <?= Countdown::widget([
                            'datetime' => date('Y-m-d H:i:s O', time() + 600),
                            'format' => '%M:%S'
                        ])
                        ?>
                    </div>
                </h1>

                <?= Html::img($pawn->image) ?>

                <?= Html::img($knight->image) ?>

                <?= Html::img($bishop->image) ?>

                <?= Html::img($rook->image) ?>

                <?= Html::img($king->image) ?>

                <?= Html::img($queen->image) ?>

                <?= Html::beginTag('table', [
                    'class' => 'table-bordered'
                ]); ?>

                    <?php $symbolLabel = [
                        '','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
                    ];
                    foreach($symbolLabel as $label) : ?>

                        <?= Html::beginTag('th', [
                            'style' => [
                                'text-align' => 'center',
                                'vertical-align' => 'middle'
                            ]
                        ]); ?>
                        <?= Html::encode($label); ?>
                        <?= Html::endTag('th'); ?>

                    <?php endforeach;

                    for($row=8;$row>=1;$row--) { ?>

                        <?= Html::beginTag('tr'); ?>

                        <?= Html::beginTag('th', [
                            'style' => [
                                'text-align' => 'center',
                                'vertical-align' => 'middle'
                            ]
                        ]); ?>
                        <?= Html::encode($row); ?>
                        <?= Html::endTag('th'); ?>

                        <?php
                        for ($col = 1; $col <= 8; $col++) {
                            $total = $row + $col;
                            if ($total % 2 == 0) { ?>

                                <?= Html::beginTag('td', [
                                    'height' => 50,
                                    'width' => 50,
                                    'bgcolor' => '#FFFFFF'
                                ]); ?>
                                <?= $symbolLabel[$col].$row ?>
                                <?= Html::endTag('td'); ?>

                            <?php } else { ?>

                                <?= Html::beginTag('td', [
                                    'height' => 50,
                                    'width' => 50,
                                    'bgcolor' => '#AF5200'
                                ]); ?>
                                <?= $symbolLabel[$col].$row ?>
                                <?= Html::endTag('td'); ?>
                            <?php }
                        }
                    } ?>
                        <?= Html::endTag('tr'); ?>

                <?= Html::endTag('table'); ?>

                <h1>
                    <div class="label label-default" id="clockMy">
                        <?= Countdown::widget([
                            'datetime' => date('Y-m-d H:i:s O', time() + 600),
                            'format' => '%M:%S',
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
                    <?php /* Html::button(Yii::t('app', 'Start'),
                        ['class' => 'btn btn-success', 'id' => 'startButton']) */ ?>


                    <?php
                    Modal::begin([
                        'header' => '<h2 align="center">You lose!</h2>',
                        'toggleButton' => [
                            'label' => Yii::t('app', 'Resign'),
                            'class' => 'btn btn-danger',
                            'id' => 'resignButton'
                        ],
                    ]);

                    echo 'You lose';

                    Modal::end();
                    ?>

                    <?= Html::button(Yii::t('app', 'Offer Draw'),
                        ['class' => 'btn btn-primary', 'id' => 'drawButton']) ?>
                </div>

            </div>
        </div>
    </div>

