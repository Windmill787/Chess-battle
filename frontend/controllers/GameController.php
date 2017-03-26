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
use app\models\Figure;
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

        // fix this!
        foreach ($figures as $item) {
            if (isset($_POST['move'.$item->color.$item->name.$item->number])) {
                $item->move();
            }

            if (isset($_POST['firstMove'.$item->color.$item->name.$item->number])) {
                $item->firstMove();
            }

            foreach ($item->attackX as $attackX) {
                foreach ($item->attackY as $attackY) {

                    if ($item->color == 'white') {
                        $desiredPosition = PlayPositions::findOne([
                            'current_x' => $item->currentPositionX + $attackX,
                            'current_y' => $item->currentPositionY + $attackY
                        ]);
                    } else if ($item->color == 'black') {
                        $desiredPosition = PlayPositions::findOne([
                            'current_x' => $item->currentPositionX - $attackX,
                            'current_y' => $item->currentPositionY - $attackY
                        ]);
                    }

                    if (empty($desiredPosition->figure_id) == false) {
                        $desiredFigure = Figure::findOne(['id' => $desiredPosition->id]);

                        if (isset($_POST['attack' . $desiredFigure->id])) {
                            $item->attack($desiredFigure->id);
                            $this->refresh();
                        }
                    }
                }
            }

        }

        // fix this!
        if (isset($_POST['back'])) {
            FigureBuilderComponent::back($figures);
            FigureBuilderComponent::resetStatuses();
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