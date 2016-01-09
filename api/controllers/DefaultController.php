<?php

namespace app\controllers;

class DefaultController extends \yii\web\Controller
{
    public function actionIndex()
    {
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
       $items = ['some', 'array', 'of', 'data' => ['associative', 'array']];
       return $items;
    }

    public function actionError(){
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }
        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = $this->defaultName ?: Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }
        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = $this->defaultMessage ?: Yii::t('yii', 'An internal server error occurred.');
        }
        return [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ];
    }

}
