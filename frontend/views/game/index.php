<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:52
 */

/* @var $this yii\web\View */

use yii\helpers\Html;
use russ666\widgets\Countdown;
use yii\bootstrap\Modal;

$this->title = Yii::t('app', 'Game');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-5">
        <div class="thumbnail" align="right">
            <div class="caption">
                <h1>
                    <div class="label label-default">
                        <span id="clock">
                            <span id="clockEnemy"></span>
                        </span>
                    </div>
                </h1>
                <table class="table table-striped table-bordered">
                    <?php
                    $symbolLabel = [
                        '','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
                    ];
                    foreach($symbolLabel as $label):
                        echo "<th>";
                        echo $label;
                        echo "</th>";
                    endforeach;
                    for($row=8;$row>=1;$row--)
                    {
                        echo "<tr>";
                        echo "<th>";
                        echo $row;
                        echo "</th>";
                        for($col=1;$col<=8;$col++)
                        {
                            $total=$row+$col;
                            if($total%2==0)
                            {
                                echo "<td height=50px width=50px bgcolor=#FFFFFF><label>$row.$col</label></td>";
                            }
                            else
                            {
                                echo "<td height=50px width=50px bgcolor=#000000><label>$row.$col</label></td>";
                            }
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>

                <h1>
                    <div class="label label-default">
                        <span id="clock">
                            <span id="clockSelf"></span>
                        </span>
                    </div>
                </h1>

                <h1>
                    <div class="label label-default" style="visibility: hidden; position: absolute">
                        <?= Countdown::widget([
                            'datetime' => date('m')
                        ])
                        ?>
                    </div>
                </h1>

                <div class="form-group">
                    <?= Html::button(Yii::t('app', 'Me'),
                        ['class' => 'btn btn-primary', 'id' => 'myMoveButton']) ?>

                    <?= Html::button(Yii::t('app', 'Enemy'),
                        ['class' => 'btn btn-primary', 'id' => 'enemyMoveButton']) ?>
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
</div>