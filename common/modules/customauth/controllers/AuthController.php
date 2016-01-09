<?php

namespace common\modules\customauth\controllers;

use Yii;
use yii\web\Controller;
use common\modules\customauth\models\LoginForm;
use common\modules\customauth\models\Employee;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class AuthController extends Controller
{
    public $defaultAction = 'profile';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'profile','setting'],
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
    public function actionProfile()
    {
        return $this->render('profile');
    }
    public function actionSetting()
    {
        $model = Employee::findOne(Yii::$app->user->id);
        $model->scenario = 'setting';
        if($model->load(Yii::$app->request->post()) && $model->validate()){

          $model->setPassword($model->password);
          

          // if($model->save()){
          //   print_r($model->getErrors());
          // }else{
          //   print_r($model->getErrors());
          // }
          Yii::$app->getSession()->setFlash('success','บันทึกข้อมูลเสร็จเรียบร้อย..');
          return $this->redirect(['setting']);
        }else{
          $model->password = null;
        }
        return $this->render('setting',[
          'model'=>$model
        ]);
    }

    public function actionLogin()
    {
      if (!\Yii::$app->user->isGuest) {
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

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
