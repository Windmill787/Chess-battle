<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 03.04.17
 * Time: 13:02
 */

/* @var $this yii\web\View */
/* @var $model \app\models\Game */
/* @var $playPosition \app\models\PlayPositions */
/* @var $invitationsToMe \app\models\Messages */
/* @var $invitationsFromMe \app\models\Messages */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Invitations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-invitations">

    <h2><?= Yii::t('app', 'Invitations');?></h2>
    <p><?= Yii::t('app', 'You was invited to play'); ?></p>
    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">
                <table class="table table-bordered">
            <?php

            if (empty($invitationsToMe) == false) {
                echo Html::beginTag('thead');
                echo Html::beginTag('tr');
                echo Html::beginTag('td');
                echo Yii::t('app', 'User Name');
                echo Html::endTag('td');
                echo Html::beginTag('td', [
                    'colspan' => 2,
                    'align' => 'center'
                ]);
                echo Yii::t('app', 'Decision');
                echo Html::endTag('td');
                echo Html::endTag('tr');
                echo Html::endTag('thead');
                foreach ($invitationsToMe as $invitation) {

                    if ($invitation->status == 'pending') {

                        $enemy = \common\models\User::findOne([
                            'id' => $invitation->from_user_id
                        ]);

                        echo Html::beginTag('tbody');
                        echo Html::beginTag('tr');
                        echo Html::beginTag('td');
                        echo Html::encode($enemy->username);
                        echo Html::endTag('td');

                        echo Html::beginTag('td', [
                            'align' => 'center'
                        ]);
                        $form = ActiveForm::begin();

                        echo $form->field($model, 'white_user_id')
                            ->hiddenInput(['value' => $enemy->id])->label(false);

                        echo $form->field($model, 'black_user_id')
                            ->hiddenInput(['value' => Yii::$app->user->id])->label(false);

                        echo $form->field($model, 'status')
                            ->hiddenInput(['value' => 'in progress'])->label(false);

                        echo $form->field($invitation, 'id')
                            ->hiddenInput(['value' => $invitation->id])->label(false);

                        echo $form->field($invitation, 'from_user_id')
                            ->hiddenInput(['value' => $enemy->id])->label(false);

                        echo $form->field($invitation, 'to_user_id')
                            ->hiddenInput(['value' => Yii::$app->user->id])->label(false);

                        echo $form->field($invitation, 'status')
                            ->hiddenInput(['value' => 'accepted'])->label(false);

                        echo Html::submitButton(Yii::t('app', 'Accept'), [
                            'class' => 'btn btn-success'
                        ]);

                        ActiveForm::end();

                        echo Html::endTag('td');

                        echo Html::beginTag('td', [
                            'align' => 'center'
                        ]);
                        $form = ActiveForm::begin();

                        echo $form->field($invitation, 'id')
                            ->hiddenInput(['value' => $invitation->id])->label(false);

                        echo $form->field($invitation, 'from_user_id')
                            ->hiddenInput(['value' => $enemy->id])->label(false);

                        echo $form->field($invitation, 'to_user_id')
                            ->hiddenInput(['value' => Yii::$app->user->id])->label(false);

                        echo $form->field($invitation, 'status')
                            ->hiddenInput(['value' => 'declined'])->label(false);

                        echo Html::submitButton(Yii::t('app', 'Decline'), [
                            'class' => 'btn btn-danger',
                        ]);

                        ActiveForm::end();

                        echo Html::endTag('td');

                        echo Html::endTag('tr');
                        echo Html::endTag('tbody');
                    }
//                else if ($invitation->status == 'accepted') {
//
//                    $enemy = \common\models\User::findOne(['id' => $invitation->from_user_id]);
//                    echo $enemy->username;
//
//                    $games = \app\models\Game::find()
//                        ->where(['white_user_id' => $enemy->id, 'black_user_id' => Yii::$app->user->id])
//                        ->all();
//
//                    foreach ($games as $game) {
//                        echo Html::a('Go to game', '/game/play?id='.$game->id, [
//                            'class' => 'btn btn-primary'
//                        ]);
//                    }
//                }
            }
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
        } /*else {
            echo 'No invitations from another players';
        }
        echo Html::tag('br');
        if (empty($invitationsFromMe) == false) { ?>
            You invited to play with players:
            <br>
            <?php
            foreach ($invitationsFromMe as $invitation) {
                $enemy = \common\models\User::findOne(['id' => $invitation->to_user_id]);
                echo $enemy->username;

                $games = \app\models\Game::find()
                    ->where(['white_user_id' => Yii::$app->user->id, 'black_user_id' => $enemy->id])
                    ->all();

                foreach ($games as $game) {
                    echo Html::a('Go to game', '/game/play?id='.$game->id, [
                        'class' => 'btn btn-primary'
                    ]);
                }
            }
        } else {
            echo 'No invitations to another players';
        }*/

        ?>
        </table>
            </div>
    </div>
    </div>
</div>
