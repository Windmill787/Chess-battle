<?php

/* @var $this yii\web\View */
/* @var $onlineUsers \app\models\SessionFrontendUser */

use yii\helpers\Html;

$this->title = Yii::t('app', 'My Yii Application');
?>
<div class="site-index">

    <div class="container">
        <h2>Users online</h2>
        <p>Users which you can invite to play:</p>
        <table class="table">
            <thead>
            <tr>
                <th>Username</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($onlineUsers)) {
                foreach ($onlineUsers as $onlineUser) {
                    $user = \common\models\User::findOne(['id' => $onlineUser->user_id]);
                    echo Html::beginTag('tr');
                    echo Html::beginTag('td');
                    echo Html::encode($user->username);
                    echo Html::endTag('td');
                    echo Html::endTag('tr');
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
