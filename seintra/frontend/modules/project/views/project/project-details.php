
<?php $this->registerCss('.chief{color:blue } th.limited{width:20%} th.limited2{width:15%} th.limited2_devs{width:20%}  .list-group-item.list-group-item{padding:2px;} '); ?>
<?php //$this->registerCssFile('css/libs/jquery-ui.css')?>
<?php //$this->registerCssFile('css/libs/dataTables.jqueryui.min.css')?>
<?php $this->title='Détails du projet' ?>
<div id="typeActivite" name="project"></div>
<div class="right_col" role="main" style="">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Activités du projet </h3>
                
                <?php if (Yii::$app->session->hasFlash('dateStartError')){ ?>
                <div class="alert alert-error alert-dismissable">
                    <button aria-hidden="false" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="icon fa fa-check"></i>Erreur!</h4>
                    <?= Yii::$app->session->getFlash('dateStartError') ?>      
                </div>
             <?php } ?>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php  $ch = ($type == 'Techniques') ? ($projectChief[0]['id'] == Yii::$app->getUser()->id) : false ;  ?>
        <?php $canCreateTech = in_array(Yii::$app->user->identity->role, ['DG', 'DT']) || $ch; ?>
        <?php $canCreateAdm = in_array(Yii::$app->user->identity->role, ['AD', 'DG', 'DT'] ); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title row">
                        <div class='col-lg-6'>
                            <ul class=" list-group"> <a>
                                <li class='list-group-item'>  <span> Intitulé: </span> <?= $project['nom'] ?> </li>

                               <li class='list-group-item'> <span>Type:</span> <?= 'projet'.' '.$type2 ?> </li>
                               <li class='list-group-item'> <span>DU:</span> <?= $project['date_debut'] ?>
                                   <span> AU:</span> <?= $project['date_fin'] ?> 
                               </li>
                               <li class='list-group-item'><?php if( !empty($project['prestataire']) ) {
                                       echo '<span>Prestataire: </span>'.$project['prestataire'];
                                 } ?>
                               </li>
                               </a>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-lg-offset-1" >
                            <ul class="nav navbar-right panel_toolbox">
                               <!-- Button trigger modal -->
                               <?php $projectInit = $project;
                                      $actAdding = in_array($project['statut'], ['en_cours', 'en_attente']) ;
                               ?>
                               <?php if($project['statut'] == 'termine'){ ?>
                                <a target="_blank" href="<?= \yii\helpers\Url::to(['project/create-mpdf', 'projectId'=>$project['id_projet'] ]); ?>" class="btn btn-lg btn-success"><i class="fa fa-book"></i> Exporter en PDF</a>
                               <?php } ?>
                                <?php if( $actAdding && ($type2 == 'technique' && $canCreateTech) || ($type2 != 'technique' && $canCreateAdm)){ ?>
                               <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCreate">
                                   Ajouter une activité
                               </button>
                               <?php } ?>

                            </ul>
                        </div>
                        
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="x_content">


                        <!-- start project list -->
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th class='limited search'>Nom de l'activité</th>
                                    <th style="display:<?= ($type != 'Techniques') ? '' : 'none' ?>"  class="limited search">Prestataire</th>
                                    <?php if ($type == 'Techniques') { ?>
                                        <th class='limited search'>Developpeurs</th>
                                    <?php } ?>
                                    <th class='limited'> Action</th>
                                    <th>Statut</th>
                                    <th>Autre</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php if( !empty($finals)) { ?>
                                <?php foreach ($finals as $i => $project) { ?>
                                    <tr>
                                        <td><?php echo $i + 1; 
                                            if(isset($project['tasks']) && !empty($project['tasks'])){
                                        ?> 
                                            <i id='' class="taskIcon1 fa fa-plus-circle" style='font-size:1.5em; text-shadow: 1px 1px 1px #ccc;'></i> 
                                        <?php } ?> 
                                            <span class="description" name="<?= $project['info']['desc'] ?>"> </span> 
                                        </td>

                                        <td>
                                            <div class="projectName"> <strong><?php echo $project['info']['nom_activite']; ?></strong> </div>
                                            <span><small>Durée: <span class="startDate"><?php echo $project['info']['date_debut']; ?> </span></small></span>
                                            /
                                            <span><small> <span class="endDate"><?php echo $project['info']['date_fin']; ?></span> </small></span>
                                        </td>
                                        <td style="display:<?= ($type != 'Techniques') ? '' : 'none' ?>"><span class="provider"><?php echo $project['info']['prestataire']; ?></span></td>
                                        <?php $isChief = false ?>
                                        <?php if ($type == 'Techniques'){ ?>
                                                    
                                            <td>
                                                <ul class="list-inline">
                                                    <?php foreach ($project['devs'] as $j => $dev) { ?>
                                                    <?php if( $projectChief[0]['id'] == Yii::$app->getUser()->id){
                                                        $isChief = true;
                                                    } ?>
                                                        <li>
                                                            <img src="<?= '../../backend/web/uploads/'.$dev['nom_fich'] ?>" class="avatar" alt="Avatar">
                                                            <span class="devName " id="<?= $dev['id'] ?>" >  <?= $dev['prenom'] ?> </span>
                                                        </li>
                                                    <?php } ?> 
                                                </ul>
                                            </td>
                               <?php }else{
                                            $isChief = Yii::$app->user->identity->role == "AD" ;
                                        } ?>
                                        <td> 
                                            <?php $isManager = in_array(Yii::$app->user->identity->role, ["DG", "DT"] ) ?>
                                            <?php $notifiable = ( $project['info']['statut'] == 'en cours' && ($isChief || $isManager) ); // Bool weither the project can notified as ended ?>
                                            <?php $validable = ($project['info']['statut'] == 'terminé non validé' && $isManager); // Bool weither the project can notified as ended ?>
                                            <?php $editable = ( ($project['info']['statut'] == 'en cours' || $project['info']['statut'] == 'en attente' ) && ($isChief || $isManager) ); // Bool weither the project can notified as ended ?>
                                            <button type="button" class="btn btn-primary btn-round btn-xs <?= $notifiable ? 'notify-end' : '' ?>" <?= $notifiable ? '' : 'disabled' ?> >Notify End</button>
                                            <div class='dropdown' style='display:inline'>
                                                <button type="button" data-toggle='dropdown' class="<?= $validable ? 'btn-validate' : '' ?> btn dropdown-toggle btn-round btn-danger  btn-xs"
                                                        <?= $validable ? '' : 'disabled' ?> >
                                                    Validate End
                                                    <span class="caret"></span>
                                                </button>

                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                    <li role="presentation">
                                                        <a role="menuitem" class="<?= $validable ? 'accept-end' : '' ?> btn btn-round  btn-info btn-xs" style=" color:black" tabindex="1" >validate</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="<?= $validable ? 'avoid-end' : '' ?>  btn btn-round btn-danger btn-xs" style="color:black" tabindex="1" >avoid</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button"  class="status btn btn-round btn-xs <?= $project['info']['btn_class']; ?>" ><?= $project['info']['statut']; ?></button>
                                        </td>
                                        <td>
                                            <button data-toggle="modal" data-target="#modalDetails" class="btn btn-primary btn-xs details"><i class="glyphicon glyphicon-eye-open"></i> View </button>
                                            <button id="<?= $project['info']['id_projet'] ?>" name="<?= $project['info']['id_activite'] ?>" class="btn btn-xs btn-info  editBtn activity" <?= $editable ? '' : 'disabled' ?> data-toggle="modal" data-target="<?= $editable ? '#modalUpdate' : '' ?> "> 
                                                <i class="fa fa-pencil">Edit </i>
                                            </button >
                                            <button id="<?= $project['info']['id_projet'] ?>" name="<?= $project['info']['id_activite'] ?>" class="btn btn-xs btn-default  addTask" <?= $editable ? '' : 'disabled' ?>  data-toggle="modal" data-target="<?= $editable ? '#modalCreate' : '' ?>"> 
                                                <i class="fa fa-plus-square">Add Task</i>
                                            </button >
                                            </button>
                                        </td>
                                    </tr>      
                                    <?php if (!empty($project['tasks'])) { ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td colspan=6> 
                                            <table id="datatable-buttons" class="subTasks1 table table-striped table-bordered" style=' display: none'>
                                                <caption  style='background-color:#00264d; font-size:1.2em; text-align:center'>Tâches</caption>
                                            <thead>
                                              <tr>
                                               
                                                <th>N°</th>
                                                <th class='limited2'>Nom Tâche</th>
                                                <th class='limited2'>Description</th>
                                                <th style="display:<?= ($type != 'Techniques') ? '' : 'none' ?>" class='limited2'>Prestataire</th>
                                                <?php if ($type == 'Techniques') { ?>
                                                    <th class='limited2_devs'>Developpeurs</th>
                                                <?php } ?>
                                                <th> Action</th>
                                                <th>Statut</th>
                                                <th>Autre</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($project['tasks'] as $cnt=>$task){ ?>
                                                <tr>
                                                   
                                                    <td><?= $cnt+1 ?></td>
                                                    
                                                    <td>
                                                        <div class="projectName"> <strong><?php echo $task['info']['nom_tache']; ?></strong> </div>
                                                        <span><small>Durée: <span class="startDate"><?php echo $task['info']['date_debut']; ?> </span></small></span>
                                                        /
                                                        <span><small> <span class="endDate"><?php echo $task['info']['date_fin']; ?></span> </small></span>
                                                    </td>
                                                    <td> <span class="description" name="<?=  $task['info']['desc']  ?>"> <?php echo $task['info']['nom_tache']; ?></span> </td>
                                                    <td style="display:<?= ($type != 'Techniques') ? '' : 'none' ?>"><span class="provider"><?php echo $task['info']['prestataire']; ?></span></td>
                                                     <?php if ($type == 'Techniques') { ?>
                                                        <td>
                                                            <ul class="list-inline">
                                                                <?php foreach ($task['devs'] as $cnt2 => $dev) { ?>
                                                                    <li>
                                                                        <img src="<?= '../../backend/web/uploads/'.$dev['nom_fich'] ?>" class="avatar" alt="Avatar">
                                                                        <span class="devName " id="<?= $dev['id'] ?>" >  <?= $dev['prenom']  ?> </span>
                                                                    </li>
                                                                <?php } ?> 
                                                            </ul>
                                                        </td>
                                                    <?php } ?>
                                                    <td>
                                                        <?php $notifiable2 = ( $project['info']['statut'] == 'en cours' && ($isChief || $isManager) ); // Bool weither the project can notified as ended ?>
                                                        <?php $validable2 = ($project['info']['statut'] == 'terminé non validé' && $isManager); // Bool weither the project can notified as ended ?>
                                                        <?php $editable2 = ( ($project['info']['statut'] == 'en cours' || $project['info']['statut'] == 'en attente' ) && ($isChief || $isManager) ); // Bool weither the project can notified as ended ?>
                                                        <button type="button" class="btn btn-primary btn-round btn-xs <?= $notifiable2 ? 'notify-end' : ''  ?> " <?= $notifiable2 ? '' : 'disabled'  ?> >Notify End</button>
                                                        <div class='dropdown' style='display:inline'>
                                                            <button type="button" data-toggle='dropdown' class="<?= $validable2 ? 'btn-validate' : '' ?> btn dropdown-toggle btn-round btn-danger  btn-xs"
                                                                    <?= $validable2 ? '' : 'disabled' ?> >
                                                                Validate End
                                                                <span class="caret"></span>
                                                            </button>

                                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                                <li role="presentation">
                                                                    <a role="menuitem" class="<?= $validable2 ? 'accept-end' : '' ?>  btn btn-round  btn-info btn-xs" style=" color:black" tabindex="1" >validate</a>
                                                                </li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" class="<?= $validable2 ? 'avoid-end' : '' ?>  btn btn-round btn-danger btn-xs" style="color:black" tabindex="1" >avoid</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button"  class="status btn btn-round btn-xs <?= $task['info']['btn_class']; ?>" ><?= $task['info']['statut']; ?></button>
                                                    </td>
                                                    <td>
                                                        <button  data-toggle="modal" data-target="#modalDetails" class="btn btn-primary btn-xs details"><i class="glyphicon glyphicon-eye-open"></i> View </button>
                                                        <button actId="<?= $project['info']['id_activite'] ?>" id="<?= $project['info']['id_projet'] ?>" name = "<?= $task['info']['id_tache'] ?>" class="btn btn-xs btn-info  editBtn task" <?= $editable2 ? '' : 'disabled'  ?>  data-toggle="modal" data-target="<?= $editable2 ? '#modalUpdate' : ''  ?>"> 
                                                            <i class="fa fa-pencil">Edit </i>
                                                        </button >
                                                        </button>
                                                    </td>
                                                </tr>
                                                
                                    <?php     } ?>
                                            </tbody>
                                        </table>
                                    <?php    } 
                               } } ?>
                                                </tbody>
                                        </table>
                                        <!-- end project list -->

                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
<?php include('task-details-modal.php'); ?>
<?php include('create-activity-form.php'); ?>
<?php include('update-activity-form.php'); ?>


<?php $this->registerJsFile('js/project.js'); ?>
<?php // $this->registerJsFile('js/libs/jquery.dataTables.min.js') ?>
<?php //$this->registerJsFile('js/libs/dataTables.keyTable.min.js') ?>
<?php //$this->registerJsFile('js/libs/dataTables.jqueryui.min.js') ?>
<?php // $this->registerJsFile('js/customDataTable.js') ?>