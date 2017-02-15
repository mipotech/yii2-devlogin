<?php
namespace mipotech\devlogin\controllers;

use Yii;
use yii\web\Controller;

use mipotech\devlogin\models\LoginForm;

class LoginController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = '@vendor/mipotech/yii2-devlogin/views/layouts/main';

    /**
     *
     * @return string|yii\web\Response
     */
    public function actionIndex()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->set(Yii::$app->devlogin->sessionKey, 1);

            return $model->redirectUrl ? $this->redirect($model->redirectUrl) : $this->goBack();
        } else {
            if (!empty(Yii::$app->devlogin->redirectUrl)) {
                $model->redirectUrl = Yii::$app->devlogin->redirectUrl;
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getViewPath()
    {
        return '@vendor/mipotech/yii2-devlogin/views';
    }
}
