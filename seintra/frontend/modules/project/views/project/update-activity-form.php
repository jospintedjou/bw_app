<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
?>
<!-- project update Modal -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
               <h4 class="modal-title" id="myModalLabel" align="center">
                    Mise à jour
                </h4>
            </div>
            <?php $form = ActiveForm::begin(['action' => Url::toRoute('project/update-activity'), 'id'=>'projectUpdate']); ?>    
            <div class="modal-body">

                <?= $form->field($model, 'title')->textInput(['id'=>'titleId'])->label('titre') ?>
                <?= $form->field($model, 'provider')->textInput(['id'=>'provId'])->label('prestataire') ?>
                <?= $form->field($model, 'description')->textarea(['rows' => '4', 'id'=>'descId'])->label('description') ?>

                <?php if(isset($type) && $type=='Techniques' ){ ?>
                <label> Developpeurs </label> 
                <div class='row'>
                  <div class="col-xs-5 ">
                  <?php
                    echo    $form->field($model, 'devs')
                         ->dropDownList(ArrayHelper::map($model->devs, 'id', 
                               function($model, $defaultValue) {
                        return $model['nom'].' '.$model['prenom'];
                    }  ), ['multiple' => 'multiple',
                        'id'=>'devsId2',
                        'class'=>'multiselect',
                        'size'=>'10',
                        'style'=>'width:100%',
                        'data-right'=>"#multiselect_to_1",
                        'data-right-all'=>"#right_All_1",
                        'data-right-selected'=>"#right_Selected_1",
                        'data-left-all'=>"#left_All_1",
                        'data-left-selected'=>"#left_Selected_1",
                        'name'=>'from[]',
                        ] )->label(false);
                 ?>
                  </div>
                 <div class="col-xs-2">
                    <button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                    <button type="button" id="right_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                    <button type="button" id="left_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                    <button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                 </div>
                 <div class="col-xs-5">
                    <?= $form->field($model, 'selectedDevs')
                         ->dropDownList([], ['multiple' => 'multiple',
                        'name'=>'to[]',
                        'id'=>'multiselect_to_1',
                        'size'=>'9',
                              'style'=>'width:100%',
                             ])
                         ->label(false)
                         ; 
                    ?>
                 </div>
                </div> 
                
                <?php } ?> 
               
                <?= $form->field($model, 'dateStart2')->widget(DatePicker::className(),
                                                ['pluginOptions' => [
                                                 'autoclose'=>true, 'todayHighlight'=>true,
                                                 'language'=>'en',
                                                 'format' => 'yyyy-mm-dd',
                                                 'startDate' => $projectInit['date_debut'],
                                                 'endDate' => $projectInit['date_fin'],
                                                 'todayBtn'=>true,
                                                  ], 'options'=>['name1'=>'startDateId2'] ] )
                                            ->label('date de début') ?>
                <?= $form->field($model, 'dateEnd2')->widget(DatePicker::className(),
                                            ['pluginOptions' => [
                                             'autoclose'=>true,
                                             'language'=>'en',
                                             'format' => 'yyyy-mm-dd',
                                             'startDate' => $projectInit['date_debut'],
                                             'endDate' => $projectInit['date_fin'],
                                             'todayHighlight'=>true,
                                             'todayBtn'=>true,
                                             'startView'=>'0',
                                            ], 'options'=>['name1'=>'endDateId2'] ])
                    ->label('date de fin') ?>
                <?= $form->field($model, 'type')->hiddenInput(['value' => $type2])->label(false) ?>              
                <?= $form->field($model, 'projectId')->hiddenInput(['value' => '', 'id'=>'projectId'])->label(false) ?>              
                <?= $form->field($model, 'activityId')->hiddenInput(['value' => '', 'id'=>'activityId'])->label(false) ?>              
                <?= $form->field($model, 'taskId')->hiddenInput(['value' => '', 'id'=>'taskId'])->label(false) ?>              
            </div> <!-- modal body -->
            <div class="modal-footer">
                <?= Html::submitButton('Valider', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <button type="button" class="btn btn-default modalClose" data-dismiss="modal"> Fermer </button>
                <input type='reset' class="resetForm" style='display:none'/>
            </div>
        <?php ActiveForm::end(); ?>
      </div><!-- /.modal-content -->
    </div><!-- /.modal dialog -->
</div><!-- /.modal update project -->
