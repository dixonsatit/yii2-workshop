<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yii 2 Learning Workshop',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('common', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('frontend', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('frontend', 'Contact'), 'url' => ['/site/contact']],
        ['label' => Yii::t('frontend', 'Workshops'), 'items' => [
          ['label' => 'Create Form', 'url' => '#'],
          ['label' => 'Uploads', 'url' => '#'],
          ['label' => 'Dependent Dropdown', 'url' => '#'],
          ['label' => 'Relations', 'url' => '#'],
          ['label' => 'PJax', 'url' => '#'],
          ['label' => 'Filter & Sort in GirdView', 'url' => '#'],
          ['label' => 'One From Multiple Model', 'url' => '#'],
          ['label' => 'Collecting tabular input (Multiple Records)', 'url' => '#'],
        ]]
    ];
    $menuItems[] = [
                    'label'=>Yii::t('common', 'Language'),
                    'items'=>array_map(function ($code) {
                        return [
                            'label' => Yii::$app->params['availableLocales'][$code],
                            'url' => ['/site/set-locale', 'locale'=>$code],
                            'active' => Yii::$app->language === $code
                        ];
                    }, array_keys(Yii::$app->params['availableLocales']))
                ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {



        $menuItems[] = [
          'label' => Yii::t('common', 'Account ({username})',['username'=>Yii::$app->user->identity->username]),
          'items'=>[
              ['label' => Yii::t('common', 'Settings'), 'url' => ['/profile/index']],
              [
                 'label' => Yii::t('common', 'Logout ({username})',['username'=>Yii::$app->user->identity->username]),
                 'url' => ['/site/logout'],
                 'linkOptions' => ['data-method' => 'post']
             ]
          ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
