<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 02.04.17
 * Time: 18:14
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="<?= $model->img ?>" alt="No Image"
                     onerror="this.src = 'http://xn--174-5cd3cgu2f.xn--p1ai/wp-content/uploads/2015/09/noavatar.png'">
                <div class="caption">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'username',
                            'first_name',
                            'last_name',
                            'age',
                            'email',
                        ],
                    ]) ?>
                    <p><a href="update" class="btn btn-primary" role="button"><?=Yii::t('app', 'Update')?></a></p>
                </div>
            </div>
        </div>
    </div>
</div>