<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\growl\GrowlAsset;
use kartik\widgets\Growl;

$this->title = 'Comptes';
$this->registerCssFile('css/style.css');
GrowlAsset::register($this);

$critere = $postesUpdate;
$critere['ALL'] = 'Tous';
?>

<!-- page content -->

        <?php Pjax::begin(['id' => 'pjax-box']);?>
            <div class="page-title">
               <div class='row'>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="color: #000000;">
                        <h4 style="color: #0099ff; font-weight: bold;">Liste des comptes</h4>
                    </div>
               
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-center">
                    <div class="row">
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Trier par:</label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?= Html::dropDownList('critere', 'ALL', $critere, ['id' => 'critere', 'value' => '#', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <center>
                        <?= Html::button('<span class="glyphicon glyphicon-plus"></span> Nouveau compte', ['id' => 'createBtn', 'class' => 'btn btn-primary btn-sm btn-xs', 'style' => 'margin-bottom: 3%; margin-top: 3%;']); ?>
                    </center>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
           
            <div class="row" >
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel" style="min-height: 74vh; width: 95%; margin-left:3%">
                        <div class="x_content">
                            <div class="row" id="account_container">
                                <div></div>
                                <div></div>
                                <?php 
                                    foreach ($accounts as $account){
                                ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details <?= $account['role']; ?>">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                            <h4 class="brief"><strong><i><?= $account['poste']; ?></i></strong></h4>
                                                <div class="left col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <div min-height="200px">
                                                        <h2><strong><?= $account['nom'] . ' ' . $account['prenom'] ?></strong></h2>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-id-card"></i> <strong>Code: </strong> <i><?= $account['code']; ?></i></li>
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i><?= $account['username']; ?></i></li>
                                                            <li><i class="<?= ($account['sexe'] == 'homme')? 'fa fa-male': 'fa fa-female' ?>"></i> <strong>: </strong> <i><?= $account['sexe']; ?></i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i><?= $account['email']; ?></i></li>
                                                            <li><i class="fa fa-phone"></i> <strong>Tel: </strong> <i><?= $account['telephone']; ?></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-xs-4 text-center">
                                                    <img src="<?= 'uploads/' . $account['nom_photo']; ?>" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><?= Html::a('View', ['view-account', 'id_user' => $account['id']], ['class'=>'btn btn-success btn-xs']) ?></div>
                                                    <div class="col-xs-6 text-center"><?= Html::button('Edit', ['value' => Url::to(['find-account', 'id' => $account['id']]), 'class' => 'btn btn-info btn-xs updateBtn']); ?></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><?= Html::button('Edit Password', ['value' => $account['id'], 'class' => 'changePWDBtn btn btn-info btn-xs']); ?></div>
                                                    <div class="col-xs-6 text-center"><?= ($account['role'] != 'DG' && $account['id'] != $user->id)? Html::button('Delete', ['value' => $account['id'], 'class' => 'btn btn-danger btn-xs deleteBtn']): ''; ?></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php Pjax::end();?>
    
<!-- /page content -->

    <?php
        Modal::begin([
            'id' => 'deleteModal',
            'header' => '<h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Attention</h4>',
            'size' => Modal::SIZE_SMALL,
        ]);
    ?>
        <?php
        $formDelete = ActiveForm::begin([
                                    'id' => 'deleteAccount-form',
                                    'action' => Url::to(['account/delete']),
                                    'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']
                    ]);
        ?>
            
        <div class="text-center">
            <h5>Etes-vous sûr de vouloir supprimer ce compte?</h5>
        </div>

        <?= $formDelete->field($modelDelete, 'idUser')->hiddenInput(['id' => 'idUserDelete'])->label(false) ?>

        <div class="modal-footer">
            <?= Html::submitButton('Supprimer', ['class' => 'btn btn-primary'])?>
            <?= Html::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])?>
        </div>
        <?php ActiveForm::end();?>
    <?php Modal::end();?>



    <?php
        Modal::begin([
            'id' => 'createModal',
            'header' => '<h4>Création de compte</h4>',
        ]);
    ?>
        <?php
        $form = ActiveForm::begin([
                                    'id' => 'createAccount-form',
                                    'action' => Url::to(['account/create']),
                                    'validationUrl' => ['account/validate', 'natureModel' => 'create'],
                                    'options' => ['class' => 'form-horizontal',
                                                  'enctype' => 'multipart/form-data']
                    ]);
        ?>

            <?= $form->field($modelCreate, 'name')->textInput()->label('Nom:') ?>
            <?= $form->field($modelCreate, 'surname')->textInput()->label('Prénom:') ?>
            <?= $form->field($modelCreate, 'sex')->dropDownList(['homme' => 'homme', 'femme' => 'femme'], ['id'=>'sexeId', 'prompt' => '-- Choisissez un sexe --'])->label('Sexe:');?>
            <?= $form->field($modelCreate, 'username', ['enableAjaxValidation' => true])->textInput()->label("Nom d'utilisateur:") ?>
            <?= $form->field($modelCreate, 'password')->passwordInput()->label('Mot de passe:') ?>

            <?= $form->field($modelCreate, 'confirmPass')->passwordInput()->label('Repéter le mot de passe:') ?>
            <?= $form->field($modelCreate, 'telephone', ['enableAjaxValidation' => true])->textInput()->label('Numéro de téléphone:') ?>
            <?= $form->field($modelCreate, 'email', ['enableAjaxValidation' => true])->input('email')->label('Email:') ?>
            <?= $form->field($modelCreate, 'role')->dropDownList($postesCreate, ['id'=>'rolesId', 'prompt' => '--Choisissez un poste--'])->label('Poste:');?>
            <?= $form->field($modelCreate, 'photo')->fileInput()->label('Photo:'); ?>


        <div class="col-sm-12 modal-footer">
            <?= Html::submitButton('Créer', ['class' => 'btn btn-primary'])?>
            <?= Html::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])?>
            <div style="display: none"><?= Html::resetButton('Reset', ['class' => 'btn btn-default', 'id' => 'resetFormCreateBtn']);?></div>
        </div>
        <?php ActiveForm::end();?>
    <?php Modal::end();?>




    <?php
        Modal::begin([
            'id' => 'updateModal',
            'header' => '<h4>Modifier le compte</h4>',
        ]);
    ?>
        <?php
        $formUpdate = ActiveForm::begin([
                                    'id' => 'updateAccount-form',
                                    'action' => Url::to(['account/update']),
                                    'validationUrl' => ['account/validate', 'natureModel' => 'update'],
                                    'options' => ['class' => 'form-horizontal',
                                                  'enctype' => 'multipart/form-data'],
                                    ]);
        ?>

        <div>
            <?= $formUpdate->field($modelUpdate, 'name')->textInput(['id' => 'nameUpdate'])->label('Nom:') ?>
            <?= $formUpdate->field($modelUpdate, 'surname')->textInput(['id' => 'surnameUpdate'])->label('Prénom:') ?>
            <?= $formUpdate->field($modelUpdate, 'sex')->dropDownList(['homme' => 'homme', 'femme' => 'femme'], ['id'=>'sexeUpdate', 'prompt' => '-- Choisissez un sexe --'])->label('Sexe:');?>
            <?= $formUpdate->field($modelUpdate, 'username', ['enableAjaxValidation' => true])->textInput(['id' => 'usernameUpdate'])->label("Nom d'utilisateur:") ?>
            <?= $formUpdate->field($modelUpdate, 'phoneNumber', ['enableAjaxValidation' => true])->textInput(['id' => 'phoneNumberUpdate'])->label('Numéro de téléphone:') ?>
            <?= $formUpdate->field($modelUpdate, 'email', ['enableAjaxValidation' => true])->input('email', ['id' => 'emailUpdate'])->label('Email:') ?>

            <?= $formUpdate->field($modelUpdate, 'role')->dropDownList($postesUpdate, ['prompt' => '--Choisissez un poste--', 'id' => 'roleUpdate'])->label('Poste:');?>
            
            <?= $formUpdate->field($modelUpdate, 'idUser')->hiddenInput(['id' => 'idUserUpdate'])->label(false) ?>
        </div>
        <div class="col-sm-12 modal-footer">
            <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-primary'])?>
            <?= Html::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])?>
            <div style="display: none"><?= Html::resetButton('Reset', ['class' => 'btn btn-small btn-default', 'id' => 'resetFormUpdateBtn']);?></div>
        </div>
        <?php ActiveForm::end() ?>
    <?php Modal::end();?>




    <?php
        Modal::begin([
            'id' => 'changePassModal',
            'header' => '<h4>Changer le mot de passe</h4>',
        ]);
    ?>
        <?php $formChange = ActiveForm::begin([
                    'id' => 'changePassword-form',
                    'action' => Url::to(['account/change-password']),
                    'validationUrl' => ['account/validate', 'natureModel' => 'changePass'],
                    'options' => ['class' => 'form-horizontal',
                                  'enctype' => 'multipart/form-data',
                                 ],
            ]);
        ?>

            <?= $formChange->field($modelChangePass, 'password')->passwordInput()->label('Nouveau mot de passe:') ?>
            <?= $formChange->field($modelChangePass, 'confirmPass')->passwordInput()->label('Confirmez le mot de passe:') ?>
            <?= $formChange->field($modelChangePass, 'idUser')->hiddenInput(['id' => 'idUserChangePass'])->label(false) ?>
        <div class="col-sm-12 modal-footer">
            <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-primary'])?>
            <?= Html::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])?>
            <div style="display: none"><?= Html::resetButton('Reset', ['class' => 'btn btn-small btn-default', 'id' => 'resetFormChangeBtn']);?></div>
        </div>
        <?php ActiveForm::end() ?>
    <?php Modal::end();?>