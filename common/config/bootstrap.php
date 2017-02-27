<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

/*Yii::$container->set(\frontend\interfaces\FigureInterface::class, \frontend\components\PawnComponent::class);
Yii::$container->set('figure', [
    'class' => \frontend\components\FigureComponent::class
]);*/