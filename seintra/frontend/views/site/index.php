<?php
/* @var $this yii\web\View */

$this->title = 'Acceuil';
?>
<div class="" style="background-image:url('uploads/seinovaHome.png');background-repeat: no-repeat;background-size:70%;background-position: center;height: 62em;margin-top:10px; margin-bottom:0%;opacity: ">
   
    <div align="center" style="margin-top:2%;border: #0CF 1px solid;border-radius: 20px;z-index: 2000;position: absolute;align-content: center;margin-left:15%;background-color: #ffffff;opacity: 0.5">

        <div >  
            <h1>Vous êtes la bienvenue sur SEINTRA,<?= ucfirst( Yii::$app->user->identity->nom) ?></h1>
            <h2>Connecté(e) en tant que <?= Yii::$app->user->identity->role ?></h2>
        </div>
    </div>

</div>
