<?php
namespace common\models;

use frontend\models\Relatives;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property integer $relative_id
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $activate_key 
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property Relatives $relative

 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 10;
    
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relative_id'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_NOT_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_ACTIVE, self::STATUS_NOT_ACTIVE]],
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    
   /**
     * Finds user by secret key
     *
     * @param string $key secret key
     * @return static|null
     */
    public static function findByActivateKey($key)
    {
        if (!static::isActivateKeyValid($key)) {
            return null;
        }

        return static::findOne([
            'activate_key' => $key,
            'status' => self::STATUS_NOT_ACTIVE,
        ]);
    }    
    
    /**
     * Finds out if secret key is valid
     *
     * @param string $key secret key
     * @return boolean
     */
    public static function isActivateKeyValid($key)
    {
        if (empty($key)) {
            return false;
        }

        $timestamp = (int) substr($key, strrpos($key, '_') + 1);
        $expire = Yii::$app->params['user.activateKeyExpire'];
        return $timestamp + $expire >= time();
    }        

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    
    /**
     * Generates new password activate key
     */
    public function generateActivateKey()
    {
        $this->activate_key = Yii::$app->security->generateRandomString() . '_' . time();
    }    

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
     * Removes secret key
     */
    public function removeActivateKey()
    {
        $this->activate_key = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelative()
    {
        if ($this->relative_id != null)
        {
            $result  = $this->hasOne(Relatives::className(), ['id' => 'relative_id']);
        }
        else
        return $this->hasOne(Relatives::className(), ['id' => 'relative_id']);
    }

    /**
     * Returns full name of relative
     * @return null|string
     */
    public function getRelativeName()
    {
        if ($this->relative_id != null)
        {
            return Relatives::findOne($this->relative_id)->getFullName();
        }
        else
        {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'relative_id' => 'Родственник',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'activate_key' => 'Activate Key',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
