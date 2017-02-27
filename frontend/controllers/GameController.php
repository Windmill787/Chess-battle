<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:53
 */

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;
use yii\filters\VerbFilter;

class GameController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'preview'],
                'rules' => [
                    [
                        'actions' => ['index', 'preview'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays game play page.
     *
     * @return mixed
     */
    public function actionPlay()
    {
        $pawn = Yii::$app->get('pawn');
        $knight = Yii::$app->get('knight');
        $bishop = Yii::$app->get('bishop');
        $rook = Yii::$app->get('rook');
        $king = Yii::$app->get('king');
        $queen = Yii::$app->get('queen');
        return $this->render('play', [
            'pawn' => $pawn,
            'knight' => $knight,
            'bishop' => $bishop,
            'rook' => $rook,
            'king' => $king,
            'queen' => $queen
        ]);
    }

    /**
     * Displays game preview page.
     *
     * @return mixed
     */
    public function actionPreview()
    {
        return $this->render('preview');
    }
}