<?php
    
    use yii\grid\GridView;
    use yii\helpers\html;
    use yii\widgets\Pjax;
    use yii\bootstrap\Modal;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Url;
?>

<div class="event-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

        <?php
         
//         $Events[$tablereunion] = $newEvent;
           // 'Event' => $Events;
         ?> 
            

         <?php Pjax::begin();?>

            <?= \yii2fullcalendar\yii2fullcalendar::widget(
                   [ 
                    'clientOptions' => [
                        'allDaySlot' => false,
                        'selectHelper' => true,
                        'defaultView' => 'month',
                        'header' => [
                            'center'=>'prev,next today',
                            'left'=>'',
                            'right'=>'agendaDay,agendaWeek,month',
                        ],
                    ],
                    'events' => $Events,
                ]);
         ?>

         <?php Pjax::end();?>
    
    
         <?php
            Modal::begin([
                 'header'=>'<h4>Planifier Vos Reunions</h4>',
                 'id'=>'modal',
                 'size'=>'modal-ld',
                 //'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
             ]);

         ?>       

        <?php $form = ActiveForm::begin( [
            'action' => 'index.php?r=meeting/meeting/create',
            'options' => [
                
                'class' => 'userform',
             ]
        ]); 
        ?>


           <?= $form->field($model, 'titre')->textInput() ?>

           <?= $form->field($model, 'description')->textArea(['rows' => 6]) ?>

           <?= $form->field($model, 'heuredebut')->textInput() ?>

           <?= $form->field($model, 'heurefin')->textInput() ?>

           <?= $form->field($model, 'lieu')->textInput() ?>

          
    
           
           
           <div class="form-group">
              <?= Html::submitButton('SAVE MEETING', [ 'class' => 'btn btn-primary', 'name' => 'contact-button', 'id'=>'modalButton']) ?>
           </div>

         <?php ActiveForm::end(); ?>

       <?php  Modal::end();?> 
    
    <input type = "text" name="toto" value="papa" id="tt"></input>
    <input type = "button" name="toto" value="OK" id="to"></input>
    
</div>

<script>
    
  
    $(function(){
        
       $(document).on('click','.fc-day',function(){
           
           var date = $(this).attr('data-date');
               alert(date);
           $.get('index.php?r=meeting/meeting/index',{'date':date},function(data){
                   $('#modal').modal('show')
                  .find('#modalContent')
                   .html(data);               
          });


       });

   });
  
$('#calendar').fullCalendar({ 
    eventClick: function(event) {
            if (event.url) {
                window.open(event.url);
                return false;
            }
        }
});

</script>

  
