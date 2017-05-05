<?php
namespace backend\modules\accounts\models;

use yii\base\Model;
use common\providers\Account;

class UpdateForm extends Model
{
    public $name;
    public $surname;
    public $sex;
    public $username;
    public $phoneNumber;
    public $email;
    public $role;
    public $idUser;
    
    public $_user; // is the user that perform the action


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['name', 'filter', 'filter' => 'trim'],
            ['surname', 'filter', 'filter' => 'trim'],
            ['phoneNumber', 'filter', 'filter' => 'trim'],
            
            ['name', 'required', 'message' => 'Veuillez remplir le nom'],
            ['username', 'required', 'message' => "Choisissez un nom d'utilisateur"],
            ['role', 'required', 'message' => 'Indiquez le poste'],
            ['sex', 'required', 'message' => 'Indiquez le sexe'],
            ['sex', 'in', 'range' => ['homme', 'femme']],
            
            ['username', 'validateUsername', 'message' => "Nom d'utilisateur déjà pris."],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['surname', 'string'],
            ['phoneNumber', 'string'],
            ['phoneNumber', 'validatePhoneNumber', 'message' => 'Numéro de téléphone déjà pris.'],
            
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'validateEmail', 'message' => 'Email déjà pris.'],
            
            ['idUser', 'integer'],
            ['role', 'in', 'range' => ['DG','GS', 'MP', 'BM', 'SE', 'CU', 'VI', 'GP', 'AU', 'ADMIN']],
        ];
    }
    
    
    /**
     * Validates the username.
     * This method serves as the inline validation for username.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUsername($attribute, $params)
    {
        $ids = (new Account($this->_user))->getIdUsers(['username' => $this->username]);
        if (count($ids) > 1 || (count($ids) == 1 && $ids[0]['id'] != strval($this->idUser))) {
            $this->addError($attribute, "Ce nom d'utilisateur appartient deja a quelqu'un d'autre.");
        }
    }
    
    
    /**
     * Validates the email.
     * This method serves as the inline validation for email.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        $ids = (new Account($this->_user))->getIdUsers(['email' => $this->email]);
        if (count($ids) > 1 || (count($ids) == 1 && $ids[0]['id'] != strval($this->idUser))) {
            $this->addError($attribute, "Cette adresse email appartient deja a quelqu'un d'autre.");
        }
    }
    
    
    /**
     * Validates the phone number.
     * This method serves as the inline validation for phoneNumber.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePhoneNumber($attribute, $params)
    {
        $ids = (new Account($this->_user))->getIdUsers(['telephone' => $this->phoneNumber]);
        if (count($ids) > 1 || (count($ids) == 1 && $ids[0]['id'] != strval($this->idUser))) {
            $this->addError($attribute, "Ce numero de telephone appartient deja a quelqu'un d'autre.");
        }
    }
    
    
    /**
     * Update an account.
     *
     * @return Boolean. Is true if the update is update, otherwise false.
     */
    public function update()
    {
        if (!$this->validate()) {
            return false;
        }
        if (($this->_user->role == 'GS' && ($this->role == 'DG' || $this->role == 'ADMIN')) || ($this->_user->role == 'ADMIN' && ($this->role == 'DG' || $this->role == 'GS'))){
            return false;
        }
        if (count((new Account($this->_user))->getIdUsers(['id' => $this->idUser])) == 0){
            return false;
        }
        $usr = []; $usr['nom'] = $this->name;
        $usr['prenom'] = $this->surname; $usr['sexe'] = $this->sex;
        $usr['username'] = $this->username;
        if ($this->phoneNumber == ''){
            $usr['telephone'] = null;
        }else{
            $usr['telephone'] = $this->phoneNumber;
        }
        $usr['email'] = $this->email; $usr['role'] = $this->role;
        $usr['id'] = $this->idUser;
        
        return (new Account($this->_user))->updateUser($usr);
    }
}
