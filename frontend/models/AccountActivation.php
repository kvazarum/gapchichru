<?php

namespace frontend\models;

use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;
use common\models\User;

/**
 * 
 * @property string $username
 * @author ingvar
 */
class AccountActivation extends Model
{
    /* @var $_user \app\models\User */
    private $_user;
    
    public function __construct($key, $config = []) {
        if (empty($key) || !is_string($key))
        {
            throw new InvalidParamException('Ключ не может быть пустым!');
        }
        $this->_user = User::findByActivateKey($key);
        if (!$this->_user)
        {
            throw new InvalidParamException('Неверный ключ!');
        }
        parent::__construct($config);
    }
    
    public function activateAccount()
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        $user->removeActivateKey();
        return $user->save();
    }
    
    public function getUsername()
    {
        $user = $this->_user;
        return $user->username;
    }
}
