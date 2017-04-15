<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
?>
    <div class="site-login text-center">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?= Yii::t('app', 'Please fill out the following fields to login:'); ?></p>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="thumbnail">
                    <div class="caption">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?= $form->field($model, Yii::t('app', 'username'))
                            ->textInput(['autofocus' => true]) ?>
                        <?= $form->field($model, Yii::t('app', 'password'))->passwordInput() ?>
                        <?= $form->field($model, Yii::t('app', 'rememberMe'))->checkbox() ?>

                        <div style="color:#999;margin:1em 0">
                            <?= Yii::t('app', 'If you forgot your password you can').' '.
                            Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
<?php
if (Yii::$app->getSession()->hasFlash('error')) {
    echo '<div class="alert alert-danger">'.Yii::$app->getSession()->getFlash('error').'</div>';
}
?>
<div class="text-center">
    <p><?= Yii::t('app', 'Do you already have an account on one of these sites? Click the logo to log in with it here:')?></p>

    <?php echo \nodge\eauth\Widget::widget(['action' => 'site/login']); ?>
</div>
