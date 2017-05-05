<?php
namespace backend\modules\accounts\models;

use yii\base\Model;
use common\providers\Account;


class ChangePhotoForm extends Model
{
    public $idUser; // is the user to update profile photo
    public $photo;
    
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
     * This function allow to edit profile photo.
     *
     * @params String $name the name of the cropped photo.
     * @return Boolean whether edition is complete successfully.
     */
    public function change($name)
    {
        if (!$this->validate()){
            return false;
        }
        $accountManager = new Account($this->_user);
        if (($this->_user->role == 'GS' && ($this->role == 'DG' || $this->role == 'ADMIN')) || ($this->_user->role == 'ADMIN' && ($this->role == 'DG' || $this->role == 'GS'))){
            return false;
        }
        if (count($accountManager->getIdUsers(['id' => $this->idUser])) == 0){
            return false;
        }
        $user = $accountManager->getUser($this->idUser);
        $arr = explode(".", $name);
        $nameTof = 'profile_' . str_replace(' ', '_', $user['nom']) . '_' . $user['id'] . '_' . date('Y-m-d') . '.' . $arr[1];
        $a = rename($name, 'uploads/' . $nameTof);
        $b = $accountManager->update('photo', ['nom' => $nameTof], ['id_photo' => $user['id_photo']]);
        if (!$a || $b != 1){
            return false;
        }
        return true;
    }
    
}
