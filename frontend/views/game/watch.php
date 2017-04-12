<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 05.04.17
 * Time: 2:02
 */

/* @var $this yii\web\View */
/* @var $games \app\models\Game */

use yii\helpers\Html;
use common\models\User;

$this->title = Yii::t('app', 'Watch');
?>
<div class="game-watch">

    <h2><?= Yii::t('app', 'Watch Matches'); ?></h2>
    <p><?= Yii::t('app', 'You can watch current matches'); ?></p>
    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">
                <table class="table table-bordered">
                    <?php
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
                        if (Yii::$app->user->id == null ||
                            Yii::$app->user->id != $whiteUser->id &&
                            Yii::$app->user->id != $blackUser->id) {

                            echo Html::beginTag('tbody');
                            echo Html::beginTag('tr');
                            echo Html::beginTag('td');
                            echo $whiteUser->username;
                            echo Html::endTag('td');

                            echo Html::beginTag('td');
                            echo $blackUser->username;
                            echo Html::endTag('td');

                            echo Html::beginTag('td');
                            echo Html::a(Yii::t('app','Watch'), '/game/play?id=' . $game->id, [
                                'class' => 'btn btn-primary'
                            ]);;
                            echo Html::endTag('td');
                            echo Html::endTag('tr');
                            echo Html::endTag('tbody');
                        } else {
                            echo Html::beginTag('tbody');
                            echo Html::beginTag('tr');
                            echo Html::beginTag('td');
                            echo Yii::t('app', 'No current matches');
                            echo Html::endTag('td');
                            echo Html::endTag('tr');
                            echo Html::endTag('tbody');
                            break;
                        }
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
</div>