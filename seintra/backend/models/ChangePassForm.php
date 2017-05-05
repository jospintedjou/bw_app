<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;

class ChangePassForm extends Model
{
    public $password;
    public $confirmPass;
    public $previousPass;
    public $idUser;
    
    public $idChanger; // is the id of user that perform the action
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Please choose a password'],
            ['confirmPass', 'required', 'message' => 'Please confirm your password'],
            ['previousPass', 'required', 'message' => 'Please refill previous password'],
            
            ['idUser', 'integer'],

            ['password', 'string', 'min' => 6],
            ['confirmPass', 'compare', 'compareAttribute' => 'password', 'message' => 'Confirmation password do not match with password'],
            
            ['previousPass', 'validatePreviousPassword', 'message' => 'Incorrect previous password'],
        ];
    }
    
    /**
     * Validates the previous password.
     * This method serves as the inline validation for previousPassword.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePreviousPassword($attribute, $params)
    {
        $user = User::findOne($this->idUser);
        if (!$user || !$user->validatePassword($this->previousPass)) {
            $this->addError($attribute, 'Incorrect previous password.');
        }
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
        $changer = User::findOne(['id' => $this->idChanger]);
        if ($changer && $changer->role != 'ADMIN' && $changer->role != 'DG'){
            return ['result' => false, 'disconnect' => false];
        }
        $user = User::findOne($this->idUser);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $bool = $user->save();
        if ($this->idUser == $this->idChanger){
            return ['result' => $bool, 'disconnect' => true];
        }  else {
            return ['result' => $bool, 'disconnect' => false];
        }
    }
}
