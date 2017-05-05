<?php

use yii\grid\GridView;
use yii\web\JsExpression;
use yii\helpers\html;
use yii\bootstrap\Modal;
//use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\sortable\Sortable;
use kartik\detail\DetailView;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii2fullcalendar\Yii2fullcalendar;
use kartik\growl\GrowlAsset;
// version mise a jours 21/09/2016
$this->title = 'Reunions';
$this->registerCss('  .table-striped > tbody > tr:nth-child(2n+1)   {
   background-color: #f9f9f9;
}     ');
$this->registerCss('  .table-striped > tbody > tr:nth-child(2n)   {
   background-color: #fff;
}     ');
GrowlAsset::register($this);

$js2 ='
   function(calEvent, jsEvent, view) {
       var td_datagrid = $("#detailviews" ).find("td");
       var optDevs = "", devs="", optParts = "", opt = "";
       var id = calEvent.id;
       var count = 0;
       var count_part = 0;
       var boucle = -1;
       var boucle_part = -1;
       $.ajax({
       url: "index.php?r=meeting/meeting/view&meeting="+id,
       type: "POST",
       dataType: "json",
       success: function (data) {
            
            $("a.kv-action-btn.kv-btn-delete").attr("href","index.php?r=meeting/meeting/delete&id_meeting="+data[0].Id_reunion);
            $("#meetting2").val(data[0].Id_reunion);
            $("#reun_parts").val(data[0].Id_reunion);
            
            td_datagrid.eq(0).find("div.kv-attribute").html(data[0].titre );
           td_datagrid.eq(0).find("div.form-group input").val(data[0].titre );

          td_datagrid.eq(1).find("div.kv-attribute").html(data[0].description );
           td_datagrid.eq(1).find("div.form-group textarea").val(data[0].description );

           td_datagrid.eq(2).find("div.kv-attribute").html(data[0].heuredebut );
           td_datagrid.eq(2).find("div.form-group input").val(data[0].heuredebut );

          td_datagrid.eq(3).find("div.kv-attribute").html(data[0].heurefin );
           td_datagrid.eq(3).find("div.form-group input").val(data[0].heurefin );

           td_datagrid.eq(4).find("div.kv-attribute").html(data[0].date );
           td_datagrid.eq(4).find("div.form-group input").val(data[0].date );

           td_datagrid.eq(5).find("div.kv-attribute").html(data[0].lieu );
           td_datagrid.eq(5).find("div.form-group input").val(data[0].lieu );
           td_datagrid.eq(6).find("div.form-group input").val(data[0].Id_reunion);
           
           data[6].forEach(function(item, index){ 
            count = 0;
            boucle+=1; 
                data[2].forEach(function(iteme, indexe){
                  if((boucle ==0)&& (iteme[4] == "non")){
                  
                    devs += iteme[1]+ " "+iteme[0
                    ]+"<br/>";
                    }
                  if(item.id == iteme[3]){
                    (iteme[4] == "non")?
                              optDevs += "<option  selected value = "+iteme[3]+">"+ item.prenom +"  "+ item.nom+"</option>":
                               opt += "<tr><th>#</th><td>"+item.prenom+"</td><td>"+ item.nom + "</td></tr>";
                          
                    count = 1;
                  }
               });
               if(count ==0){
               
                    optDevs += "<option value = "+item.id+">"+ item.prenom +"  "+ item.nom+"</option>";
                    optParts += "<option value = "+item.id+">"+ item.prenom +"  "+ item.nom+"</option>";
                }
            });   
            
            $("#ajouteapres").html(opt);
           td_datagrid.eq(7).find("div.kv-attribute").html( devs );
           td_datagrid.eq(7).find("div.form-group select").attr("multiple", true).html(optDevs);
            
           $("select#partform-participant").html(optParts);

           $("button.kv-action-btn.kv-btn-view").trigger("click");
           //$("a.collapse-link").trigger("click");
           $("#archivereset").trigger("click");
           $("button.btn.btn-danger.fileinput-remove.fileinput-remove-button").trigger("click");
           if((data[5] == "DG") || (data[5] == "DT")){
              
                if(data[1] == 1){
                
                    $("#listeajouteapres").css("display","block");
                    $("#ajouter_participant").css("display","block");
                    $("button.kv-action-btn.kv-btn-view").trigger("click");
                    $("button.kv-action-btn.kv-btn-update").css("display","none");
                    $("a.kv-action-btn.kv-btn-delete").css("display","none");
                    $("a[href]#link").attr("href",data[4]);
                    $("#vue").css("display","block");
                    $("#files").css("display","none");
                    $("#fileUB").css("display","none");
                    $("#detailmodal").modal("show");
                        
                }
                else{
             
                     $("#listeajouteapres").css("display","none");

                    if(data[1] == -1){

                       $("#ajouter_participant").css("display","none");
                       $("button.kv-action-btn.kv-btn-view").trigger("click");
                       (data[9] == 1)? $("button.kv-action-btn.kv-btn-update").css("display","inline"):
                                       $("button.kv-action-btn.kv-btn-update").css("display","none");
                       $("a.kv-action-btn.kv-btn-delete").css("display","none");
                       $("#files").css("display","block");
                       $("#fileUB").css("display","block");
                       $("#vue").css("display","none");
                       $("#detailmodal").modal("show");
                    }
                    else{

                       $("#ajouter_participant").css("display","none");
                       $("button.kv-action-btn.kv-btn-update").css("display","inline");
                       $("a.kv-action-btn.kv-btn-delete").css("display","inline");
                       $("#files").css("display","none");
                       $("#fileUB").css("display","none");
                       $("#vue").css("display","none");
                       $("#detailmodal").modal("show");   

                    }
                }

            }
           else{
           
                $("#listeajouteapres").css("display","none");
                $("#ajouter_participant").css("display","none");             
                $("button.kv-action-btn.kv-btn-update").css("display","none");
                $("a.kv-action-btn.kv-btn-delete").css("display","none");
                    if(data[1] == 1){
                   
                        if(data[7] == 1){
                            $("a[href]#link").attr("href",data[4]);
                            $("#vue").css("display","block");
                        }
                        else{
                            $("#vue").css("display","none");
                        }

                        $("#files").css("display","none");
                        $("#fileUB").css("display","none");
                        $("#detailmodal").modal("show");
                    }
                    else{
                    
                       $("#vue").css("display","none");
                       $("#files").css("display","none");
                       $("#fileUB").css("display","none");
                            if(((data[5] =="AD")||(data[5] =="SDT"))&&(data[1] == -1)){
                                $("#files").css("display","block");
                                $("#fileUB").css("display","block");
                             }
                       $("#detailmodal").modal("show");
                    }
            }

        }

    }); 
}                
'
       
