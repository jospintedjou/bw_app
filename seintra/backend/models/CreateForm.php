<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use common\models\Fichier;


class CreateForm extends Model
{
    public $name;
    public $surname;
    public $username;
    public $password;
    public $confirmPass;
    public $email;
    public $role;
    public $photo;
    
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
            ['password', 'required', 'message' => 'Please choose a password'],
            ['confirmPass', 'required', 'message' => 'Please confirm your password'],
            ['role', 'required', 'message' => 'Please choose one role'],
            ['email', 'required', 'message' => 'Please refill your email address'],
            
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['surname', 'required', 'message' => 'Please give your surname'],
            ['surname', 'string'],
            
            ['photo', 'image'],
            ['confirmPass', 'compare', 'compareAttribute' => 'password', 'message' => 'Confirmation password do not match with password'],
            ['password', 'string', 'min' => 6],
            
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address already exist.'],
            ['role', 'in', 'range' => ['DG', 'DT', 'AD', 'ADMIN', 'SDT', 'DEV', 'DC', 'COMP', 'CAISSE']],
        ];
    }
    
    
    /**
     * Create an account. This method serves to create an account.
     *
     * @return Boolean. Is true if the new user is create, otherwise false.
     */
    public function create()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = new User(); $fichier = new Fichier();
        if (($this->_user->role == 'ADMIN' && ($this->role == 'DG' || $this->role == 'ADMIN')) || ($this->_user->role == 'DG' && $this->role == 'DG') || ($this->_user->role != 'DG' && $this->_user->role != 'ADMIN')){
            return false;
        }
        $user->nom = $this->name; $user->prenom = $this->surname;
        $user->username = $this->username; $user->email = $this->email;
        $user->role = $this->role; $user->setPassword($this->password);
        $user->generateAuthKey();
        $bool = $user->save();
        if ($bool == false){
            return false;
        }
        if (isset($this->photo)){
            $namePhoto = 'profile_' . str_replace(' ', '_', $this->name) . '_' . $user->id . '_' . date('Y-m-d') . '.' . $this->photo->extension;
            $this->photo->saveAs('uploads/' . $namePhoto);
        }else{
            $namePhoto = 'user.png';
        }
            $fichier->id_user = $user->id; $fichier->nom = $namePhoto;
            $fichier->type = 'photo';
        return $fichier->save();
    }
}
