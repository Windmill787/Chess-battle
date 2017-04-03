<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 03.04.17
 * Time: 13:02
 */

/* @var $this yii\web\View */
/* @var $model \app\models\Game */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'My Yii Application');
?>
<div class="site-invitations">

    <div class="container">
        <?php
        $invitationsFromMe = \app\models\Messages::find()
            ->where(['to_user_id' => Yii::$app->user->id])
            ->andWhere(['status' => 'pending'])
            ->all();
        if (empty($invitationsFromMe) == false) { ?>
            You was invited to play by players:
            <br>
            <?php
            foreach ($invitationsFromMe as $invitation) {
                $user = \common\models\User::findOne(['id' => $invitation->from_user_id]);
                echo $user->username;
                ActiveForm::begin();
                ?>

                <?php $model->black_user_id = Yii::$app->user->id ?>

                <div class="form-group">
                    <?= Html::submitButton('Accept', [
                        'class' => 'btn btn-success', 'name' => 'accept-invite'
                    ]); ?>
                    <?= Html::submitButton('Decline', [
                        'class' => 'btn btn-danger', 'name' => 'decline-invite'
                    ]); ?>
                </div>

                <?php
                ActiveForm::end();
            }
        } else {
            echo 'No invitations from another players';
        }

        echo '<hr>';

        $invitationsToMe = \app\models\Messages::find()
            ->where(['from_user_id' => Yii::$app->user->id])
            ->andWhere(['status' => 'pending'])
            ->all();
        if (empty($invitationsToMe) == false) { ?>
            You invited to play with players:
            <br>
            <?php
            foreach ($invitationsToMe as $invitation) {
                $user = \common\models\User::findOne(['id' => $invitation->to_user_id]);
                echo $user->username;
                ActiveForm::begin();
                ?>

                <?php $model->black_user_id = Yii::$app->user->id ?>

                <div class="form-group">
                    <?= Html::submitButton('Go to game', [
                        'class' => 'btn btn-primary', 'name' => 'play-button'
                    ]); ?>
                </div>

                <?php
                ActiveForm::end();
            }
        } else {
            echo 'No invitations to another players';
        }

        ?>
    </div>
</div>
