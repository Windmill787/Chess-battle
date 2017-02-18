<?php

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'My Yii Application');
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::t('app', 'Congratulations!') ?></h1>

        <p class="lead"><?= Yii::t('app', 'You have successfully logged in and you can start play') ?></p>

        <p><?= \yii\helpers\Html::a(Yii::t('app', 'New game'), ['/game'],
                ['class' => 'btn btn-lg btn-success']) ?>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
        </div>

    </div>
</div>
