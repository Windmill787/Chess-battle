<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 18.02.17
 * Time: 22:53
 */

namespace frontend\controllers;

use frontend\components\BoardComponent;
use app\models\PlayPositions;
use frontend\components\FigureBuilderComponent;
use frontend\components\KnightComponent;
use frontend\components\PawnComponent;
use yii\web\Controller;
use yii\filters\AccessControl;
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
        $whiteKnight1 = new KnightComponent('white', 1);

        if (isset($_POST['back'])) {
            $position = PlayPositions::findOne(['figure_id' => $whiteKnight1->id]);
            $position->figure_id = $whiteKnight1->id;
            $position->current_x = $whiteKnight1->startPositionX;
            $position->current_y = $whiteKnight1->startPositionY;

            $position = PlayPositions::findOne(['figure_id' => $whitePawn1->id]);
            $position->figure_id = $whitePawn1->id;
            $position->current_x = $whitePawn1->startPositionX;
            $position->current_y = $whitePawn1->startPositionY;

            $position = PlayPositions::findOne(['figure_id' => $whitePawn2->id]);
            $position->figure_id = $whitePawn2->id;
            $position->current_x = $whitePawn2->startPositionX;
            $position->current_y = $whitePawn2->startPositionY;
            $position->save();
            $this->refresh();
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
            'whitePawn2' => $whitePawn2,
            'whiteKnight1' => $whiteKnight1

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