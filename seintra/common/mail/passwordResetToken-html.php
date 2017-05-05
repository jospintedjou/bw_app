<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $account common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $account->password_reset_token]);
?>
<div class="password-reset">
    <div>Bonjour <?= Html::encode($user->username) ?>,
        <p>vous avez demandé à modifier l'ancien mot de passe de l'utilisateur <?= Html::encode($account->username) ?>.</p>
        <p>Pour ce faire, suivre le lien suivant :</p>
        <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
        <p>Bien à vous.</p>
        <small><i>Seinova sarl.</i></small>
    </div>
</div>
