<?php

namespace frontend\modules\order\models;
use yii\base\Model;
use common\providers\UserByCode;

/**
 * ContactForm is the model behind the contact form.
 */
class AuthentificationCodeDeleteForm extends Model
{
    public $code;
    public $idauthentication;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code'], 'validateCodeDelete'],
            [['idauthentication'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
    
    /**
     * This function is an inline validator
     */
    public function validateCodeDelete($attribute, $params)
    {
        $userManager = new UserByCode();
        $usr = $userManager->getUser($this->code);
        if (empty($usr)){
            $this->addError($attribute, 'Code invalide.');
        }
    }
}

