<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя уже используется.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Эта электронная почта уже используется.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE
            ]],
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],            
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($this->sendSignupEmail($user))
            {
                Yii::$app->session->setFlash('success', 'Уведомление успешно отправлено');
            }
            else
            {
                Yii::$app->session->setFlash('danger', 'Произошла ошибка при отправке уведомления.');
            }
            
            if($this->scenario === 'emailActivation')
            {
                $user->generateActivateKey();
            }
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
    
    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
                ->setFrom([Yii::$app->params['supportEmail'] => 'gapchich.ru (отправлено роботом).'])
                ->setTo(Yii::$app->params['supportEmail'])
                ->setSubject('Активация для '.Yii::$app->name)
                ->send();
    }
    
/**
 * 
 * @param User $user
 */    
    private function sendSignupEmail($user)
    {
        return Yii::$app->mailer->compose('newUserEmail', ['user' => $user])
//                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом).'])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом).'])
                ->setTo(Yii::$app->params['supportEmail'])
                ->setSubject('Регистрация нового пользователя '.$user->username)
                ->send();        
    }
}
