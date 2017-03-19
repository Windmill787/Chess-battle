<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:53
 */

namespace frontend\controllers;

use app\models\Figure;
use frontend\components\BoardComponent;
use frontend\components\FigureComponent;
use frontend\components\PawnComponent;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
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
        $board = new BoardComponent();

        /*Yii::$container->setSingleton('frontend\components\PawnComponent', [], [
            ['white'],
            ['number' => '1']
        ]);

        $whitePawn1 = Yii::$container->get('frontend\components\PawnComponent');
        $figure = Yii::$container->get('figure');
        */

        $whitePawn1 = new PawnComponent('white', 1);
        $whitePawn2 = new PawnComponent('white', 2);

        if (isset($_POST['pawn'])) {
            $whitePawn1->move();
        }

        if (isset($_POST['pawn2'])) {
            $whitePawn1->firstMove();
        }

        /*if (Yii::$app->request->post('pawn')) {
            $whitePawn1->move();
        }

        if (Yii::$app->request->post('pawn2')) {
            $whitePawn1->firstMove();
        }*/

        return $this->render('play', [
            'board' => $board,
            'whitePawn' => $whitePawn1,
            'whitePawn2' => $whitePawn2

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