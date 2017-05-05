<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Reunion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(); ?>
            
            
                    <?= $form->field($model, 'titre')->textInput() ?>

                   <?= $form->field($model, 'description')->textArea(['rows' => 6]) ?>

                    <?= $form->field($model, 'heuredebut')->textInput()?>

                    <?= $form->field($model, 'heurefin')->textInput() ?>
            
                    <?= $form->field($model, 'lieu')->textInput() ?>

                    <?= $form->field($model, 'date')->textInput() ?>
      
              
                <div class="form-group">
                    <?= Html::submitButton('SAVE MEETING', ['value'=>Url::to('index.php?r=meeting/meeting/create'),  'class' => 'btn btn-primary', 'name' => 'contact-button', 'id'=>'modalButton']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
