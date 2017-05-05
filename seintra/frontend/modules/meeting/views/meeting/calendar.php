<?php
    use yii\bootstrap\Modal;
    use yii\grid\GridView;
    use yii\helpers\html;
    use yii\widgets\Pjax;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Url;
    $this->title = 'Reunion';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-12">
       
        <?php
            Modal::begin([
                 'header'=>'<h4>Planifier Vos Reunions</h4>',
                 'id'=>'modal',
                 'size'=>'modal-ld',
                // 'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
             ]);

         ?>       

                    <?php $form = ActiveForm::begin(); ?>


                            <?= $form->field($model, 'titre')->textInput() ?>

                           <?= $form->field($model, 'description')->textArea(['rows' => 6]) ?>

                            <?= $form->field($model, 'heuredebut')->textInput()?>

                            <?= $form->field($model, 'heurefin')->textInput() ?>

                            <?= $form->field($model, 'lieu')->textInput() ?>

                            <?= $form->field($model, 'date')->textInput() ?>


                        <div class="form-group">
                            <?= Html::submitButton('SAVE MEETING', ['value'=>Url::to('index.php?r=meeting/meeting/create'),  'class' => 'btn btn-primary', 'name' => 'contact-button', 'id'=>'modalButton']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>



         <?php  Modal::end();?> 

</div>
    </div>
</div>

<script>
    
  
    $(function(){
        
       $(document).on('click','.fc-day',function(){
          
           var date = $(this).attr('data-date');

           $.get('index.php?r=meeting/meeting/calendar',{'date':date},function(data){
                   $('#modal').modal('show')
                   .find('#modalContent')
                   .html(data);
                   
           });


       });

       $('#modalButton').click(function(){
           //get the click of the create button.
           $('#modal').modal('show')
                   .find('#modalContent')
                   .load($(this).attr('value'));
       });
   });
   
   
</script>

  



