<?php
namespace backend\modules\accounts\models;

use yii\base\Model;
use common\providers\Account;


class DeleteForm extends Model
{
    public $idUser;
    
    public $_user; // is the user that perform the action


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['idUser', 'integer'],
        ];
    }
    
    
    /**
     * Delete an account. This method serves to delete an account.
     *
     * @return Boolean. Is true if the new user is create, otherwise false.
     */
    public function delete()
    {
        $account = new Account($this->_user);
        $user = $account->getUser($this->idUser);
        if (!$this->validate() || count($user) == 0) {
            return false;
        }
        if (($this->_user->role != 'DG' && ($user['role'] == 'DG' || $user['role'] == 'ADMIN' || $user['role'] == 'GS')) || ($this->_user->role == 'DG' && $user['role'] == 'DG')){
            return false;
        }
        
        return $account->updateUser(['id' => $this->idUser, 'id_supp' => $this->_user->id]);
    }
}
