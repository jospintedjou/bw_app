<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\widgets\Select2;
?>
<!-- /page content -->
<!-- Modal add customer -->
<div class="modal fade" id="add_client" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel" align="center">
                    Nouveau Client
                </h4>
            </div>
            <?php
            $raisons_sociales = ['Aucune' => 'Aucune',
                'SARL' => 'S.A.R.L',
                'Ets' => 'ETS',
                'SA' => 'S.A',
                '&Co.' => '&Co.',
                'Co.' => 'Co.',
                'Corp.' => 'Corp.',
                'Inc.' => 'Inc.',
                'SENC' => 'SENC',
                'SEC' => 'SEC',
            ];
            $form = ActiveForm::begin(['action' => Url::toRoute('customer/create')]);
            ?>
            <div class="modal-body col-md-12">
                <div class="col-lg-6">
                    <?= $form->field($model, 'denomination')->textInput() ?>
                    <?=$form->field($model, 'raison_sociale')->dropDownList($raisons_sociales)?>
                    <?= $form->field($model, 'email')->textInput() ?>                                                   
                    <?=
                    $form->field($model, 'type')->dropDownList(['prive' => 'prive', 'public' => 'public'])
                    ?>
                    <?= $form->field($model, 'localisation')->textarea() ?>

                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'telephone')->textInput() ?>
                    <?= $form->field($model, 'boite_postale')->textInput() ?>
                    <?= $form->field($model, 'adresse_web')->textInput() ?>                   
                    <?= $form->field($model, 'personne_source')->textInput() ?>
                    <?= $form->field($model, 'telephone_source')->textInput() ?>
                </div>
            </div> <!-- modal body -->
            <div class="modal-footer">
                <?= Html::submitButton('Ajouter', ['class' => 'btn btn-primary']) ?>  
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <div style="display: none">
                    <?= Html::resetButton('Reset', ['class' => 'resetForm', 'id' => 'resetForm']) ?> 
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal dialog -->
</div><!-- /.modal add customer -->

<?php $this->registerCssFile('css/libs/jquery-ui.css') ?>
<?php $this->registerCssFile('css/libs/dataTables.jqueryui.min.css') ?>
<?php $this->registerCssFile('css/CustomerMarketAppointmentPurch.css') ?>

<?php $this->registerJsFile('js/libs/jquery.dataTables.min.js') ?>
<?php $this->registerJsFile('js/libs/dataTables.keyTable.min.js') ?>
<?php $this->registerJsFile('js/libs/dataTables.jqueryui.min.js') ?>
<?php $this->registerJsFile('js/CustomerMarketAppointment.js') ?>

