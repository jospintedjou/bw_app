<?php
namespace backend\modules\accounts\models;

use yii\base\Model;
use Yii;
use common\providers\Account;

class ChangePassForm extends Model
{
    public $password;
    public $confirmPass;
    public $idUser;
    
    public $_user; // the user that perform the action
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Please choose a password'],
            ['confirmPass', 'required', 'message' => 'Please confirm your password'],
            
            ['idUser', 'integer'],

            ['password', 'string', 'min' => 6],
            ['confirmPass', 'compare', 'compareAttribute' => 'password', 'message' => 'Confirmation password do not match with password'],
        ];
    }
    
    
    /**
     * changeassword of an account.
     *
     * @return Array.
     */
    public function changePass()
    {
        if (!$this->validate()) {
            return ['result' => false, 'disconnect' => false];
        }
        $user = (new Account($this->_user))->getUser($this->idUser);
        if (count($user) == 0){
            return ['result' => false, 'disconnect' => false];
        }
        if (($this->_user->role == 'GS' && ($user['role'] == 'DG' || $user['role'] == 'ADMIN')) || ($this->_user->role == 'ADMIN' && ($user['role'] == 'DG' || $user['role'] == 'GS'))){
            return ['result' => false, 'disconnect' => false];
        }
        $usr = [];
        $usr['id'] = $user['id'];
        $usr['password_hash'] = Yii::$app->security->generatePasswordHash($this->password);
        $usr['auth_key'] = Yii::$app->security->generateRandomString();
        $bool = (new Account($this->_user))->updateUser($usr);
        if ($this->idUser == $this->_user->id){
            return ['result' => $bool, 'disconnect' => true];
        }  else {
            return ['result' => $bool, 'disconnect' => false];
        }
    }
}
