<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $account common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token,
                                                                              'idAccount' => $account->id]);
?>
Bonjour <?= Html::encode($user->username) ?>,
Vous avez demandé à écraser l'ancien mot de passe de l'utilisateur <?= Html::encode($account->username) ?>
Pour ce faire, suivre le lien suivant :
<?= Html::a(Html::encode($resetLink), $resetLink) ?>
Bien à vous.
Seinova sarl.
