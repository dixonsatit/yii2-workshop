<?php

namespace common\modules\customauth;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\customauth\controllers';
    public $defaultRoute = 'auth';

    public $encrypt = 'md5';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
