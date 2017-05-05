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

foreach (Yii::$app->session->getAllFlashes(true) as $key => $message){
    echo Growl::widget([
            'type' => $key,
            'title' => 'Reset password',
            'icon' => ($key == 'success') ? 'glyphicon glyphicon-ok-sign' : 'glyphicon glyphicon-warning-sign',
            'body' => $message,
            'showSeparator' => true,
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => 3000, //This delay is how long the message shows for
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ]
    ]);
}

$critere = $postesUpdate;
$critere['ALL'] = 'Tous';
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php Pjax::begin(['id' => 'pjax-box']);?>
            <div class="page-title">
                <h3 class="col-sm-4 text-left">List of accounts</h3>
                <h4 class="col-sm-4 text-center">Sort by: <?= Html::dropDownList('critere', 'ALL', $critere, ['id' => 'critere', 'value' => Url::to(['sort'])]); ?></h4>
                <div class="col-sm-4 text-right"><?= Html::button('Add new account', ['id' => 'createBtn', 'class' => 'btn btn-primary btn-lg']); ?></div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel" style="min-height: 74vh; width: 84%; margin-left: 8%">
                        <div class="x_content">
                            <div class="row" id="account_container">
                                <div></div>
                                <div></div>
                                <?php
                                    foreach ($accounts as $account) {
                                ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details <?= $account['role']; ?>">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief"><strong><i><?= $account['poste']; ?></i></strong></h4>
                                                <div class="left col-xs-8">
                                                    <div min-height="200px">
                                                        <h2><strong><?= $account['nom'] . ' ' . $account['prenom'] ?></strong></h2>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i><?= $account['username']; ?></i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i><?= $account['email']; ?></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-xs-4 text-center">
                                                    <img src="<?= 'uploads/' . $account['fichier']['nom']; ?>" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><?= Html::button('Edit', ['value' => Url::to(['find-account', 'id' => $account['id']]), 'class' => 'btn btn-info btn-xs updateBtn']); ?></div>
                                                    <div class="col-xs-6 text-center"><?= ($account['role'] != 'DG' && $account['id'] != $user->id)? Html::button('Delete', ['value' => Url::to(['delete', 'idAccount' => $account['id']]), 'class' => 'btn btn-danger btn-xs deleteBtn']): ''; ?></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><?= Html::button('Reset Password', ['value' => Url::to(['request-password-reset', 'idAccount' => $account['id']]), 'class' => 'btn btn-info btn-xs resetBtn', 'disabled' => 'disabled']);?></div>
                                                    <div class="col-xs-6 text-center"><?= Html::button('Edit Password', ['value' => $account['id'], 'class' => 'changePWDBtn btn btn-info btn-xs']); ?></div>
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
    </div>
</div>
<!-- /page content -->

    <?php
        Modal::begin([
            'id' => 'deleteModal',
            'header' => '<h4>Warning</h4>',
            'size' => Modal::SIZE_SMALL,
            'footer' => "<button class='btn btn-primary' id='confirmDeleteBtn' value='#'>OK</button>"
                        . "<button class='btn btn-default' data-dismiss='modal'>Annuler</button>"
        ]);
    ?>
        <div class="text-center">
            <h5>Etes-vous sûr de vouloir supprimer ce compte?</h5>
        </div>
    <?php Modal::end();?>



    <?php
        Modal::begin([
            'id' => 'createModal',
            'header' => '<h4>Create Account</h4>',
        ]);
    ?>
        <?php
        $form = ActiveForm::begin([
                                    'id' => 'createAccount-form',
                                    'action' => Url::to(['site/create']),
                                    'validationUrl' => ['site/validate', 'natureModel' => 'create'],
                                    'options' => ['class' => 'form-horizontal',
                                                  'enctype' => 'multipart/form-data']
                    ]);
        ?>

        <div class="col-sm-6">
            <?= $form->field($modelCreate, 'name')->textInput()->label('Nom:') ?>
            <?= $form->field($modelCreate, 'surname')->textInput()->label('Prénom:') ?>
            <?= $form->field($modelCreate, 'username', ['enableAjaxValidation' => true])->textInput()->label('Username:') ?>
            <?= $form->field($modelCreate, 'password')->passwordInput()->label('Password:') ?>

        </div>   
        <div class="col-sm-6">
            <?= $form->field($modelCreate, 'confirmPass')->passwordInput()->label('Confirm password:') ?>
            <?= $form->field($modelCreate, 'email', ['enableAjaxValidation' => true])->input('email')->label('Email:') ?>
            <?= $form->field($modelCreate, 'role')->dropDownList($postesCreate, ['id'=>'rolesId', 'prompt' => '--Choisissez un poste--'])->label('Poste:');?>
            <?= $form->field($modelCreate, 'photo')->fileInput()->label('Photo:'); ?>

        </div>

        <div class="col-sm-12 modal-footer">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary'])?>
            <?= Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])?>
            <div style="display: none"><?= Html::resetButton('Reset', ['class' => 'btn btn-default', 'id' => 'resetFormCreateBtn']);?></div>
        </div>
        <?php ActiveForm::end();?>
    <?php Modal::end();?>




    <?php
        Modal::begin([
            'id' => 'updateModal',
            'header' => '<h4>Edit Account</h4>',
        ]);
    ?>
        <?php
        $formUpdate = ActiveForm::begin([
                                    'id' => 'updateAccount-form',
                                    'action' => Url::to(['site/update-account']),
                                    'validationUrl' => ['site/validate', 'natureModel' => 'update'],
                                    'options' => ['class' => 'form-horizontal',
                                                  'enctype' => 'multipart/form-data'],
                                    ]);
        ?>

        <div>
            <?= $formUpdate->field($modelUpdate, 'name')->textInput(['id' => 'nameUpdate'])->label('Nom:') ?>
            <?= $formUpdate->field($modelUpdate, 'surname')->textInput(['id' => 'surnameUpdate'])->label('Prénom:') ?>

            <?= $formUpdate->field($modelUpdate, 'username', ['enableAjaxValidation' => true])->textInput(['id' => 'usernameUpdate'])->label('Username:') ?>

            <?= $formUpdate->field($modelUpdate, 'email', ['enableAjaxValidation' => true])->input('email', ['id' => 'emailUpdate'])->label('Email:') ?>

            <?= $formUpdate->field($modelUpdate, 'role')->dropDownList($postesUpdate, ['prompt' => '--Choisissez un poste--', 'id' => 'roleUpdate'])->label('Poste:');?>

            <?= $formUpdate->field($modelUpdate, 'photo')->fileinput()->label('Photo:') ?>
            
            <?= $formUpdate->field($modelUpdate, 'idUser')->hiddenInput(['id' => 'idUserUpdate'])->label(false) ?>
        </div>
        <div class="col-sm-12 modal-footer">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary'])?>
            <?= Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])?>
            <div style="display: none"><?= Html::resetButton('Reset', ['class' => 'btn btn-small btn-default', 'id' => 'resetFormUpdateBtn']);?></div>
        </div>
        <?php ActiveForm::end() ?>
    <?php Modal::end();?>




    <?php
        Modal::begin([
            'id' => 'changePassModal',
            'header' => '<h4>Change Password</h4>',
        ]);
    ?>
        <?php $formChange = ActiveForm::begin([
                    'id' => 'changePassword-form',
                    'action' => Url::to(['site/change-password']),
                    'validationUrl' => ['site/validate', 'natureModel' => 'changePass'],
                    'options' => ['class' => 'form-horizontal',
                                  'enctype' => 'multipart/form-data',
                                 ],
            ]);
        ?>

            <?= $formChange->field($modelChangePass, 'previousPass', ['enableAjaxValidation' => true])->passwordInput()->label('Previous password:') ?>
            <?= $formChange->field($modelChangePass, 'password')->passwordInput()->label('New password:') ?>
            <?= $formChange->field($modelChangePass, 'confirmPass')->passwordInput()->label('Confirm password:') ?>
            <?= $formChange->field($modelChangePass, 'idUser')->hiddenInput(['id' => 'idUserChangePass'])->label(false) ?>
        <div class="col-sm-12 modal-footer">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary'])?>
            <?= Html::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])?>
            <div style="display: none"><?= Html::resetButton('Reset', ['class' => 'btn btn-small btn-default', 'id' => 'resetFormChangeBtn']);?></div>
        </div>
        <?php ActiveForm::end() ?>
    <?php Modal::end();?>


        