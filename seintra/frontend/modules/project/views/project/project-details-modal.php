
<!-- task or activity details Modal -->
<?php $this->registerCss('.list-group li:nth-child(odd) {
                                            background-color: #f9f9f9}
                                      li span:nth-child(1){font-weight:bold}'); ?>
<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
               <h4 class="modal-title" id="myModalLabel" align="center">
                    Détails du projet
                </h4>
            </div>
            
            <div class="modal-body ">
                <ul class="list-group"> 
                  <a>
                    <li class='list-group-item row'>  
                        <span class="pull-left col-lg-6"> Intitulé: </span> <span class='info col-lg-6'> </span>  
                    </li>
                    <li class='list-group-item row'> 
                        <span class="pull-left col-lg-6">Description: </span> <span class='info col-lg-6'> </span> 
                    </li>
                    <li class='list-group-item row'>
                             <span class='col-lg-6'>Prestataire: </span> <span class='info col-lg-6'> </span> 
                    </li>
                    <li class='list-group-item row'> 
                        <span class='col-lg-3'>DU:</span> <span class='info col-lg-3'> </span> 
                        <span class='col-lg-3'> AU:</span> <span class='info col-lg-3'> </span> 
                    </li>
                    <li class="list-group-item row"> 
                      <?php if($type2 !='adm_struct'){ ?>
                        <span class='col-lg-6'>Chef de projet: </span>  <span class='info col-lg-6'> </span>
                      <?php } ?>
                    </li>
                    </li>
                   </a>
                </ul>
               
            </div> <!-- modal body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default modalClose" data-dismiss="modal">
                  Fermer
               </button>
            </div><!-- /.modal-footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal dialog -->
</div><!-- /.modal details -->

