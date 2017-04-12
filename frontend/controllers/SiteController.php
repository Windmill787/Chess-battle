<?php
namespace frontend\controllers;

use app\models\Chessboard;
use app\models\Figure;
use app\models\Game;
use app\models\Messages;
use app\models\PlayPositions;
use app\models\SessionFrontendUser;
use common\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use nodge\eauth\openid\ControllerBehavior;
use yii\base\Model;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'eauth' => [
                'class' => ControllerBehavior::className(),
                'only' => ['login'],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'index'],
                'rules' => [
                    [
                        'actions' => ['signup', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Messages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('invitations');
        }

        $onlineUsers = SessionFrontendUser::find()
            ->where(['is not', 'user_id', null])
            ->andWhere(['!=', 'user_id', Yii::$app->user->id])
            ->all();
        if (empty($onlineUsers) == false) {
            return $this->render('index', [
                'onlineUsers' => $onlineUsers,
                'model' => $model
            ]);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Displays invitations list.
     *
     * @return mixed
     */
    public function actionInvitations()
    {
        $model = new Game();

        $invitationsToMe = Messages::find()
            ->where(['to_user_id' => Yii::$app->user->id])
            ->all();

        $invitationsFromMe = Messages::find()
            ->where(['from_user_id' => Yii::$app->user->id])
            ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            for ($i = 1; $i <= 32; $i++) {
                $playPosition = new PlayPositions();
                $figure = Figure::findOne($i);
                $startPosition = Chessboard::findOne($figure->start_position);
                $playPosition->game_id = $model->id;
                $playPosition->figure_id = $figure->id;
                $playPosition->current_x = $startPosition->x;
                $playPosition->current_y = $startPosition->y;
                $playPosition->status = 'active';
                $playPosition->already_moved = 0;
                $playPosition->save();
            }

            return $this->redirect('//game/play?id='.$model->id);
        }

        return $this->render('invitations', [
            'model' => $model,
            'invitationsToMe' => $invitationsToMe,
            'invitationsFromMe' => $invitationsFromMe
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        if (isset($serviceName)) {

            /** @var $eauth \nodge\eauth\ServiceBase */

            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl());
            $eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('site/login'));

            try {
                if ($eauth->authenticate()) {
//					var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes()); exit;

                    $identity = User::findByEAuth($eauth);
                    Yii::$app->getUser()->login($identity);

                    // special redirect with closing popup window
                    $eauth->redirect();
                }
                else {
                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                }
            }
            catch (\nodge\eauth\ErrorException $e) {
                // save error to show it later
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());

                // close popup window and redirect to cancelUrl
//				$eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
        }

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            if ($user = $model->signup()):
                if ($user->status === User::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                endif;
            else:
                Yii::$app->session->setFlash('error', Yii::t('app', 'There is error while registration'));
                Yii::error(Yii::t('app', 'Error while registration'));
                return $this->refresh();
            endif;
        endif;

        return $this->render('signup', [
            'model' => $model
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
