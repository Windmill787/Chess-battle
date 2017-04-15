<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 05.04.17
 * Time: 2:02
 */

/* @var $this yii\web\View */
/* @var $games \app\models\Game */
/* @var $pages \yii\data\Pagination */
/* @var $whiteUser User */
/* @var $blackUser User */

use yii\helpers\Html;
use common\models\User;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Watch');

$script = <<< JS
$(document).ready(function() {
setInterval(function(){ $("#refreshButton").click(); }, 7000);
});
JS;
$this->registerJs($script);
?>
<div class="game-watch">

    <h2><?= Yii::t('app', 'Watch Matches'); ?></h2>
    <p><?= Yii::t('app', 'You can watch current matches'); ?></p>
    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">
                <?php
                foreach ($games as $game) {
                    $whiteUser = User::findOne(['id' => $game->white_user_id]);

                    $blackUser = User::findOne(['id' => $game->black_user_id]);

                }
                if (Yii::$app->user->id == null ||
                    Yii::$app->user->id != $whiteUser->id &&
                    Yii::$app->user->id != $blackUser->id
                ) {
                    echo Html::beginTag('table', [
                        'class' => 'table table-bordered'
                    ]);
                    echo Html::beginTag('thead');
                    echo Html::beginTag('tr');
                    echo Html::beginTag('td');
                    echo Yii::t('app', 'White Player');
                    echo Html::endTag('td');
                    echo Html::beginTag('td');
                    echo Yii::t('app', 'Black Player');
                    echo Html::endTag('td');
                    echo Html::endTag('tr');
                    echo Html::endTag('thead');

                    foreach ($games as $game) {
                        $whiteUser = User::findOne(['id' => $game->white_user_id]);

                        $blackUser = User::findOne(['id' => $game->black_user_id]);

                        echo Html::beginTag('tbody');
                        echo Html::beginTag('tr');
                        echo Html::beginTag('td');
                        echo Html::encode($whiteUser->username);
                        echo Html::endTag('td');

                        echo Html::beginTag('td');
                        echo Html::encode($blackUser->username);
                        echo Html::endTag('td');

                        echo Html::beginTag('td');
                        echo Html::a(Yii::t('app', 'Watch'), '/game/play?id=' . $game->id, [
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
                    echo Html::encode(Yii::t('app', 'No current matches'));
                }
                Pjax::begin(); ?>
                <?= Html::a("Refresh", ['game/watch'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']) ?>
                <?php Pjax::end();
                ?>
            </div>
        </div>
    </div>
</div>