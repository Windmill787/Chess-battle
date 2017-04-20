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
/* @var $pages \yii\data\Pagination */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Invitations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-invitations">

    <h2><?= Yii::t('app', 'Invitations');?></h2>
    <p><?= Yii::t('app', 'Invitations list'); ?></p>
    <div class="col-lg-5">
        <div class="row thumbnail">
            <div class="caption">
                    <?php
                    Pjax::begin();
                    echo Html::a("Refresh", ['site/invitations'], ['class' => 'hidden', 'id' => 'refreshButton']);

                    if (empty($invitationsToMe) == false) {

                        foreach ($invitationsToMe as $invitation) {

                            if ($invitation->status == 'pending') {
                                echo Html::beginTag('table', [
                                    'class' => 'table table-bordered'
                                ]);
                                echo Html::beginTag('thead');
                                echo Html::beginTag('tr');
                                echo Html::beginTag('td');
                                echo Html::encode(Yii::t('app', 'User Name'));
                                echo Html::endTag('td');
                                echo Html::beginTag('td', [
                                    'colspan' => 2,
                                    'align' => 'center'
                                ]);
                                echo Html::encode(Yii::t('app', 'Decision'));
                                echo Html::endTag('td');
                                echo Html::endTag('tr');
                                echo Html::endTag('thead');
                                break;

                            } else {
                                echo Html::encode(Yii::t('app', 'No invitations from another players'));
                            }
                        }

                        foreach ($invitationsToMe as $index => $invitation) {

                            $fromUser = \common\models\User::findOne(['id' => $invitation->from_user_id]);
                            echo Html::beginTag('tbody');
                            echo Html::beginTag('tr');
                            echo Html::beginTag('td');
                            echo Html::encode($fromUser->username);
                            echo Html::endTag('td');

                            echo Html::beginTag('td', [
                                'align' => 'center'
                            ]);

                            $form = ActiveForm::begin();
                            echo $form->field($invitation, "[$index]id")
                                ->label(false)->hiddenInput();

                            echo Html::submitButton(Yii::t('app', 'Decline'), [
                                'class' => 'btn btn-danger',
                            ]);

                            ActiveForm::end();

                            echo Html::endTag('td');
                            echo Html::endTag('td');

                            echo Html::endTag('tr');
                            echo Html::endTag('tbody');
                        }

                        echo Html::endTag('table');
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                    } else {
                        echo Html::encode(Yii::t('app', 'No invitations from another players'));
                    }

                    Pjax::end();
                    ?>
            </div>
        </div>
    </div>
</div>
