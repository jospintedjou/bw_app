<?php 
use yii\widgets\DetailView;
?>
<!-- task or activity details Modal -->
<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
               <h4 class="modal-title" id="myModalLabel" align="center">
                    Détails
                </h4>
            </div>
            
            <div class="modal-body ">

              <?php  
                echo DetailView::widget([
                'model' => [],
                'attributes' => [
                    'titre',   
                    'description',
                    'prestataire',
                    'debut',
                    'fin',
                    'Statut',    
                   // 'Developpeurs' 
                ],
        ]); ?>
            </div> <!-- modal body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default modalClose" data-dismiss="modal">
                  Fermer
               </button>
            </div><!-- /.modal-footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal dialog -->
</div><!-- /.modal details -->

