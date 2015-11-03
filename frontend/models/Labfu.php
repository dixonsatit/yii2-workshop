<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%labfu}}".
 *
 * @property string $HOSPCODE
 * @property string $PID
 * @property string $SEQ
 * @property string $DATE_SERV
 * @property string $LABTEST
 * @property integer $LABRESULT
 * @property string $D_UPDATE
 */
class Labfu extends \yii\db\ActiveRecord
{
    public $n;
    public $LABTEST_BEFORE;
    public $LABRESULT_BEFORE;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%labfu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'PID', 'SEQ', 'DATE_SERV', 'LABTEST', 'LABRESULT', 'D_UPDATE'], 'required'],
            [['DATE_SERV', 'D_UPDATE'], 'safe'],
            [['LABRESULT'], 'integer'],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['PID'], 'string', 'max' => 15],
            [['SEQ'], 'string', 'max' => 16],
            [['LABTEST'], 'string', 'max' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HOSPCODE' => Yii::t('app', 'Hospcode'),
            'PID' => Yii::t('app', 'Pid'),
            'SEQ' => Yii::t('app', 'Seq'),
            'DATE_SERV' => Yii::t('app', 'Date  Serv'),
            'LABTEST' => Yii::t('app', 'Labtest'),
            'LABRESULT' => Yii::t('app', 'Labresult'),
            'D_UPDATE' => Yii::t('app', 'D  Update'),
        ];
    }

    /**
     * @inheritdoc
     * @return LabfuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LabfuQuery(get_called_class());
    }

    public static function getResult($model){
      $value =  isset($model['LABRESULT_BEFORE']) ? $model['LABRESULT'] - $model['LABRESULT_BEFORE'] : '';
      if($value > 0){
        return '<span class="text-danger"><i class ="glyphicon glyphicon-arrow-up"></i> '.$value.'</span>';
      }elseif($value == 0){
        return '-';
      }else{
        return '<span class="text-success"><i class ="glyphicon glyphicon-arrow-down"></i> '.$value.'</span>';
      }
    }


}
