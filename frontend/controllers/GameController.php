<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:53
 */

namespace frontend\controllers;

use frontend\components\FigureComponent;
use frontend\components\PawnComponent;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

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
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            */
        ];
    }

    /**
     * Displays game page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $figure = Yii::$app->get('figure');
        $pawn = $figure->build('pawn');
        $knight = $figure->build('knight');
        $bishop = $figure->build('bishop');
        $rook = $figure->build('rook');
        $king = $figure->build('king');
        $queen = $figure->build('queen');
        return $this->render('index', [
            'pawn' => $pawn,
            'knight' => $knight,
            'bishop' => $bishop,
            'rook' => $rook,
            'king' => $king,
            'queen' => $queen
        ]);
    }

}