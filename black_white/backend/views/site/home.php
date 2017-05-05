<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Acceuil';
?>
<div class="page-title">
    <div class='row'>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="color: #000000;">
            <h4 style="color: #0099ff; font-weight: bold;">Liste des succursales</h4>
        </div>
     </div>
</div>
<div class="row" >
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="row" >

        <?php 
            foreach ($succursales as $succursale){
        ?>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="thumbnail_cloud">
              <div class="image view view-first" style="width: 100%;  height: 80%;">
                <img style="width: 100%; height: 100%; display: block;" src="uploads/b&w_img.jpg" alt="image" />
                <div class="mask" style=" height: 250px;">
                  <p><?= 'Bienvenue au Black&White ' . $succursale->name ?></p>
                  <div class="tools tools-bottom">
                    <?= Html::a('<i class="fa fa-link"></i>', Url::to(['site/choose-db', 'name' => $succursale->name])) ?>
                  </div>
                </div>
              </div>
              <div class="caption text-center">
                  <h4><b><?= $succursale->name ?></b></h4>
              </div>
            </div>
          </div>

        <?php
            }
        ?>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="thumbnail_cloud">
        <div class="image view view-first" style="width: 100%;  height: 80%;">
          <img style="width: 100%;  height: 100%;display: block;" src="uploads/b&w_img.jpg" alt="image" />
          <div class="mask" style=" height: 250px;">
            <p>Accedez à toutes les informations</p>
            <div class="tools tools-bottom">
              <a href="#"><i class="fa fa-link"></i></a>
            </div>
          </div>
        </div>
        <div class="caption text-center">
          <h4><b>Informations générales</b></h4>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
