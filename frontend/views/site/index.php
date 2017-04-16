<?php

/* @var $this yii\web\View */
/* @var $onlineUsers \app\models\SessionFrontendUser */
/* @var $model \app\models\Messages */
/* @var $games \app\models\Game */
/* @var $pages \yii\data\Pagination */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Home');

$script = <<< JS
$(document).ready(function() {
setInterval(function(){ $("#refreshButton").click(); }, 2000);
});
JS;
$this->registerJs($script);
?>
<div class="site-index">

    <h2><?= Yii::t('app', 'Users Online'); ?></h2>
    <p><?= Yii::t('app', 'Users which you can invite to play'); ?></p>
    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">
                    <?php
                    Pjax::begin();
                    echo Html::a("Refresh", ['site/index'], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'refreshButton']);

                    if (empty($onlineUsers) == false) {

                        echo Html::beginTag('table', [
                            'class' => 'table table-bordered'
                        ]);
                        echo Html::beginTag('thead');
                        echo Html::beginTag('tr');
                        echo Html::beginTag('td');
                        echo Yii::t('app', 'User Name');
                        echo Html::endTag('td');
                        echo Html::endTag('tr');
                        echo Html::endTag('thead');

                        foreach ($onlineUsers as $onlineUser) {
                            $user = \common\models\User::findOne(['id' => $onlineUser->user_id]);
                            echo Html::beginTag('tbody');
                            echo Html::beginTag('tr');
                            echo Html::beginTag('td');
                            echo Html::encode($user->username);
                            $form = ActiveForm::begin();

                            echo $form->field($model, 'from_user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false);

                            echo $form->field($model, 'to_user_id')->hiddenInput(['value' => $user->id])->label(false);

                            echo $form->field($model, 'status')->hiddenInput(['value' => 'pending'])->label(false);

                            echo Html::endTag('td');

                            echo Html::beginTag('td');
                            echo Html::submitButton(Yii::t('app', 'Invite'), [
                                'class' => 'btn btn-primary'
                            ]);

                            ActiveForm::end();
                            echo Html::endTag('td');
                            echo Html::endTag('tr');
                            echo Html::endTag('tbody');
                        }
                        echo Html::endTag('table');
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                        ]);

                    } else {
                        echo Html::encode(Yii::t('app', 'No users online'));
                    }
                    Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
