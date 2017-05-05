<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use linchpinstudios\backstretch\Backstrech;

$this->title = 'Login';
$this->registerCssFile('css/style.css');
?>
<div id="login-page">
    <div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <h2 id="header-form">sign in now</h2>
            <div id="wrapper-form">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-theme btn-block', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
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
