<?php // 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use linchpinstudios\backstretch\Backstrech;

$this->title = 'Login';
?>


<div class="ba">
    <?= Backstrech::widget([
                                'clickEvent' => false,
                                'images' => [['image' => 'uploads/Black_1.jpg']],
                                'options' => ['fade' => 500],
                            ]);
    ?>   
</div>
<div class="" style="margin-top: 8%;margin-bottom: 18%;">
    <div class="" >
        <center>
            <div class="" role="main">

                <!-- top tiles -->
                <div class="row">  
                    <h1 class="fontsize">Welcome to BLACK&WHITE</h1>
                </div>
                
                <div class="row">

                    <div align="center" >
                        <h1 class="fontsize"><?= Html::encode($this->title) ?></h1>
<!--                        <p class="alert alert-info"><strong>PLEASE FILL THE FORM BELOW TO LOGIN.</strong></p>-->
                    </div> 

                </div>             
            </div>
        </center>

        <div class=" col-lg-offset-4 col-md-offset-2 col-sm-offset-3 col-xs-offset-1">
            <div class=" col-lg-5 col-lg-8 col-md-8 col-sm-8 col-xs-10 " style="background-color: black;">    

                <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form-horizontal']); ?>
                    <div class = "form-group form-group-sm">
                        <?= $form->field($model, 'username')->textInput(['placeholder'=>'username','autofocus' => true,'class'=>'form-control input-lg'])->label(FALSE) ?>
                    </div>
                    <div class = "form-group form-group-sm">
                        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'password','class'=>'form-control input-lg'])->label(FALSE) ?>
                    </div>
                    <div class = "form-group form-group-sm">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>

                    <div class="form-group form-group-sm" align="center">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
       
    </div>
    
</div>
<?php
$this->registerCss(" "
        . "div .right_col{margin-bottom:-120px}"
        . ".footer{margin-left:210px;margin-right:14px}"
        . ".col-lg-5{border: 2px #777777 double;border-radius: 15px;background-color: #2A3F54 ;padding-top:15px;margin-left: 3%;opacity:0.9; }"
        . ".site-login{height: 60em;background-image:url('uploads/seinovaLogo.png');background-repeat: no-repeat;background-position: center;background-size: 80%}"
        . ".alert{width:51%;margin-left:8%;margin-right:3%}"
        . "#fenetre{background-color:black;opacity:0.6;height: 1000px;position:absolute;z-index:3000;margin-top:2000%}"
)?>
