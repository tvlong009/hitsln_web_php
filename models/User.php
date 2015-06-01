<?php
namespace app\models;
use yii\helpers\Security;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $auth_key
 * @property string $password
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $require_change_password
 * @property string $avatar
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public  $re_password;
    public static function tableName() {
        return 'tmucms.user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'auth_key', 'password', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'require_change_password'], 'integer'],
            [['username', 'name', 'password', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'email'],

            [['avatar'], 'file','extensions' => 'csv, jpg, jpeg', ],
            [['avatar'], 'file', 'maxFiles' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'username' => Yii::t('app','Username'),
            'name' => Yii::t('app','Name'),
            'auth_key' => Yii::t('app','Auth Key'),
            'password' => Yii::t('app','Password'),
            'password_reset_token' => Yii::t('app','Password Reset Token'),
            'email' => Yii::t('app','Email'),
            'status' => Yii::t('app','Status'),
            'created_at' => Yii::t('app','Created At'),
            'updated_at' => Yii::t('app','Updated At'),
            'require_change_password' => Yii::t('app','Require Change Password'),
            'avatar'=>Yii::t('app','Your avatar'),
            're_password'=> Yii::t('app','Repeat Password'),
        ];
    }

   /**
     * @inheritdoc
     */
    public static function findIdentity ($id) {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken ($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername ($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken ($token) {

        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne(['password_reset_token' => $token]);

    }


    /**
     * @inheritdoc
     */
    public function getId () {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey () {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey ($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword ($password) {
        return $this->password === sha1($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword ($password) {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey () {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken () {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken () {
        $this->password_reset_token = null;
    }

}
