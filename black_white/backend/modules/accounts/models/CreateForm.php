<?php
namespace backend\modules\accounts\models;

use yii\base\Model;
use Yii;
use common\providers\Account;


class CreateForm extends Model
{
    public $name;
    public $surname;
    public $sex;
    public $username;
    public $password;
    public $confirmPass;
    public $telephone;
    public $email;
    public $role;
    public $photo;  // it's a photo file
    
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
            ['telephone', 'filter', 'filter' => 'trim'],
            
            ['name', 'required', 'message' => 'Remplissez le champ nom'],
            ['username', 'required', 'message' => "Choisissez un nom d'utilisateur"],
            ['password', 'required', 'message' => 'Choisissez un mot de passe'],
            ['confirmPass', 'required', 'message' => 'Veuillez confirmer le mot de passe'],
            ['role', 'required', 'message' => 'Choisissez un poste'],
            ['sex', 'required', 'message' => 'Entrez le sexe'],
            ['sex', 'in', 'range' => ['homme', 'femme']],
            
            ['username', 'validateUsername'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['surname', 'string'],
            ['telephone', 'validateTelephone'],
            ['telephone', 'string'],
            
            ['photo', 'image'],
            ['confirmPass', 'compare', 'compareAttribute' => 'password', 'message' => 'Les mots de passe doivent etre identiques.'],
            ['password', 'string', 'min' => 6],
            
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'validateEmail'],
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
        if (count($ids) > 0) {
            $this->addError($attribute, "Ce nom d'utilisateur appartient deja a quelqu'un d'autre.");
        }
    }
    
    /**
     * Validates the phone number.
     * This method serves as the inline validation for phone number.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateTelephone($attribute, $params)
    {
        $ids = (new Account($this->_user))->getIdUsers(['telephone' => $this->telephone]);
        if (count($ids) > 0) {
            $this->addError($attribute, "Ce numero de telephone appartient deja a quelqu'un d'autre.");
        }
    }
    
    /**
     * Validates the email address.
     * This method serves as the inline validation for email address.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        $ids = (new Account($this->_user))->getIdUsers(['email' => $this->email]);
        if (count($ids) > 0) {
            $this->addError($attribute, "Cette adresse email appartient deja a quelqu'un d'autre.");
        }
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
        if (($this->_user->role != 'DG' && ($this->role == 'DG' || $this->role == 'ADMIN' || $this->role == 'GS')) || ($this->_user->role == 'DG' && $this->role == 'DG')){
            return false;
        }
        $usr = [];
        $usr['nom'] = $this->name; $usr['prenom'] = $this->surname; $usr['sexe'] = $this->sex;
        $usr['username'] = $this->username; $usr['telephone'] = $this->telephone; $usr['email'] = $this->email;
        $usr['role'] = $this->role; $usr['password_hash'] = Yii::$app->security->generatePasswordHash($this->password);
        $usr['auth_key'] = Yii::$app->security->generateRandomString();
		
        $havePhoto = false;
        if (isset($this->photo)){
            $havePhoto = true;
        }
        return (new Account($this->_user))->createUser($usr, $havePhoto, $this->photo);
    }
}
