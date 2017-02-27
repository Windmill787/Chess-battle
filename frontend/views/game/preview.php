<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 23.02.17
 * Time: 8:51
 */

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Preview');
?>
<div class="game-preview">

    <div class="jumbotron">
        <h1><?= Yii::t('app', 'Congratulations!') ?></h1>

        <p class="lead"><?= Yii::t('app', 'You have successfully logged in and you can start play') ?></p>

        <p><?= \yii\helpers\Html::a(Yii::t('app', 'New game'), ['play'],
                ['class' => 'btn btn-lg btn-success']) ?>
        </p>
    </div>

</div>