?>
<div class="right_col" role="main">
<div class="">
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
         <div class="x_title">
             <h2>Calendrier des réunions de SEINOVA Sarl </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
          </div>
       <div class="x_content">
          <div id='calendar'>
            <div class="col-md-7 col-sm-9 col-xs-12 col-md-offset-4" style="margin-bottom:15px;margin-top:0px;">
                <div class="col-md-2 btn en_cours " data-trigger="manual" data-title='Note' data-toggle='popover' data-content="Reunions en cours..." style="background-color:#5b90bf;height:25px;color:#ffffff;padding-bottom:30px">point it</div>
                <div class="col-md-2 btn passe_non_archive" data-trigger="manual" data-title='Note' data-toggle='popover' data-content="Reunions passées,sans Archive..." style="height:25px;background-color:#5cb85c;color:#ffffff;padding-bottom:30px">point it</div>
                <div class="col-md-2 btn passe_archive" data-trigger="manual" data-title='Note' data-toggle='popover' data-content="Reunions passées, et protocole Archivé..." style="background-color:#5bc0de;height:25px;color:#ffffff;padding-bottom:30px">point it</div>
            </div>
            <div>
            <?php pjax::begin(['id' => 'fullcallendar']); ?>
             <?=  Yii2fullcalendar::widget(
                   [
                        'clientOptions' => 
                        [
                            'allDaySlot' => false,
                            'selectHelper' => true,
                            'defaultView' => 'month',
                            'selectable' => true,
                            'select' => new JsExpression('function(start, end) {                 
                                    $.ajax({
                                        url: "index.php?r=meeting/meeting/droit",
                                        type: "POST",
                                        dataType: "json",
                                        success: function (data) {

                                            if((data=="DG")||(data == "DT")||(data == "AD")||(data == "SDT")){

                                               $("#modalResetButton").trigger("click");
                                               $("#modal").modal("show");
                                            }
                                            else{

                                            }
                                        }
                                    });    
                                }'),
                            'eventClick' => new JsExpression($js2)
                        ],
                        'options' =>
                        [
                            'language' => 'en',
                            'eventLimit' => 5,
                        ],
                        'events' => $Events,
                  ]);
            ?>
            </div>
            <?php pjax::end(); ?>
            <!--Modal view pour la creation des Reunions -->
            <?php
                Modal::begin([
                    'header' => '<h4>Planifier Vos Réunions</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg-8',
                ]);
            ?>       

            <?php
            $form = ActiveForm::begin([
                'action' => 'index.php?r=meeting/meeting/create',
                'options' => [
                    'class' => 'userform',
                    'id' => 'createform'
                ],

            ]);
            ?>

            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'titre')->textInput() ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'lieu')->textInput() ?>
                </div>
            </div>
                <?= $form->field($model, 'description')->textArea(['rows' => 4]) ?>
            <div class="row">
                <div class="col-lg-6">
                <?=
                $form->field($model, 'heuredebut')->widget(TimePicker::classname(), [
                    'name' => '',
                    'pluginOptions' => [
                        'showSeconds' => true,
                        'showMeridian' => false,
                        'minuteStep' => 5,
                        'secondStep' => 5,
                    ],
                ]);
                ?>
               </div>
               <div class="col-lg-6">
                <?=
                $form->field($model, 'heurefin')->widget(TimePicker::classname(), [
                    'name' => '',
                    'pluginOptions' => [
                        'showSeconds' => true,
                        'showMeridian' => false,
                        'minuteStep' => 30,
                        'secondStep' => 30,
                    ],
                ]);
                ?>
                </div>
            </div >

                <?=
                $form->field($model, 'date')->widget(DatePicker::classname(), [
                    'value' => date('Y-M-d', strtotime('+0 days')),
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'startDate'=>'+0d',
                    ],

                ]);
                ?>
            <div class="row">
            <div class="col-md-5" > 
             <?=  $form->field($model, 'participants')->dropDownList(ArrayHelper::map($model->participants, 'id',
                    function($model, $defaultValue) {
                        return $model['nom'].' '.$model['prenom'];
                     }  
                     ), 
                    ['multiple' => 'multiple',
                        'id'=>'devsId2',
                        'class'=>'multiselect',
                        'size'=>'6',
                        'style'=>'width:100%;',
                        'data-right'=>"#multiselect_to_1",
                        'data-right-all'=>"#right_All_1",
                        'data-right-selected'=>"#right_Selected_1",
                        'data-left-all'=>"#left_All_1",
                        'data-left-selected'=>"#left_Selected_1",
                        'name'=>'from[]',
                    ] )->label('EMPLOYES');

             ?>
             </div>
             <div class="col-md-2" style="padding-top:20px;">
                    <button type="button" id="right_All_1" class="btn btn-block label label-success"><i class="glyphicon glyphicon-forward"></i></button>
                    <button type="button" id="right_Selected_1" class="btn btn-block btn btn-block label label-success"><i class="glyphicon glyphicon-chevron-right"></i></button>
                    <button type="button" id="left_Selected_1" class="btn btn-block btn btn-block label label-primary"><i class="glyphicon glyphicon-chevron-left"></i></button>
                    <button type="button" id="left_All_1" class="btn btn-block btn btn-block label label-primary"><i class="glyphicon glyphicon-backward"></i></button>
             </div>

            <!--select de droite -->

            <div class="col-md-5">
              <?=    $form->field($model, 'selectedParts')->dropDownList([], ['multiple' => 'multiple',
                    'name'=>'to[]',
                    'id'=>'multiselect_to_1',
                    //'class'=>'btn',
                    'size'=>'5',
                    'style'=>'width:100%',
                ])->label('PARTICIPANTS'); 
              ?>
            </div>
            </div>
            <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <?= Html::resetButton('RESET MEETING', [ 'class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'modalResetButton']) ?>
                        <?= Html::submitButton('SAVE MEETING', [ 'class' => 'btn btn-success', 'name' => 'contact-b', 'id' => 'modalButton']) ?>
                    </div>
                </div>   

            <?php ActiveForm::end(); ?>

            <?php Modal::end(); ?> 

            <!--Fin de la Modal view pour la creation des Reunions -->  



            <!--Debut de la Modal view pour l'affichage des details d'une réunion --> 

            <?php
            Modal::begin([
                'header' => '<h4>Details des Réunions</h4>',
                'id' => 'detailmodal',
                'size' => 'modal-lg-12',
                'clientOptions' => [
                    'backdrop' => 'static',
                    'keyboard' => FALSE]
            ]);
            ?>     

            <?php
                $form = ActiveForm::begin(
                [
                    'action' => 'index.php?r=meeting/meeting/add-archive',
                    'options' => 
                    [
                        'enctype' => 'multipart/form-data',
                        'id'=>'uploadform',
                    ]
                ]
            );
            ?>
            <?= $form->field($modele, 'Id_meeting')->hiddenInput(['id' => 'meetting2'])->label(false) ?> 

            <div id="files" style = "display:block">

            <?= $form->field($modele, 'protocole')->widget(FileInput::classname(),
                [   'id' => 'fileforme',
                    'options' => ['multiple' => true],
                    'pluginOptions' => 
                    [
                        'showUpload' => false, 
                        'removeClass' => 'btn btn-danger',
                        'browseClass' => 'btn btn-success',
                        'allowedFileExtensions'=>['pdf','rar','zip'],
                    ]
                ])->label('Archivage Du Protocole de Reunion');
            ?> 
            </div>   
            <div class="row">
                <div class="col-lg-3 ">
                    <div  id = "fileUB">
                      <?= Html::submitButton('UPLOAD FILE PROTOCOL', [ 'class' => 'btn btn-success', 'name' => 'contact-button', 'id' => 'FileUploadButton']) ?>
                    </div>
                </div>
                <div class="col-lg-4" style = "display:none;">
                    <?= Html::resetButton('RESET', [ 'class' => 'btn btn-primary', 'name' => 'contact', 'id' => 'archivereset']) ?>
                </div>
                <div class="col-lg-3">
                    <div  style = "display:none;" id="vue">
                       <?= Html::a('PROTOCOLES DE REUNIONS', 'MeetingsSeinova/pipeline.pdf', ['class'=>'btn btn-primary', 'id'=>'link','target'=>'_blank']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <?= DetailView::widget(
                [
                    'model' => $model_reunion,
                    'mode'=>DetailView::MODE_VIEW,
                    'options'=>['id'=>'detailviews'],
                    'bootstrap'=>true,
                    'bordered'=>true,
                    'condensed'=>false,
                    'enableEditMode'=>true,
                    'panel'=>
                    [
                        'heading'=>'INFOS REUNION ',
                        'type'=>DetailView::TYPE_PRIMARY,
                    ],

                    'formOptions'=>
                    [
                        'action'=>'index.php?r=meeting/meeting/update',
                        'options'=>
                        [
                            'id'=>'updateform'
                        ],
                    ],
                   'deleteOptions'=>
                    [
                       'url'=>Url::to("index.php?r=meeting/meeting/delete"), 
                       'confirm'=>'voulez-vous vraiment supprimer cette reunion?',
                        'ajaxSettings'=>[
                            'success'=>new JsExpression('function(response){

                                    $.pjax.reload({container: "#fullcallendar"});
                                    $("#detailmodal").modal("hide");
                                    $("div.table-responsive.kv-detail-view.kv-detail-loading").removeClass("kv-detail-loading");
                                    //getSendMail(response);
                                    }'),
                            ]
                    ],
                    'updateOptions'=>
                    [
                        'label'=>'<span class="glyphicon glyphicon-pencil" onclick="function(){$("button.kv-action-btn.kv-btn-update").css("display:none");}"></span>'

                    ],   
                    'attributes' => 
                    [
                        [
                            'attribute'=>'titre',
                            'type'=>DetailView::INPUT_HTML5_INPUT,
                            'options'=>[
                                'placeholder'=>'Saisissez un titre ici'
                            ]
                            ],            
                        [
                            'attribute'=>'description',
                            'type'=>DetailView::INPUT_TEXTAREA,
                            'options'=>[
                                'rows'=>'6',
                                'placeholder'=>'Saisissez une description de votre reunion ici'
                            ],
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        [
                            'attribute'=>'heuredebut',
                            'type'=>DetailView::INPUT_TIME,
                            'format'=>'time',
                            

                        ],
                        ['attribute'=>'heurefin','type'=>DetailView::INPUT_TIME],
                        [
                            'attribute'=>'date',
                            'type'=>DetailView::INPUT_DATE,
                            'format'=>'date',
                        ],
                        [
                            'attribute'=>'lieu',
                            'type'=>DetailView::INPUT_HTML5_INPUT,
                        ],

                        [
                            'attribute'=>'Id_reunion',
                            'type'=>DetailView::INPUT_HIDDEN,
                            'rowOptions'=>[
                                'style'=>'display:none',
                            ],
                        ],

                        [
                            'attribute'=>'participants',
                            'type'=>DetailView::INPUT_DROPDOWN_LIST,
                            'options'=>[
                                'size'=>'9',
                                'multiple'=>true,
                            ]
                        ],

                    ]
                ]);
            ?> 
            <div class="" id="listeajouteapres">
                <div class="x_panel">
                    <div class="x_title">
                               <h2>Acces au protocole de Reunion</h2>
                               <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                               </ul>
                               <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                            <table id ="ajouteapres" class="table table-hover">
                            </table> 
                    </div>
                </div>
            </div>
            <!--AJOUT DES PARTICIPANTS AUX PROTOCOLES DES REUNIONS-->
            <div id = "ajouter_participant">  
            <?php
                $form = ActiveForm::begin(
                [
                    'action' => 'index.php?r=meeting/meeting/add-member',
                    'options' => 
                    [
                        'id'=>'addpartform',
                    ]
                ]
            );    
            ?>

            <?= $form->field($partmodele, 'participant[]')->dropDownList($partmodele->ParticipantDropdown,
                     [
                      'multiple'=>'multiple',
                      'class'=>'', 
                      'style'=>'height: 50%; width: 100%;'             
                     ]             
                    )->label('Attribuer des droits d\'accès au protocole') ?>
            <?= $form->field($partmodele, 'Id_reunion')->hiddenInput(['id' => 'reun_parts'])->label(false) ?>  
            <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <?= Html::resetButton('ANNULER', [ 'class' => 'btn btn-primary', 'name' => 'contact', 'id' => '']) ?>
                            <?= Html::submitButton('OK', [ 'class' => 'btn btn-success', 'name' => 'contact-button', 'id' => '']) ?>     
                    </div>
                </div>   


            <?php ActiveForm::end(); ?>

            </div >

            <?php Modal::end(); ?>
<!--Fin de la Modal view pour l'affichage des details des reunions Reunions --> 
 
        </div>
       </div>
     </div>
   </div>
  </div>
 </div>
</div>
<script type="text/javascript">
//*******************************Envoie de mail aux participants*********************************** 

 function getSendMail(response){   
            $.ajax({
                
                url: 'index.php?r=meeting/meeting/message',
                type: 'post',
                data:{
                    'message':response.message,
                    'email':response.email,
                    'entete':response.entete,
                },
                dataTypa:'json',
                success: function (response)
                {
                    
                    $.notify(response.grow, response.options);
                },
                error:function ()
                {
                   alert('Probleme de serveur de  Messagerie ');
                }
            });
            return false;  
    }
     
//*********************************Ajax Create Meeting fontion ***************************************************** 

    $(document).ready(function () {
        $('body').on('beforeSubmit', 'form#createform', function () {
           $("#modalButton").prop("disabled", true);
            var form = $(this);
            if (form.find('.has-error').length)
            { 
                return false; 
            }
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (response)
                {
                    $.pjax.reload({container: '#fullcallendar'});
                    $(form).trigger('reset');    
                    $("#modalButton").prop("disabled", false);
                    $('#modal').modal('hide');
                    $.notify(response.grow, response.options);
                   // getSendMail(response);
                },
                error: function ()
                { 
                }
            });
            return false;
        });
 
 //*********************************Ajax AddArchive fontion ********************************************* 

        $('body').on('beforeSubmit','form#uploadform', function (e) { 
            var form = $(this), formdatas = new FormData($('form#uploadform')[0]); 
             $.ajax({
                url: form.attr('action'),
                type: 'post',
                contentType: false,
                processData: false,
                data: formdatas,
                success: function (response)
                {
                    
                    $.pjax.reload({container: '#fullcallendar'});
                    $('#detailmodal').modal('hide');
                    $('button.btn.btn-danger.fileinput-remove.fileinput-remove-button').trigger('click');
                    
                },
                error: function ()
                {
                   alert('internal server error uploadfile');
                }
            });
            return false;
        });
        

//*********************************Ajax AddMember fontion ********************************************* 

$('form#addpartform').find('button[type="submit"]').on('click', function (e) {
    
            var form = $('#addpartform');
            if (form.find('.has-error').length)
            { 
                return false; 
            }
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (response){  
                    $.pjax.reload({container: '#fullcallendar'});
                    $.pjax.reload({container: '#detailmodal'});
                    $(form).trigger('reset');
                    $('#detailmodal').modal('hide');
                    $.notify(response.grow, response.options);
                },
                error: function (data)
                {
 
                }
            });
            return false;
        });        
//*********************************Ajax Update Meeting fontion ********************************************* 
        $('#updateform').find('button[type="submit"]').on('click', function (e) {
            e.preventDefault;
            var form = $('#updateform');
            if (form.find('.has-error').length)
            {
                return false;
            }
            $.ajax({
                
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (response)
                {
                    $.pjax.reload({container: '#fullcallendar'});
                    $('div.table-responsive.kv-detail-view.kv-detail-loading').removeClass('kv-detail-loading');
                    $('button.kv-action-btn.kv-btn-view').trigger('click');
                    $('#detailmodal').modal('hide');
                    $.notify(response.grow, response.options);            
                },
                error: function ()
                {
                   alert('internal server error updateform');
                }
            });
            return false;
        });
       
       $('.en_cours').popover({ 'trigger': 'hover' });
       $('.passe_non_archive').popover({ 'trigger': 'hover' });
       $('.passe_archive').popover({ 'trigger': 'hover' });
       
   
});

</script>
<script>
$('.multiselect').multiselect();
$('#right_All_1, #right_Selected_1, #left_Selected_1, #left_All_1') .on('click', function(){
    
  var options='',
  currentDevs = $(' #multiselect_to_1 option') ;
  if( !$.isEmptyObject(currentDevs) ){
    currentDevs.each(function(){
        var exist = $("#projectUpdate").find('#'+$(this).attr('id'));
        if(exist !== null){
            options += "<option value="+$(this).val() +" >"+$(this).text()+"</option>";  
        }
    });  
    
  }
  else
  {
    options = '<option></option>';
  }
   $("#projectUpdate #chiefId").html(options);
});
</script>
                   