<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
?>


<!-- project create Modal -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel" align="center">
                    Nouveau projet
                </h4>
            </div>
            <?php $form = ActiveForm::begin(['action' => Url::toRoute('project/add-project'), 'id'=>'projectCreate']); ?>   
            
            <div class="modal-body">

                <?= $form->field($model, 'title')->textInput(['id'=>'titleId'])->label('titre') ?>
                <?= $form->field($model, 'provider')->textInput(['id'=>'provId'])->label('prestataire') ?>
                <?= $form->field($model, 'description')->textarea(['rows' => '6', 'id'=>'descId'])->label('description') ?>
                
                <?php if(isset($type) && $type=='Techniques' ){
                echo    $form->field($model, 'selectedDevs')
                         ->dropDownList(ArrayHelper::map($model->devs, 'id', 
                               function($model, $defaultValue) {
                        return $model['nom'].' '.$model['prenom'];
                    }  ), ['multiple' => 'multiple',
                        'id'=>'devsId',
                        'onchange' => 'var $options = ""; $("#chiefId").parent().show(); '
                                    . '$("#projectCreate #devsId option:selected").each(function(){'
                                              .'$options += "<option value="+$(this).val() +" >"+$(this).text()+"</option>";  });'
                                    . '   $("#projectCreate #chiefId").html($options);'
                        ] )
                ->label('Developpeurs'); 
               
                  echo  $form->field($model, 'chief')
                         ->dropDownList([],['id'=>'chiefId'] )
                         ->label('Chef de projet');
                }
                ?>
                <?= $form->field($model, 'dateStart')->widget(DatePicker::className(),
                                                ['pluginOptions' => [
                                                'autoclose'=>true, 'todayHighlight'=>true,
                                                  'language'=>'en',
                                                  'format' => 'yyyy-mm-dd',
                                                'todayBtn'=>true,
                                                  ], 'options'=>[] ] )
                                            ->label('date de début') ?>
                <?= $form->field($model, 'dateEnd')->widget(DatePicker::className(),['pluginOptions' => [
                                'autoclose'=>true,
                                'language'=>'en',
                                'format' => 'yyyy-mm-dd',
                                'startDate' => "0d",
                                'todayHighlight'=>true,
                                'todayBtn'=>true,
                                'startView'=>'0',
                               // 'daysOfWeekDisabled'=>[5,6]
                            ], 'options'=>[] ])
                    ->label('date de fin') ?>
                <?= $form->field($model, 'type')->hiddenInput(['value' => $type2 ])->label(false) ?>              
            </div> <!-- modal body -->
            <div class="modal-footer">
  <?= Html::submitButton('Valider', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
  <button type="button" class="btn btn-default modalClose" data-dismiss="modal">
				Fermer
 </button>
 <input type='reset' class="resetForm" style='display:none'/>
            </div>
<?php ActiveForm::end(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal dialog -->
</div><!-- /.modal create-->