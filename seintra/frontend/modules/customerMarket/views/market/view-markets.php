<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\Client;
use kartik\date\DatePicker;

$this->title = 'Marches';
?>
<?php include 'Market_Flash_messages.php'; ?>

<!-- page content -->
<?php include 'view_market_header.php'; ?>
<ul class="nav nav-tabs">
    <li class="active" style="background-color:#EDEDED;border-radius: 200px"><a href="#marcheprive" data-toggle="tab">MARCHES PRIVES</a></li>
    <li style="background-color:#EDEDED;border-radius: 200px"><a href="#marchepublic" data-toggle="tab">MARCHES PUBLICS</a></li>
</ul>
<div class="tab-content clearfix">
    <div class="tab-pane active" id="marcheprive">
        <div class="x_content">
            <!-- start Markets  list -->

            <?php if ($privatemarkets != null) { ?> 
                <table id="" class="table table-striped table-bordered " >
                    <thead>
                        <tr>
                            <th class="search">Marches Prives</th>                                                                
                            <th class="search">Clients</th>                                         
                            <th class="search">Etat</th>                    
                            <th>Edit<br><br><br></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($privatemarkets as $privatmarket) {
                            ?>   
                            <tr>
                                <?php $id_private_market = "private" . $privatmarket['id_marche']; ?>
                                <?php $target_id_private_market = "#" . $id_private_market; ?>
                                <?php $id = $privatmarket['id_marche']; ?>
                                <?php $data_target = "#" . $id; ?>
                                <td>
                                    <a>Intitulé: <?= $privatmarket['intitule']; ?> </a>

                                </td>
                                <td>
                                    <?= $privatmarket->findnameprivatecustomer($privatmarket['id_client']); ?> 
                                </td>
                                <td>
                                    <?= $privatmarket['etat']; ?>
                                </td>

                                <td>
                                    <a  class="btn btn-primary btn-xs" data-toggle="modal" data-target="<?= $target_id_private_market ?>">
                                        <i class="glyphicon glyphicon-eye-open"></i>View</a>

                                    <div class="modal fade" id="<?= $id_private_market ?>" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width:120%">
                                                <div class="modal-header">
                                                    <button type="button" class="close " data-dismiss="modal" aria-hidden="true">
                                                        &times;
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel">
                                                        Marche Prive <strong><?= $privatmarket['intitule']; ?></strong>
                                                    </h4>
                                                </div>                                                                                                                                      
                                                <div class="modal-body">
                                                    <div class='row' style="margin-left:2px;margin-right:2px;color: #0d3349 ">
                                                        <div>
                                                            <div class="row " style="">
                                                                <div class="col-lg-4 view_marche_even "><br>intitulé marche:<br> </div> 
                                                                <div class="col-lg-8 view_marche_even"><br><strong> <?= $privatmarket['intitule']; ?></strong><br></div>
                                                            </div>
                                                            <div class="row" style="border: ">
                                                                <div class="col-lg-4 view_marche_odd "><br>Nom du client:<br></div> 
                                                                <div class="col-lg-8 view_marche_odd"><br><strong> <?= $privatmarket->findnameprivatecustomer($privatmarket['id_client']); ?></strong><br></div>
                                                            </div>
                                                            <div class="row " style="">
                                                                <div class="col-lg-4 view_marche_even"><br>date de demande de cotation:<br></div>
                                                                <div class="col-lg-8 view_marche_even">
                                                                   <br> <strong> 
                                                                        <?php if (($privatmarket['date_dmd_cotation']) != null) { ?>
                                                                            <?= $privatmarket['date_dmd_cotation']; ?>
                                                                        <?php } else { ?>

                                                                        <?php }
                                                                        ?>  
                                                                    </strong><br>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4 view_marche_odd"><br>date de depot de cotation:<br></div>
                                                                <div class="col-lg-8 view_marche_odd">
                                                                    <br><strong>
                                                                        <?php if (($privatmarket['date_depot_cotation']) != null) { ?>
                                                                            <?= $privatmarket['date_depot_cotation']; ?>
                                                                        <?php } else { ?>

                                                                        <?php }
                                                                        ?>
                                                                    </strong><br>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col-lg-4 view_marche_even"><br>date reponse client:<br></div>
                                                                <div class="col-lg-8 view_marche_even">
                                                                    <br><strong>
                                                                        <?php if (($privatmarket['date_reponse']) != null) { ?>
                                                                            <?= $privatmarket['date_reponse']; ?>
                                                                        <?php } else { ?>
                                                                        <?php }
                                                                        ?>  
                                                                    </strong><br>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="">
                                                                <div class="col-lg-4 view_marche_odd"><br>Etat marche:<br></div>
                                                                <div class="col-lg-8 view_marche_odd">
                                                                    <br><strong>
                                                                        <?= $privatmarket['etat']; ?>                                                    
                                                                    </strong><br>
                                                                </div>   
                                                            </div>                               
                                                        </div> 
                                                    </div>
                                                </div>
                                                <!-- /.modal-body  view-->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div> <!-- /.modal content view -->
                                        </div> <!-- /.modal dialog view-->
                                    </div>
                                     <?php if (Yii::$app->user->identity->role != 'DEV') { ?>
                                        <a class="btn btn-info btn-xs " data-toggle="modal" data-target= <?= $data_target ?>> 
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
                                    <div class="modal fade miguel" id="<?= $id ?>"tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                                                        &times;
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                                                        Marche Prive
                                                    </h4>
                                                </div>
                                                <?php
                                                $privatemarket->intitule = $privatmarket['intitule'];
                                                $privatemarket->etat = $privatmarket['etat'];
                                                $privatemarket->date_dmd_cotation = $privatmarket['date_dmd_cotation'];
                                                $privatemarket->date_depot_cotation = $privatmarket['date_depot_cotation'];
                                                $privatemarket->date_reponse = $privatmarket['date_reponse'];
                                                $privatemarket->client = $privatmarket['id_client'];
                                                $privatemarket->id_marche = $privatmarket['id_marche'];
                                                ?>
                                                <?php $form = ActiveForm::begin(['action' => Url::toRoute(['market/update-private-market']), 'method' => 'post']) ?> 

                                                <div class="modal-body">			  

                                                    <?= $form->field($privatemarket, 'intitule')->textInput() ?>                  
                                                    <?=
                                                    $form->field($privatemarket, 'client')->dropDownList(
                                                            ArrayHelper::map(Client::find()->where(['type' => 'prive'])->all(), 'id_user', function($model, $defaultvalue) {
                                                                return $model['denomination'] . ' ' . $model['raison_sociale'];
                                                            }
                                                            )
                                                    )
                                                    ?>
                                                    <?=
                                                    $form->field($privatemarket, 'date_dmd_cotation')->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => 'veuillez entrer la date de demande de cotation', 'id' => $id . 'date_dmd_cotation'],
                                                        'pluginOptions' => [
                                                            'format' => 'yyyy-mm-dd',
                                                            'endDate' => '0d',
                                                            'autoclose' => true
                                                        ]
                                                    ]);
                                                    ?>                                                 
                                                    <?=
                                                    $form->field($privatemarket, 'date_depot_cotation')->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => 'veuillez entrer la date de depot de cotation', 'id' => $id . 'date_depot_cotation'],
                                                        'pluginOptions' => [
                                                            'format' => 'yyyy-mm-dd',                                                            
                                                            'autoclose' => true
                                                        ]
                                                    ]);
                                                    ?> 
                                                    <?=
                                                    $form->field($privatemarket, 'date_reponse')->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => 'veuillez entrer la date de reponse', 'id' => $id . 'date_reponse'],
                                                        'pluginOptions' => [
                                                            'format' => 'yyyy-mm-dd',
                                                            'startDate' => '0d',
                                                            'autoclose' => true
                                                        ]
                                                    ]);
                                                    ?> 
                                                    <?= $form->field($privatemarket, 'etat')->dropDownList(['en_attente' => 'en attente', 'gagne' => 'gagne', 'perdu' => 'perdu']) ?>

                                                    <div style="display:none"> 
                                                        <?= $form->field($privatemarket, 'id_marche') ?>
                                                    </div>
                                                </div>
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
                    <div class="label label-info"  style="font-size: 100%">AUCUN MARCHE PRIVE A AFFICHER</div>
                </div>
                <?php
            }
            ?>                                
        </div>
    </div>
    <div class="tab-pane " id="marchepublic">
        <div class="x_content">

            <!-- start PUBLICS Markets  list -->

            <?php if ($publicmarkets != null) { ?> 
                <table id="" class="table table-striped table-bordered" style="width: 100%" >
                    <thead>
                        <tr>
                            <th class="search">Marches Publics</th>                                                                
                            <th class="search">Clients</th>                                         
                            <th class="search">Etat</th>
                            <th>Edit<br><br><br></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($publicmarkets as $public_market) {
                            ?>   
                            <tr>
                                <?php $id_public_market = "public" . $public_market['id_marche']; ?>
                                <?php $data_target_view_public = "#" . $id_public_market; ?>
                                <?php $id_public = $public_market['id_marche']; ?>
                                <?php $data_target_edit_public = "#" . $id_public; ?>
                                <td>
                                    <a>Intitulé: <?= $public_market['intitule']; ?> </a>                           
                                </td>

                                <td>
                                    <?= $public_market->findnamepubliccustomer($public_market['id_client']); ?> 
                                </td>
                                <td>
                                    <?= $public_market['etat']; ?>
                                </td>
                                <td>
                                    <a  class="btn btn-primary btn-xs" data-toggle="modal" data-target="<?= $data_target_view_public ?>">
                                        <i class="glyphicon glyphicon-eye-open"></i> View </a>

                                    <div class="modal fade miguel" id="<?= $id_public_market ?>" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true" >
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width: 120%">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                        &times;
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel">
                                                        Marche Public <strong><?= $public_market['intitule']; ?></strong>
                                                    </h4>
                                                </div>                                                                   
                                                <div class="modal-body">


                                                    <div class='row' style="margin-left:2px;margin-right:2px;color: #0d3349">
                                                        <div>
                                                            <div class="row ">
                                                                <div class="col-lg-4 view_marche_even "><br> intitulé marche:<br> </div> 
                                                                <div class="col-lg-8 view_marche_even"><br><strong><?= $public_market['intitule']; ?></strong><br></div>
                                                            </div>
                                                            <div class="row" style="border: ">
                                                                <div class="col-lg-4 view_marche_odd "><br>Nom du client:<br></div> 
                                                                <div class="col-lg-8 view_marche_odd"><br><strong><?= $public_market->findnamepubliccustomer($public_market['id_client']); ?></strong><br></div>
                                                            </div>
                                                            <div class="row " style="">
                                                                <div class="col-lg-4 view_marche_even"><br>date de connaissance marche:<br></div>
                                                                <div class="col-lg-8 view_marche_even">
                                                                    <br><strong> 
                                                                        <?php if (( $public_market['date_connaiss']) != null) { ?>
                                                                            <?= $public_market['date_connaiss']; ?>
                                                                        <?php } else { ?>
                                                                            
                                                                        <?php }
                                                                        ?> 
                                                                    </strong><br>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col-lg-4 view_marche_odd"><br>delai de prescription:<br></div>
                                                                <div class="col-lg-8 view_marche_odd">
                                                                    <br><strong>
                                                                        <?php if (($public_market['date_prescript']) != null) { ?>
                                                                            <?= $public_market['date_prescript']; ?>
                                                                        <?php } else { ?>
                                                                           
                                                                        <?php }
                                                                        ?>   
                                                                    </strong><br>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4 view_marche_even"><br>date d'introduction du dossier:<br></div>
                                                                <div class="col-lg-8 view_marche_even">
                                                                    <br><strong>

                                                                        <?php if (( $public_market['date_depot_dossier']) != null) { ?>
                                                                            <?= $public_market['date_depot_dossier']; ?>
                                                                        <?php } else { ?>
                                                                           
                                                                        <?php }
                                                                        ?>     
                                                                    </strong><br>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col-lg-4 view_marche_odd"><br>date reponse client:<br></div>
                                                                <div class="col-lg-8 view_marche_odd">
                                                                    <br><strong>
                                                                        <?php if (($public_market['date_reponse']) != null) { ?>
                                                                            <?= $public_market['date_reponse']; ?>
                                                                        <?php } else { ?>
                                                                           
                                                                        <?php }
                                                                        ?>
                                                                    </strong><br>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4 view_marche_even"><br>Etat marche:<br></div>
                                                                <div class="col-lg-8 view_marche_even">
                                                                    <br><strong>
                                                                        <?= $public_market['etat']; ?>                                                    
                                                                    </strong><br>
                                                                </div>   
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div> 
                                                <!-- /.modal-body  view-->

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>

                                                </div>

                                            </div> <!-- /.modal content view -->
                                        </div> <!-- /.modal dialog view-->
                                    </div>
                                    <?php if (Yii::$app->user->identity->role != 'DEV') { ?>
                                        <a class="btn btn-info btn-xs " data-toggle="modal" data-target= <?= $data_target_edit_public . 'public' ?>> 
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
                                    <div class="modal fade miguel" id="<?= $id_public . 'public' ?>"tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                                                        &times;
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                                                        Marche Public
                                                    </h4>
                                                </div>

                                                <?php
                                                $publicmarket->intitule = $public_market['intitule'];
                                                $publicmarket->etat = $public_market['etat'];


                                                $publicmarket->date_depot_dossier = $public_market['date_depot_dossier'];



                                                $publicmarket->delai_prescript = $public_market['date_prescript'];



                                                $publicmarket->date_connaiss = $public_market['date_connaiss'];


                                                $publicmarket->date_reponse = $public_market['date_reponse'];


                                                $publicmarket->date_reponse = $public_market['date_reponse'];


                                                $publicmarket->client = $public_market['id_client'];

                                                $publicmarket->id_marche = $public_market['id_marche'];
                                                ?>

                                                <?php
                                                $form = ActiveForm::begin(['action' => Url::toRoute(['market/update-public-market']), 'method' => 'post'])
                                                ?> 

                                                <div class="modal-body">			  
                                                    <?= $form->field($publicmarket, 'intitule')->textInput() ?>                  
                                                    <?=
                                                    $form->field($publicmarket, 'client')->dropDownList(
                                                            ArrayHelper::map(Client::find()->where(['type' => 'public'])->all(), 'id_user', function($model, $defaultvalue) {
                                                                return $model['denomination'] . ' ' . $model['raison_sociale'];
                                                            }
                                                            )
                                                    )
                                                    ?>
                                                    <?=
                                                    $form->field($publicmarket, 'date_connaiss')->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => 'veuillez entrer la date de connaissance du marche', 'id' => $id_public . 'date_connaiss'],
                                                        'pluginOptions' => [
                                                            'format' => 'yyyy-mm-dd',
                                                            'endDate' => '0d',
                                                            'autoclose' => true
                                                        ]
                                                    ]);
                                                    ?>                                                 
                                                    <?=
                                                    $form->field($publicmarket, 'date_depot_dossier')->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => 'veuillez entrer la date de depot du dossier', 'id' => $id_public . 'date_depot_dossier'],
                                                        'pluginOptions' => [
                                                            'format' => 'yyyy-mm-dd',                                                            
                                                            'autoclose' => true
                                                        ]
                                                    ]);
                                                    ?> 
                                                    <?=
                                                    $form->field($publicmarket, 'delai_prescript')->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => 'veuillez entrer la date de delai de prescription', 'id' => $id_public . 'delai_prescript'],
                                                        'pluginOptions' => [
                                                            'format' => 'yyyy-mm-dd',
                                                            'endDate' => '0d',
                                                            'autoclose' => true
                                                        ]
                                                    ]);
                                                    ?> 
                                                    <?=
                                                    $form->field($publicmarket, 'date_reponse')->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => 'veuillez entrer la date de reponse', 'id' => $id_public . 'date_reponse0'],
                                                        'pluginOptions' => [
                                                            'format' => 'yyyy-mm-dd',
                                                            'startDate' => '0d',
                                                            'autoclose' => true
                                                        ]
                                                    ]);
                                                    ?> 
                                                    <?= $form->field($publicmarket, 'etat', ['inputOptions' => ['id' => 'etat_public']])->dropDownList(['en_attente' => 'en attente', 'gagne' => 'gagne', 'perdu' => 'perdu']) ?>

                                                    <div style="display:none">
                                                        <?= $form->field($publicmarket, 'id_marche') ?>
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
                    <div class="label label-info"  style="font-size: 100%">AUCUN MARCHE PUBLIC A AFFICHER</div>
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
</div>
</div>
</div>
<!-- /page content -->
<?php include 'form_to_add_markets.php'; ?>
<?php
$this->registerCss('.view_marche_even'
        . '{'
        . 'background-color:#f9f9f9;'
        . 'border: 2px solid #ddd;'
        .'border-top:none;'
        . '}'
);
$this->registerCss('.view_marche_odd'
        . '{'
        . 'border: 2px solid #ddd;'
        . 'border-top:none;'
        . '};'
        
        
);
?>