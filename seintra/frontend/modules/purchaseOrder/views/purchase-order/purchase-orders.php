<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\Client;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;

$this->title = 'Bons De Commande';
?>
<?php include 'purchase_order_Flash_messages.php' ?>
<div class="right_col" role="main">                  
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Nos Bons De Commande </h3>
            </div>      
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">                           
                            <ul class="nav navbar-right panel_toolbox">
                                <!-- Button trigger modal -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#add_bon">
                                    Créer un Bon de Commande
                                </button>
                            </ul>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- start purchaseorders  list -->

                        <?php if ($purchaseorders != null) { ?> 
                            <table id="table" class="table table-striped table-bordered table-responsive" >
                                <thead>
                                    <tr>
                                        <th class="search">Nom Du Client</th>                                                                
                                        <th class="search">Produit / Service</th>                                         
                                        <th class="search">Date de Réception</th>                                         
                                        <th class="search">Délai</th>
                                        <th class="search">Montant</th>
                                        <th>Edit<br><br><br></th>
                                    </tr>
                                </thead>                            
                                <tbody>
                                    <?php
                                    foreach ($purchaseorders as $purchase_order) {
                                        ?>   
                                        <tr>
                                            <?php $id_purchase_order = $purchase_order['id_bon']; ?>
                                            <?php $data_target_purchase_order = "#" . $id_purchase_order; ?>           
                                            <td>
                                                <a><?= $purchase_order->findnamecustomer($purchase_order['id_client']); ?> </a>                                                 
                                            </td>

                                            <td>
                                                <?= $purchase_order['produit']; ?>
                                            </td>
                                            <td>
                                                <?= $purchase_order['date_reception']; ?>
                                            </td>
                                            <td>
                                                <?= $purchase_order['delai']; ?>
                                            </td>
                                            <td>
                                                <?= $purchase_order['montant']; ?>
                                            </td>

                                            <td>
                                                <?php if (Yii::$app->user->identity->role != 'DEV') { ?>
                                                    <a class="btn btn-info btn-xs " data-toggle="modal" data-target= <?= $data_target_purchase_order ?>> 
                                                        <i class="fa fa-pencil">Edit </i>
                                                    </a >
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="btn btn-info btn-xs " disabled> 
                                                        <i class="fa fa-pencil">Edit </i>
                                                    </a >
                                                    <?php
                                                }
                                                ?>
                                                <div class="modal fade" id="<?= $id_purchase_order ?>"tabindex="-1" role="dialog"
                                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                                                                    &times;
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                                                                    Bon De Commande 
                                                                </h4>
                                                            </div>

                                                            <?php
                                                            $purchaseorder->id_client = $purchase_order['id_client'];
                                                            $purchaseorder->produit = $purchase_order['produit'];
                                                            $purchaseorder->delai = $purchase_order['delai'];
                                                            $purchaseorder->montant = $purchase_order['montant'];
                                                            $purchaseorder->date_reception = $purchase_order['date_reception'];
                                                            $purchaseorder->id_bon = $purchase_order['id_bon'];
                                                            ?>                                                   

                                                            <div class="modal-body">			  

                                                                <?php
                                                                $clients = ArrayHelper::map(Client::find()->all(), 'id_user', function($model, $defaultvalue) {
                                                                            if( $model['raison_sociale']=='Aucune'){
																						return $model['denomination'] ;
																					}
																					else
																					{
																						return $model['denomination'] . ' ' . $model['raison_sociale'];
                                                                        }
                                                                        }
                                                                );
                                                                $form = ActiveForm::begin(['action' => Url::toRoute('purchase-order/update')]);
                                                                ?>

                                                                <?=
                                                                $form->field($purchaseorder, 'id_client')->widget(Select2::className(), [

                                                                    'hideSearch' => true,
                                                                    'data' => $clients,
                                                                    'theme' => Select2::THEME_BOOTSTRAP,
                                                                    'options' => ['placeholder' => 'Select client ...', 'id' => $id_purchase_order  . 'edit_client'],
                                                                    'pluginOptions' => [
                                                                        'allowClear' => true
                                                                    ],
                                                                ]);                                            
                                                                ?>
                                                                <?= $form->field($purchaseorder, 'produit')->textInput() ?>
                                                                <?=
                                                                $form->field($purchaseorder, 'date_reception')->widget(DatePicker::classname(), [
                                                                    'options' => ['placeholder' => 'veuillez entrer la date de demande de cotation', 'id' => '0' . $id_purchase_order],
                                                                    'pluginOptions' => [
                                                                        'format' => 'yyyy-mm-dd',
                                                                        'endDate' => '0d',
                                                                        'autoclose' => true
                                                                    ]
                                                                ]);
                                                                ?>        
                                                                <?=
                                                                $form->field($purchaseorder, 'delai')->widget(DatePicker::classname(), [
                                                                    'options' => ['placeholder' => 'veuillez entrer la date de demande de cotation', 'id' => '1' . $id_purchase_order],
                                                                    'pluginOptions' => [
                                                                        'format' => 'yyyy-mm-dd',
                                                                        'startDate' => '0d',
                                                                        'autoclose' => true
                                                                    ]
                                                                ]);
                                                                ?>        
                                                                    <?= $form->field($purchaseorder, 'montant')->textInput() ?> 
                                                                <div style="display: none">
        <?= $form->field($purchaseorder, 'id_bon')->textInput() ?>                                                   
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <?=
                                                                Html::submitButton('Mettre à jour', ['class' => 'btn btn-primary',
                                                                ])
                                                                ?>  
                                                                <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
                                                                    Close
                                                                </button> 
                                                                <div style="display: none">
                                                                <?= Html::resetButton('Reset', ['class' => 'resetForm', 'id' => 'resetForm']) ?> 
                                                                </div>
        <?php ActiveForm::end(); ?>
                                                            </div><!-- /.modal content -->
                                                        </div><!-- /.modal dialog-->
                                                    </div>
                                            </td>
                                        </tr>

    <?php }
    ?>
                                </tbody>
                            </table>
<?php } else {
    ?>
                            <div align="center">
                                <div class="label label-info"  style="font-size: 100%">AUCUN BON DE COMMANDE A AFFICHER</div>
                            </div>
                            <?php
                        }
                        ?>                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'create_forrm_purchaseorder.php' ?>