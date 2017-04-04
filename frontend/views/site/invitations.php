<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 03.04.17
 * Time: 13:02
 */

/* @var $this yii\web\View */
/* @var $model \app\models\Game */
/* @var $invitationsToMe \app\models\Messages */
/* @var $invitationsFromMe \app\models\Messages */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Invitations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-invitations">

    <h2>Invitations</h2>
    <div class="col-lg-5">
    <div class="row thumbnail">
        <table class="table">
            <tbody>
        <?php if (empty($invitationsToMe) == false) { ?>
            You was invited to play by players:
            <br>
            <?php
            foreach ($invitationsToMe as $invitation) {

                if ($invitation->status == 'pending') {

                    $enemy = \common\models\User::findOne(['id' => $invitation->from_user_id]);
                    echo $enemy->username;

                    $form = ActiveForm::begin();

                    echo $form->field($model, 'white_user_id')
                        ->hiddenInput(['value' => $enemy->id])->label(false);

                    echo $form->field($model, 'black_user_id')
                        ->hiddenInput(['value' => Yii::$app->user->id])->label(false);

                    echo $form->field($model, 'status')
                        ->hiddenInput(['value' => 'in progress'])->label(false);

                    echo Html::submitButton('Accept', [
                        'class' => 'btn btn-success'
                    ]);

                    ActiveForm::end();


                    echo Html::tag('th');
                    echo Html::tag('br');

                } else if ($invitation->status == 'accepted') {

                    $enemy = \common\models\User::findOne(['id' => $invitation->from_user_id]);
                    echo $enemy->username;

                    $games = \app\models\Game::find()
                        ->where(['white_user_id' => $enemy->id, 'black_user_id' => Yii::$app->user->id])
                        ->all();

                    foreach ($games as $game) {
                        echo Html::a('Go to game', '/game/play?id='.$game->id, [
                            'class' => 'btn btn-primary'
                        ]);
                    }
                }
            }
        } else {
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
        }

        ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
