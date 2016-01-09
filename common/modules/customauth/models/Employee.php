<?php

namespace common\modules\customauth\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $title
 * @property string $name
 * @property string $surname
 * @property integer $status
 */
class Employee extends \yii\db\ActiveRecord implements  IdentityInterface
{
    public $confirm_password;

    public function scenarios(){
      $scenarios = parent::scenarios();
      $scenarios['setting'] = ['username','password','confirm_password','email'];
      return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','password','confirm_password','email'], 'required','on'=>['default']],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => '\common\modules\customauth\models\Employee', 'message' => 'This username has already been taken.'],
            [['status'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['username', 'title', 'name', 'surname'], 'string', 'max' => 150],
            ['confirm_password','compare','compareAttribute'=>'password'],


            [['username','email'], 'required','on'=>'setting'],
            [['confirm_password','password'], 'string', 'min' => 6,'skipOnEmpty'=>true,'on'=>'setting'],
            ['confirm_password','compare','skipOnEmpty'=>false,'compareAttribute'=>'password','on'=>'setting']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'อีเมล์'),
            'username' => Yii::t('app', 'ชื่อผู้ใช้งาน'),
            'password' => Yii::t('app', 'รหัสผ่าน'),
            'title' => Yii::t('app', 'คำนำหน้า'),
            'name' => Yii::t('app', 'ชื่อ'),
            'surname' => Yii::t('app', 'นามสกุล'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
    }

    public static function findByUsername($username){
      return static::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
      return $this->password === $this->encrypt($password);
    }

    public function setPassword($password){
      $this->password = $this->encrypt($password);
    }

    public function encrypt($string){
      switch (Yii::$app->getModule('customauth')->encrypt) {
        case 'md5':
          return md5($string);
          break;
        case 'sha1':
          return sha1($string);
          break;
        case 'passwordHash':
          return Yii::$app->security->generatePasswordHash($string);
          break;
      }
    }

    // ==================== IdentityInterface =============================
    /**
       * Finds an identity by the given ID.
       *
       * @param string|integer $id the ID to be looked for
       * @return IdentityInterface|null the identity object that matches the given ID.
       */
      public static function findIdentity($id)
      {
          return static::findOne($id);
      }

      /**
       * Finds an identity by the given token.
       *
       * @param string $token the token to be looked for
       * @return IdentityInterface|null the identity object that matches the given token.
       */
      public static function findIdentityByAccessToken($token, $type = null)
      {
          throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
      }

      /**
       * @return int|string current user ID
       */
      public function getId()
      {
          return $this->id;
      }

      /**
       * @return string current user auth key
       */
      public function getAuthKey()
      {
          //return $this->auth_key;
      }

      /**
       * @param string $authKey
       * @return boolean if auth key is valid for current user
       */
      public function validateAuthKey($authKey)
      {
          //return $this->getAuthKey() === $authKey;
      }
}
