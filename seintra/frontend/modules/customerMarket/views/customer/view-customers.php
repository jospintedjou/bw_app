<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\User;
use kartik\date\DatePicker;

$this->title = 'Clients';
?>
<?php include 'Customer_Flash_messages.php'; ?>
<div class="right_col" role="main">
    <div class="" >
        <div class="page-title">
            <div class="title_left">
                <h2>NOS CLIENTS </h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12" >
                <div class="x_panel">
                    <div class="x_title">

                        <ul class="nav navbar-right panel_toolbox">
                            <!-- Button trigger modal -->
                            <button class="btn btn-primary" role="menuitem" tabindex="-1" data-toggle="modal" data-target="#add_client">
                                Ajouter un Client
                            </button>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- start project list -->


                        <?php if ($customer != null) { ?> 
                            <table id="datatable" class="table table-striped table-bordered" >                                                                                        
                                <thead>
                                    <tr>
                                        <th class="search">Clients</th>
                                        <th class="search">type de client</th>
                                        <th>Prise de Contact<br><br><br></th>                                     
                                        <th>EditClient<br><br><br></th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    foreach ($customer as $client) {
                                        ?>  

                                        <tr>
                                            <?php $data_target = "#edit" . $client['id_user']; ?>       
                                            <?php $appointment = "appointment" . $client['id_user']; ?>
                                            <?php $id = $client['id_user']; ?>
                                            <td>
                                                <?= $client['denomination']; ?> 
                                                <br />
                                                <small>Raison Social:<strong><?= $client['raison_sociale'] ?></strong> </small>
                                                <br />
                                            </td>

                                            <td>
                                                <?= $client['type']; ?> 
                                            </td>
                                            <td>
                                                <br />							


                                                <?php if (Yii::$app->user->identity->role != 'DEV') { ?> 
                                                    <a class="btn btn-default btn-xs " data-toggle="modal" data-target="#<?= $appointment ?>" id="add_appointment"> 
                                                        <i class="fa fa-plus-square">Add appointment</i>
                                                    </a >
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="btn btn-default btn-xs" disabled> 
                                                        <i class="fa fa-plus-square">Add appointment</i>
                                                    </a >
                                                    <?php
                                                }
                                                ?>
                                                <!-- /.modal-content-Editer-PriseDeContact -->
                                                <div class="modal fade" id="<?= $appointment ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                                                                    &times;
                                                                </button>
                                                                <h4 class="modal-title" align="center">
                                                                    Nouvelle Prise De Contact
                                                                </h4>
                                                            </div> 

                                                            <?php $model_appointment->id_client = $id ?>
                                                            <?php $form = ActiveForm::begin(['action' => Url::toRoute(['customer/add-appointment']), 'method' => 'post']) ?>
                                                            <div class="modal-body">

                                                                <div style="display: none">
                                                                    <?= $form->field($model_appointment, 'id_client')->textInput() ?> 
                                                                </div>
                                                                <?= $form->field($model_appointment, 'motif')->textInput() ?> 
                                                                <?=
                                                                $form->field($model_appointment, 'date')->widget(DatePicker::classname(), [
                                                                    'options' => ['placeholder' => 'veuillez entrer la date de prise de contact', 'id' => $id],
                                                                    'pluginOptions' => [
                                                                        'format' => 'yyyy-mm-dd',
                                                                        'endDate' => '0d',
                                                                        'autoclose' => true
                                                                    ]
                                                                ]);
                                                                ?>
                                                                <?= $form->field($model_appointment, 'debouche')->textInput() ?>
                                                                <?= $form->field($model_appointment, 'moyen')->dropDownList(['appel' => 'appel telephonique', 'rencontre' => 'rencontre', 'email' => 'email']) ?>
                                                                <?=
                                                                $form->field($model_appointment, 'commercial_id')->dropDownList(
                                                                        ArrayHelper::map($commercials, 'id', function($model, $defaultvalue) {
                                                                            return $model['nom'] . ' ' . $model['prenom'];
                                                                        })
                                                                )
                                                                ?>                                                     
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
                                                </div><!-- /.modal-content-Editer-PriseDeContact -->
                                            </td>                                        
                                            <td>

                                                <br />
                                                <?php $form = ActiveForm::begin(['action' => Url::toRoute(['customer/view-details', 'id' => $id, 'type' => $client['type']]), 'method' => 'post']) ?>
                                                <?= Html::submitButton('View', ['class' => 'btn btn-primary btn-xs glyphicon glyphicon-eye-open']) ?>

                                                <?php if ((Yii::$app->user->identity->role != 'DEV')) { ?> 
                                                    <a class="btn btn-info btn-xs " data-toggle="modal" data-target= <?= $data_target ?>> 
                                                        <i class="fa fa-pencil">Edit </i> 
                                                    </a> 
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="btn btn-info btn-xs " disabled> 
                                                        <i class="fa fa-pencil">Edit </i>
                                                    </a >
                                                    <?php
                                                }
                                                ?>
                                                <?php ActiveForm::end(); ?>

                                                <div class="modal fade" id="<?= "edit" . $id ?>" tabindex= "-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                                                                    &times;
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel" align="center">
                                                                    Client <?= $client['denomination'] ?> <?= $client['raison_sociale'] ?>
                                                                </h4>
                                                            </div>
                                                            <?php
                                                            $model_empty->denomination = $client['denomination'];
                                                            $model_empty->raison_sociale = $client['raison_sociale'];
                                                            $model_empty->email = $client['email'];
                                                            $model_empty->type = $client['type'];
                                                            $model_empty->localisation = $client['localisation'];
                                                            $model_empty->telephone = $client['telephone'];
                                                            $model_empty->boite_postale = $client['boite_postale'];
                                                            $model_empty->adresse_web = $client['adresse_web'];
                                                            $model_empty->personne_source = $client['personne_source'];
                                                            $model_empty->telephone_source = $client['telephone_source'];
                                                            $model_empty->id_user = $client['id_user'];
                                                            ?>

                                                            <?php $form = ActiveForm::begin(['action' => Url::toRoute(['customer/update']), 'method' => 'post']) ?> 
                                                            <div class="modal-body col-md-12">
                                                                <div class="col-lg-6">
                                                                    <?= $form->field($model_empty, 'denomination')->textInput() ?>
                                                                    <?=
                                                                    $form->field($model_empty, 'raison_sociale')->dropDownList(
                                                                            ['Aucune' => 'Aucune',
                                                                                'SARL' => 'S.A.R.L',
                                                                                'Ets' => 'ETS',
                                                                                'SA' => 'S.A',
                                                                                '&Co.' => '&Co.',
                                                                                'Co.' => 'Co.',
                                                                                'Corp.' => 'Corp.',
                                                                                'Inc.' => 'Inc.',
                                                                                'SENC' => 'SENC',
                                                                                'SEC' => 'SEC',
                                                                    ])
                                                                    ?>
                                                                    <?= $form->field($model_empty, 'email')->textInput() ?>                                                   
                                                                    <?= $form->field($model_empty, 'type')->dropDownList(['prive' => 'prive', 'public' => 'public']) ?>
                                                                    <?= $form->field($model_empty, 'localisation')->textarea() ?>

                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <?= $form->field($model_empty, 'telephone')->textInput() ?>
                                                                    <?= $form->field($model_empty, 'boite_postale')->textInput() ?>
                                                                    <?= $form->field($model_empty, 'adresse_web')->textInput() ?>                   
                                                                    <?= $form->field($model_empty, 'personne_source')->textInput() ?>
                                                                    <?= $form->field($model_empty, 'telephone_source')->textInput() ?>

                                                                </div>
                                                                <div style="display:none"> 
                                                                    <?= $form->field($model_empty, 'id_user') ?>
                                                                </div>
                                                            </div> <!-- modal body -->
                                                            <div class="modal-footer">

                                                                <?= Html::submitButton('Mettre à jour', ['class' => 'btn btn-primary']) ?>  
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
                                                </div><!-- /.modal -->
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } else {
                            ?>    
                            <div align="center">
                                <div class="label label-info"  style="font-size: 100%">AUCUN CLIENT A AFFICHER.</div>
                            </div>
                        <?php }
                        ?>

                        <!-- end project list -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'create_form_customer.php'; ?>
