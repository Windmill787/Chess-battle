<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:52
 */

/* @var $this yii\web\View */
/* @var $whitePawn \frontend\components\PawnComponent */
/* @var $figures \frontend\components\FigureComponent */
/* @var $board \frontend\components\BoardComponent */
/* @var $model \app\models\Game */

use yii\helpers\Html;
use russ666\widgets\Countdown;
use yii\bootstrap\Modal;
use frontend\widgets\Board;

$this->title = Yii::t('app', 'Play' . $model->id);
//$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">

                <?php
                if ($this->beginCache($figures)) {

                    if ($this->beginCache($board)) {
                        echo Board::widget($board, $figures, $whiteUser, $blackUser);
                        $this->endCache();
                    }
                    $this->endCache();
                }
                ?>

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

<?php //acceptance tests, jenkins, selenium, driver, config(WebDriver: url, browser(better firefox, chrome), Yii parts, config...
        //fixture-data from tables, -f -fails(codeseption),
        //consept build, run ) ?>