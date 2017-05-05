<!-- SET FLASH -->
<!--<div id="flash" style="z-index:1500;position: fixed;left:60%;width: 40%">--> 
    <?php if (Yii::$app->getSession()->hasFlash('success')): ?>
<!--        <div class='alert alert-success' align="center" >       
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            VOTRE CLIENT A ETE BIEN ENREGISTRER
        </div>-->
    <?php endif; ?>

    <?php if (Yii::$app->getSession()->hasFlash('warning')): ?>
<!--        <div class='alert alert-info' align="center" >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>   
            LA MISE A JOUR DES INFORMATIONS CONCERNANT VOTRE CLIENT A ETE BIEN PRIS EN COMPTE !!!!
        </div>-->
    <?php endif; ?>

    <?php if (Yii::$app->getSession()->hasFlash('info')): ?>
<!--        <div class='alert alert-info' align="center" >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>   
            PRISE DE CONTACT CLIENT ENREGISTRE AVEC SUCCES
        </div>-->
    <?php endif; ?>

    <?php if (Yii::$app->getSession()->hasFlash('error')): ?>
<!--        <div class='alert alert-error' align="center" >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            ECHEC D'ENREGISTREMENT!!! CE CLIENT EXISTE DEJA DANS LE SYSTEME  ENREGISTRER JUSTE  LES INFORMATIONS LE CONCERNANT
        </div>-->
    <?php endif; ?>
<!--</div>-->
<!-- /SET FLASH -->

