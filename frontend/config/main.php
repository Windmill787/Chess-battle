<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'assetManager' => [
            'bundles' => [
                'edgardmessias\assets\nprogress\NProgressAsset' => [
                    'configuration' => [
                        'minimum' => 0.08,
                        'showSpinner' => true,
                    ],
                    'page_loading' => true,
                    'pjax_events' => true,
                    'jquery_ajax_events' => true,
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['ru', 'en'],
            'enableDefaultLanguageUrlCode' => true,
            'rules' => [
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'pawn' => [
            'class' => 'frontend\components\PawnComponent',
            'color' => 'white',
            'number' => 1
        ],
        /*'Figure' => 'frontend\components\FigureComponent',
        'Pawn' => 'frontend\components\PawnComponent',*/
        /*
        'knight' => \frontend\components\FigureBuilderComponent::build('knight',
            \frontend\components\KnightComponent::className()),
        'bishop' => \frontend\components\FigureBuilderComponent::build('bishop',
            \frontend\components\BishopComponent::className()),
        'rook' => \frontend\components\FigureBuilderComponent::build('rook',
            \frontend\components\RookComponent::className()),
        'king' => \frontend\components\FigureBuilderComponent::build('king',
            \frontend\components\KingComponent::className()),
        'queen' => \frontend\components\FigureBuilderComponent::build('queen',
            \frontend\components\QueenComponent::className()),*/
    ],
    'params' => $params,
];
