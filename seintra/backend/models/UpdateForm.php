<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use common\models\Fichier;

class UpdateForm extends Model
{
    public $name;
    public $surname;
    public $username;
    public $email;
    public $role;
    public $photo;
    public $idUser;
    
    public $_user; // is the user that perform the action


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['name', 'required', 'message' => 'Please refill your name'],
            ['username', 'required', 'message' => 'Please choose an username'],
            ['role', 'required', 'message' => 'Please choose one role'],
            ['email', 'required', 'message' => 'Please refill your email address'],
            
            ['username', 'validateUsername', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['surname', 'required', 'message' => 'Please give your surname'],
            ['surname', 'string'],
            
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'validateEmail', 'message' => 'This email address already exist.'],
            
            ['photo', 'image'],
            ['idUser', 'integer'],
            ['role', 'in', 'range' => ['DG', 'DT', 'AD', 'ADMIN', 'SDT', 'DEV', 'DC', 'COMP', 'CAISSE']],
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
        $user = User::findByUsername($this->username);
        if ($user && $user->id != $this->idUser) {
            $this->addError($attribute, 'This username has already been taken.');
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
        $user = User::find()->where(['email' => $this->email])->one();
        if ($user && $user->id != $this->idUser) {
            $this->addError($attribute, 'This email address has already been taken.');
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
        if (($this->_user->role == 'ADMIN' && $this->role == 'DG') || ($this->_user->role != 'ADMIN' && $this->_user->role != 'DG')){
            return false;
        }
        $user = User::findOne($this->idUser);
        if (empty($user) || ($this->_user->role == 'ADMIN' && $user->role != 'ADMIN' && $this->role == 'ADMIN') || ($this->_user->role == 'ADMIN' && $user->role != 'DG' && $this->role == 'DG') || ($this->_user->role == 'DG' && $user->role == 'DG' && $this->role != 'DG')){
            return false;
        }
        $fichier = Fichier::find()->where(['id_user' => $this->idUser, 'type' => 'photo'])->one();
        
        $user->nom = $this->name; $user->prenom = $this->surname;
        $user->username = $this->username; $user->email = $this->email;
        $user->role = $this->role;
        $bool = $user->save();
        if (!$bool){
            return false;
        }
        if (!isset($fichier) || $fichier === null){
            $fichier = new Fichier();
            $fichier->nom = 'uploads/user.png';
            $fichier->id_user = $this->idUser;
            $fichier->type = 'photo';
        }
        if (isset($this->photo)){
            $baseName = 'profile_' . str_replace(' ', '_', $user->nom) . '_' . $user->id . '_' . date('Y-m-d');
            if (file_exists('uploads/' . $baseName . '.' . $this->photo->extension)){
                unlink('uploads/' . $baseName . '.' . $this->photo->extension);
                $baseName = $baseName . '1';
            }
            $this->photo->saveAs('uploads/' . $baseName . '.' . $this->photo->extension);
            $fichier->nom = $baseName . '.' . $this->photo->extension;
        }
        return ($bool && $fichier->save());
    }
}
