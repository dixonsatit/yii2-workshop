<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LabfuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Labfus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labfu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'SEQ',
            [
              'attribute'=>'SEQ',
              'format'=>'raw',
              'value'=>function($model){
                return Html::a($model->SEQ,['labfu/result','pid'=>$model->PID,'seq'=>$model->SEQ]);
              }
            ],
            'DATE_SERV',
            'PID',
            'HOSPCODE',

            'n',




            // 'LABRESULT',
            // 'D_UPDATE',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>

</div>
