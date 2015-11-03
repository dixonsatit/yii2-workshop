<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Labfu;
//print_r($last);
?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'SEQ',
            'DATE_SERV',
            'PID',
            'LABTEST',
            //'LABTEST_BEFORE',
            'LABRESULT_BEFORE',

            'LABRESULT',
            // [
            //   'header'=>'ส่วนต่าง',
            //   'format'=>'raw',
            //   'value'=>function($model){
            //     $value =  isset($model['LABRESULT_BEFORE']) ? $model['LABRESULT'] - $model['LABRESULT_BEFORE'] : '';
            //     if($value > 0){
            //       return '<span class="text-danger"><i class ="glyphicon glyphicon-arrow-up"></i> '.$value.'</span>';
            //     }elseif($value == 0){
            //       return '-';
            //     }else{
            //       return '<span class="text-success"><i class ="glyphicon glyphicon-arrow-down"></i> '.$value.'</span>';
            //     }
            //
            //   }
            // ]
            [
              'header'=>'ส่วนต่าง',
                'format'=>'raw',
                'value'=>function($model){
                  return Labfu::getResult($model);
                }
              ]


            // 'D_UPDATE',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
