<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 15.04.17
 * Time: 12:48
 */

/* @var $this yii\web\View */
/* @var $games \app\models\Game */
/* @var $pages \yii\data\Pagination */

use yii\helpers\Html;
use common\models\User;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'My matches');

$script = <<< JS
$(document).ready(function() {
setInterval(function(){ $("#refreshButton").click(); }, 7000);
});
JS;
$this->registerJs($script);
?>
<div class="game-index">

    <h2><?= Yii::t('app', 'My matches'); ?></h2>
    <p><?= Yii::t('app', 'On this page you can see your opened matches'); ?></p>
    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">
                <?php
                if (empty($games) == false) {
                    echo Html::beginTag('table', [
                        'class' => 'table table-bordered'
                    ]);
                    echo Html::beginTag('thead');
                    echo Html::beginTag('tr');
                    echo Html::beginTag('td');
                    echo Yii::t('app', 'Rival');
                    echo Html::endTag('td');
                    echo Html::endTag('tr');
                    echo Html::endTag('thead');

                    foreach ($games as $game) {
                        $whiteUser = User::findOne(['id' => $game->white_user_id]);

                        $blackUser = User::findOne(['id' => $game->black_user_id]);

                        echo Html::beginTag('tbody');
                        echo Html::beginTag('tr');
                        echo Html::beginTag('td');
                        echo Html::encode('Versus ');
                        if (Yii::$app->user->id == $whiteUser->id) {
                            echo Html::encode($blackUser->username);
                            echo Html::tag('br');
                            echo Html::encode('Your color is white');
                        } else {
                            echo Html::encode($whiteUser->username);
                            echo Html::tag('br');
                            echo Html::encode('Your color is black');
                        }
                        echo Html::endTag('td');

                        echo Html::beginTag('td');
                        echo Html::a(Yii::t('app', 'Play'), '/game/play?id=' . $game->id, [
                            'class' => 'btn btn-primary'
                        ]);;
                        echo Html::endTag('td');
                        echo Html::endTag('tr');
                        echo Html::endTag('tbody');
                    }
                    echo Html::endTag('table');
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                } else {
                    echo Html::beginTag('tbody');
                    echo Html::beginTag('tr');
                    echo Html::beginTag('td');
                    echo Yii::t('app', 'No current started matches');
                    echo Html::endTag('td');
                    echo Html::endTag('tr');
                    echo Html::endTag('tbody');
                }
                Pjax::begin(); ?>
                <?= Html::a("Refresh", ['game/index'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']) ?>
                <?php Pjax::end();
                ?>
            </div>
        </div>
    </div>
</div>