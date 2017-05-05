
<!-- SETFLASH MESSAGES -->
<div id="flash" style="z-index:1500;position: fixed;left:60%;width: 40%">   
    <?php if (Yii::$app->getSession()->hasFlash('success')): ?>
<!--        <div class='alert alert-success' align="center" >       
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            MARCHE ENREGISTRE AVEC SUCCES
        </div>-->
    <?php endif; ?>

    <?php if (Yii::$app->getSession()->hasFlash('info')): ?>
<!--        <div class='alert alert-info' align="center" style="width: 80%">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>   
            MISE A JOUR DES INFORMATIONS CONCERNANT CE MARCHE EFFECTUE !!!!
        </div>-->
    <?php endif; ?>    

    <?php if (Yii::$app->getSession()->hasFlash('error')): ?>
<!--        <div class='alert alert-error' align="center" style="width: 80%">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            ECHEC D'ENREGISTREMENT!!! TOUTES LES DATES N'ONT PAS ETE RENSEIGNE LORS DE VOTRE MIS A JOUR POUR CET ETAT DU MARCHE
        </div>-->
    <?php endif; ?>
</div>
<!-- /SETFLASH MESSAGES -->

