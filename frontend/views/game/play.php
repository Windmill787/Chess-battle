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

use yii\helpers\Html;
use yii\bootstrap\Modal;
use frontend\widgets\Board;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Play');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-play">

    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">

                <?= Board::widget($board, $figures, $whiteUser, $blackUser, $model); ?>

            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="row thumbnail" align="right">
            <div class="caption">

                <p>Moves</p>

                <div class="thumbnail">
                    <div class="caption">

                        <?php
                        
                        ?>

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

                    <?php
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
</div>

<?php //acceptance tests, jenkins, selenium, driver, config(WebDriver: url, browser(better firefox, chrome), Yii parts, config...
        //fixture-data from tables, -f -fails(codeseption),
        //consept build, run ) ?>