<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class PasswordResetRequestForm extends Model
{
    public $email;
    public $idUser;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE, 'role' => ['ADMIN', 'DG']],
                'message' => 'This email is not an email address of an administrator.'
            ],
            ['idUser', 'integer'],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        $user = User::findOne(['email' => $this->email, 'role' => ['ADMIN', 'DG']]);
        $account = User::findOne($this->idUser);
        if (!$user || !$account) {
            return false;
        }
        if (!User::isPasswordResetTokenValid($account->password_reset_token)) {
            $account->generatePasswordResetToken();
        }
        if (!$account->save()) {
            return false;
        }

        $mail =  Yii::$app->mail->compose(
                                            ['html' => 'passwordResetToken-html'],
                                            ['user' => $user, 'account' => $account]
                                         )->setFrom('intraweb@seinova.com')
                                          ->setTo($this->email)
                                          ->setSubject("Réinitialisation de mot de passe");
                                          
        return $mail->send();
    }
}
