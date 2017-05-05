<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use linchpinstudios\backstretch\Backstrech;

$this->title = 'Reset password';
$this->registerCssFile('css/style.css');
?>
<div class="site-reset-password">
    <div class="row text-center">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <h2 id="header-form"><?= Html::encode($this->title) ?></h2>
                <div id="wrapper-form">
                    <p>Please type new password for : <?= Html::encode(strtoupper($user->nom)) ?></p>

                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                    <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-block btn-theme']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
    </div>
    
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <?= Backstrech::widget([
                                'clickEvent' => false,
                                'images' => [['image' => 'uploads/seinovaLogo.jpg']],
                                'options' => ['fade' => 500],
                            ]);
    ?>
</div>
