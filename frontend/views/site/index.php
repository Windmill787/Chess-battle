<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'My Yii Application');
?>
<div class="site-index">

        <div class="jumbotron">
            <h1><?= Yii::t('app', 'Congratulations!') ?></h1>

            <p class="lead"><?= Yii::t('app', 'You have successfully logged in and you can start play') ?></p>

            <p><?= Html::a(Yii::t('app', 'New game'), ['//game/play'],
                    ['class' => 'btn btn-lg btn-success']) ?>
            </p>
        </div>

</div>
