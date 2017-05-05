<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\providers\OurType;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $side = 'frontend';      // the side of application which call the LoginForm

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // side must be a string
            ['side', 'string'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        $usr = User::findByUsername($this->username);
        if ($this->side == 'frontend' && $this->_user === null){
            $this->_user = $usr;
        }else{
            if ($this->_user === null && OurType::getType() != 'cloud' && !(!$usr || ($usr->role != 'DG' && $usr->role != 'GS' && $usr->role != 'MP' && $usr->role != 'ADMIN' && $usr->role != 'BM'))){
                $this->_user = $usr;
            }else if($this->_user === null && OurType::getType() == 'cloud' && !(!$usr || ($usr->role != 'DG' && $usr->role != 'GS' && $usr->role != 'ADMIN'))){
                $this->_user = $usr;
            }
        }
        return $this->_user;
    }
}
