<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\Client;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use frontend\assets\AppAsset;
use kartik\widgets\Select2;

AppAsset::register($this);
?>
<!-- /page content -->
<!-- Modal add customer -->
<div class="modal fade" id="add_bon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel" align="center">
                    Nouveau Bon De Commande
                </h4>
            </div>
            <div class="modal-body">
                <?php 
                $clients = ArrayHelper::map(Client::find()->orderBy(['denomination'=>SORT_DESC])->all(), 'id_user', function($model, $defaultvalue) {
																				if( $model['raison_sociale']=='Aucune'){
																						return $model['denomination'] ;
																					}
																					else
																					{
																						return $model['denomination'] . ' ' . $model['raison_sociale'];
                                                                        }
																		
																		}
                                                                );
                $form = ActiveForm::begin(['action' => Url::toRoute('purchase-order/create')]); ?>

                <?=
                                                                $form->field($purchaseorder, 'id_client')->widget(Select2::className(), [

                                                                    'hideSearch' => true,
                                                                    'data' => $clients,
                                                                    'theme' => Select2::THEME_BOOTSTRAP,
                                                                    'options' => ['placeholder' => 'Select client ...'],
                                                                    'pluginOptions' => [
                                                                        'allowClear' => true
                                                                    ],
                                                                ]);                                            
                                                                ?>
                <?= $form->field($purchaseorder_create, 'produit')->textInput() ?>
                <?=
                $form->field($purchaseorder_create, 'date_reception')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'veuillez entrer la date de demande de cotation'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'endDate' => '0d',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true
                    ]
                ]);
                ?>        
                <?=
                $form->field($purchaseorder_create, 'delai')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'veuillez entrer la date de demande de cotation'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'startDate' => '0d',
                        'autoclose' => true
                    ]
                ]);
                ?>        
                <?= $form->field($purchaseorder_create, 'montant')->textInput() ?>                                                   

            </div> <!-- modal body -->
            <div class="modal-footer">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>  
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

<?php
$this->registercss(" thead .search input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }"
)
?>

