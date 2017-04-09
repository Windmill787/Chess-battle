<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 05.04.17
 * Time: 2:02
 */

use yii\helpers\Html;
use common\models\User;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Watch');
//$this->params['breadcrumbs'][] = $this->title;
?>

<h2>Watch matches</h2>
<p>You can watch current started watches:</p>
<div class="col-lg-5">
    <div class="row thumbnail">
        <div class="caption">
            <?php

            foreach ($games as $game) {
                $whiteUser = User::findOne(['id' => $game->white_user_id]);

                $blackUser = User::findOne(['id' => $game->black_user_id]);
                if (Yii::$app->user->id == null ||
                    Yii::$app->user->id != $whiteUser->id &&
                    Yii::$app->user->id != $blackUser->id) {
                    echo $whiteUser->username . '(white)';
                    echo ' versus ';
                    echo $blackUser->username . '(black)';
                    echo Html::a('Watch', '/game/play?id=' . $game->id, [
                        'class' => 'btn btn-primary'
                    ]);
                    echo Html::tag('br');
                }
            }

            ?>

        </div>
    </div>
</div>