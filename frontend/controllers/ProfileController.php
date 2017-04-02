<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 02.04.17
 * Time: 18:58
 */

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use Exception;

class ProfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new Exception(Yii::t('app', 'You don\'t have permission for this page'));
                },
                'rules' => [
                    [
                        'controllers' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User model fields.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = $this->findModel();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'index' page with updated information.
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel()
    {
        if (($model = User::findOne(Yii::$app->user->identity->getId())) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('User does not exist');
        }
    }
}