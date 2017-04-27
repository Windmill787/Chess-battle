<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 16.04.17
 * Time: 2:21
 */

namespace frontend\widgets;

use yii\helpers\Html;

class PhotoAndName
{
    public static function display($user) {
        echo Html::img('', [
            'width' => 40,
            'height' => 40,
            'alt' => "No Image",
            'onerror' => "this.src = 'http://xn--174-5cd3cgu2f.xn--p1ai/wp-content/uploads/2015/09/noavatar.png'"
        ]);
        echo Html::encode(' '.$user->username);
    }
}