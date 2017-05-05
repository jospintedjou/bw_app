<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" >
    <div class="col-md-3"></div>
<div id="fenetre"></div>
<div class="col-lg-3"></div>
</div>
    <div class="right_col well large" role="main"  >

        <!-- top tiles -->
        <div class='col-md-offset-2' style="margin-top: 5%">  
            <h1>Welcome to SEINOVA SARL INTRANET</h1>
        </div>
        <h3 class='col-md-offset-4'>&nbsp;We make your life easy</h3>  

        <div class="site-login" >

            <div align="center" >
                <h1><?= Html::encode($this->title) ?></h1>

                <p class="alert alert-info"><strong>PLEASE FILL THE FORM BELOW TO LOGIN.</strong></p>
            </div> 


        </div>             
    </div>

<div class="row" >
    <div class="col-md-3"></div>
    <div class="col-lg-5" style="">               
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-3"></div>

</div>
<?php
$this->registerCss(" "
        . "div .right_col{margin-bottom:-120px}"
        . ".footer{margin-left:210px;margin-right:14px}"
        . ".col-lg-5{border: 2px #777777 double;border-radius: 15px;height: 20em;width: 51%;background-color: #2A3F54 ;padding:8px; margin-top: -47%;margin-left: 2%;opacity:0.9 }"
        . ".site-login{height: 60em;background-image:url('uploads/seinovaLogo.png');background-repeat: no-repeat;background-position: center;background-size: 80%}"
        . ".alert{width:51%;margin-left:8%;margin-right:3%}"
        . "#fenetre{background-color:black;opacity:0.6;height: 1000px;position:absolute;z-index:3000;margin-top:2000%}"
)?>