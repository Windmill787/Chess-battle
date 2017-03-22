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

        $figures = FigureBuilderComponent::build();

        foreach ($figures as $item) {
            if (isset($_POST['move'.$item->color.$item->name.$item->number])) {
                if ($item->color == 'white') {
                    $square = PlayPositions::findOne([
                        'current_x' => $item->currentPositionX + $item->moveX,
                        'current_y' => $item->currentPositionY + $item->moveY
                    ]);
                } else if ($item->color == 'black') {
                    $square = PlayPositions::findOne([
                        'current_x' => $item->currentPositionX - $item->moveX,
                        'current_y' => $item->currentPositionY - $item->moveY
                    ]);
                }
                if (empty($square->figure_id)) {
                    $item->move();
                }
            }

            if (isset($_POST['firstMove'.$item->color.$item->name.$item->number])) {
                if ($item->color == 'white') {
                    $square = PlayPositions::findOne([
                        'current_x' => $item->currentPositionX + $item->moveX,
                        'current_y' => $item->currentPositionY + $item->moveY
                    ]);
                } else if ($item->color == 'black') {
                    $square = PlayPositions::findOne([
                        'current_x' => $item->currentPositionX - $item->moveX,
                        'current_y' => $item->currentPositionY - $item->moveY
                    ]);
                }
                if (empty($square->figure_id)) {
                    $item->firstMove();
                }
            }

            if (isset($_POST['attack'.$item->color.$item->name.$item->number])) {
                if ($item->color == 'white') {
                    $square = PlayPositions::findOne([
                        'current_x' => $item->currentPositionX + $item->attackX,
                        'current_y' => $item->currentPositionY + $item->attackY
                    ]);
                } else if ($item->color == 'black') {
                    $square = PlayPositions::findOne([
                        'current_x' => $item->currentPositionX - $item->attackX,
                        'current_y' => $item->currentPositionY - $item->attackY
                    ]);
                }
                if (empty($square->figure_id) == false) {
                    $item->attack();
                }
            }
        }

        if (isset($_POST['back'])) {
            FigureBuilderComponent::back($figures);
            $this->refresh();
        }

        return $this->render('play', [
            'board' => $board,
            'figures' => $figures

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