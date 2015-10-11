<?php

namespace frontend\models;

use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;
use common\models\User;
use backend\models\AuthAssignment;
use backend\models\AuthItem;

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
        $result = $user->save();
        
        $assignment = new AuthAssignment();
        $assignment->item_name = 'user';
        $assignment->user_id = $user->id;
        $assignment->created_at = time();
        $result2 = $assignment->save(false,['item_name', 'user_id', 'created_at']);
        
        return $result;
    }
    
    public function getUsername()
    {
        $user = $this->_user;
        return $user->username;
    }
}
