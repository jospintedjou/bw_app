<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use budyaga\cropper\Widget;
use yii\widgets\Pjax;
use kartik\growl\GrowlAsset;

$this->title = 'Profil';
$this->registerCssFile('css/style.css');
$this->registerJsFile('js/libs/bootstrap-progressbar.js');
$this->registerJsFile('js/libs/bootstrap-progressbar.min.js');
GrowlAsset::register($this);
?>

<!-- page content -->
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Profil utilisateur:</h3>
    </div>
  </div>

  <div class="clearfix"></div>
  <?php Pjax::begin(['id' => 'pjax-zone']);?>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">

          <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

            <div class="profile_img">

              <!-- end of image cropping -->
              <div id="crop-avatar">
                <!-- Current avatar -->
                <img class="img-responsive avatar-view" src="<?= 'uploads/' . $usr['nom_photo']; ?>" alt="Avatar">    

                <!-- Loading state -->
                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
              </div>
              <!-- end of image cropping -->

            </div>
            <h3><?= $usr['nom'] . ' ' . $usr['prenom']; ?></h3>

            <ul class="list-unstyled user_data">
              <li>
                <i class="<?= ($usr['sexe'] == 'homme')? 'fa fa-male': 'fa fa-female' ?> user-profile-icon"></i>: <?= $usr['sexe']; ?>
              </li>
              <li>
                <i class="fa fa-briefcase user-profile-icon"></i>: <?= $usr['poste']; ?>
              </li>
              <li>
                <i class="fa fa-id-card user-profile-icon"></i>: <?= $usr['code']; ?>
              </li>
              <li>
                <i class="fa fa-user user-profile-icon"></i>: <?= $usr['username']; ?>
              </li>
              <li>
                <i class="fa fa-envelope user-profile-icon"></i>: <?= $usr['email']; ?>
              </li>
              <li>
                <i class="fa fa-phone user-profile-icon"></i>: <?= $usr['telephone']; ?>
              </li>
            </ul>
            <div class="col-xs-12">
                <?= Html::button('Changer photo', ['class' => 'btn btn-primary btn-xs', 'data-toggle' => 'modal', 'data-target' => '#changePhotoModal']); ?>
                <?= Html::button('Changer code', ['class' => 'btn btn-primary btn-xs']); ?>
            </div>
            <br />

            

          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">

            <div class="profile_title">
              <div class="col-md-6">
                <h2>User Activity Report</h2>
              </div>
              <div class="col-md-6">
                <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                </div>
              </div>
            </div>
            <!-- start of user-activity-graph -->
            <div id="graph_bar" style="width:100%; height:280px;"></div>
            <!-- end of user-activity-graph -->

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php Pjax::end();?>
</div>
<!-- /page content -->
<?php
    Modal::begin([
        'id' => 'changePhotoModal',
        'header' => '<h4>Changement de photo de profil</h4>',
    ]);
?>
    <?php
    $form = ActiveForm::begin([
                                'id' => 'changePhoto-form',
                                'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']
                ]);
    ?>
    <?= $form->field($model, 'idUser')->hiddenInput(['id' => 'idUserChangePhoto', 'value' => $usr['id']])->label(false) ?>
    <?= $form->field($model, 'photo')->widget(Widget::className(), ['uploadUrl' => Url::toRoute('account/upload')]) ?>
    <div class="form-group modal-footer">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'display: none;']) ?>
        <?= Html::button('Changer', ['class' => 'btn btn-primary', 'id' => 'changePhotoBtn', 'value' => Url::to(['account/save-photo'])])?>
        <?= Html::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default', 'id' => 'resetFormChangePhotoBtn', 'style' => 'display: none;']);?>
    </div>
    <?php ActiveForm::end();?>
<?php Modal::end();?>