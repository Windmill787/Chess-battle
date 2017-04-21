<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 16.04.17
 * Time: 2:21
 */

namespace frontend\widgets;

use common\models\User;
use yii\helpers\Html;

class PhotoAndName
{
    public static function enemyPhoto($enemy, $whiteUser, $blackUser) {
        if ($enemy->id == $whiteUser->id) {
            $user = User::findOne($whiteUser->id);
        } else if ($enemy->id == $blackUser->id) {
            $user = User::findOne($blackUser->id);
        }
        echo Html::img('', [
            'width' => 40,
            'height' => 40,
            'alt' => "No Image",
            'onerror' => "this.src = 'http://xn--174-5cd3cgu2f.xn--p1ai/wp-content/uploads/2015/09/noavatar.png'"
        ]);
        echo Html::encode(' '.$whiteUser->username);
    }

    public static function myPhoto($whiteUser, $blackUser) {
        if (\Yii::$app->user->id == $whiteUser->id) {
            $user = User::findOne($whiteUser->id);
        } else if (\Yii::$app->user->id == $blackUser->id) {
            $user = User::findOne($blackUser->id);
        }
        echo Html::img('',[
            'width' => 40,
            'height' => 40,
            'alt' => "No Image",
            'onerror' => "this.src = 'http://xn--174-5cd3cgu2f.xn--p1ai/wp-content/uploads/2015/09/noavatar.png'"
        ]);
        echo Html::encode(' '.$blackUser->username);
    }
}