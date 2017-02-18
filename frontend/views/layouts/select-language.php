<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 21:35
 */
use yii\bootstrap\Html;

if(\Yii::$app->language == 'ru'):
    echo Html::a('Go to English', array_merge(
        \Yii::$app->request->get(),
        [\Yii::$app->controller->route, 'language' => 'en']
    ));
else:
    echo Html::a('Перейти на русский', array_merge(
        \Yii::$app->request->get(),
        [\Yii::$app->controller->route, 'language' => 'ru']
    ));
endif;