
<?php $this->registerCss('.chief{color:blue }  th.limited{width:20%} } '); ?>
<?php $this->registerCssFile('css/libs/jquery-ui.css')?>
<?php $this->registerCssFile('css/libs/dataTables.jqueryui.min.css')?>
<?php $this->title='projets' ?>
<div id="typeActivite" name="project"></div>
<div class="right_col" role="main" style="">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Projets <?php echo $type; ?> </h3>
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
        <?php $canCreateTech = in_array(Yii::$app->user->identity->role, ['DEV', 'DG', 'DT'] ); ?>
        <?php $canCreateAdm = in_array(Yii::$app->user->identity->role, ['DG', 'DT'] ); ?>
      
        
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">

                            <!-- Button trigger modal -->
                            <?php if( ($type2 == 'technique' && $canCreateTech) || ($type2 != 'technique' && $canCreateAdm)  ){ ?>
                            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCreate">
                                Ajouter un projet
                            </button>
                            <?php } ?>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                 
                        <!-- start project list -->
                        <table id="datatable-buttons" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th >N°</th>
                                    <th class="limited search">Nom du Project</th>
                                    <?php // if($type != 'Techniques'){ ?>
                                    <th style="display:<?= ($type != 'Techniques') ? '' : 'none' ?>" class="search">Prestataire</th>
                                    <?php // } ?>
                                    <?php if($type == 'Techniques'){ ?>
                                    <th class="search limited">Developpeurs</th>
                                    <?php } ?>
                                    <th> Action</th>
                                    <th>Statut</th>
                                    <th>Autre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($finals as $i => $project) { ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?> <span class="description" name="<?= $project['info']['desc'] ?>"> </span> </td>
                                        
                                        <td>
                                            <div class="projectName"> <strong><?php echo $project['info']['nom_projet']; ?></strong> </div>
                                            <span><small>Durée: <span class="startDate"><?php echo $project['info']['date_debut']; ?> </span></small></span>
                                                /
                                            <span><small> <span class="endDate"><?php echo $project['info']['date_fin']; ?></span> </small></span>
                                        </td>
                                        <?php //if(  $type != 'Techniques'){ ?>
                                        <td style="display:<?= ($type != 'Techniques') ? '' : 'none' ?>" ><span class="provider"><?php echo $project['info']['prestataire']; ?></span></td>
                                        <?php // } ?>
                                         <?php $isChief = false ?>
                                        <?php if($type == 'Techniques'){ ?>
                                        <td>
                                            <ul class="list-inline">
                                               
                                                <?php foreach ($project['devs'] as $j => $dev) { ?>
                                                    <?php if($dev['role'] == 'chef' && $dev['id'] == Yii::$app->getUser()->id){
                                                        $isChief = true;
                                                    } ?>
                                                    <li>
                                                        <img src="<?= '../../backend/web/uploads/'.$dev['nom_fich'] ?>" class="avatar" alt="Avatar">
                                                        <span class="devName <?= ($dev['role'] == 'chef') ? 'chief' : '' ?> " id="<?= $dev['id'] ?>" >  <?= $dev['prenom']?> </span>
                                                     </li>
                                                <?php } ?> 
                                            </ul>
                                        </td>
                                        <?php }else{
                                            $isChief = Yii::$app->user->identity->role == "AD" ;
                                        }
?> 
                                        <td>
                                            <?php $isManager = in_array(Yii::$app->user->identity->role, ["DG", "DT"] ) ?>
                                            <?php $notifiable = ( $project['info']['statut'] == 'en cours' && ($isChief || $isManager) ); // Bool weither the project can notified as ended ?>
                                            <?php $validable = ($project['info']['statut'] == 'terminé non validé' && $isManager); // Bool weither the project can notified as ended ?>
                                            <?php $editable = ( ($project['info']['statut'] == 'en cours' || $project['info']['statut'] == 'en attente' ) && ($isChief || $isManager) ); // Bool weither the project can notified as ended ?>
                                            <div class='row'>
                                              <div class='col-lg-4' style='display:inline'>
                                                <button type="button" class=" btn btn-primary btn-round btn-xs <?= $notifiable ? 'notify-end' : ''  ?>" <?= $notifiable ? '' : 'disabled'  ?> >Notify End</button>
                                              </div>
                                             <div  class='col-lg-offset-2 dropdown' style='display:inline'>
                                                <button type="button" data-toggle='dropdown' class="<?= $validable ? 'btn-validate' : '' ?>  btn dropdown-toggle btn-round btn-danger  btn-xs"
                                                        <?= $validable ? '' : 'disabled' ?> >
                                                    Validate End
                                                    <span class="caret"></span>
                                                </button>

                                                <ul class="dropdown-menu" style='width:5px!important' role="menu" aria-labelledby="dropdownMenu1">
                                                    <li role="presentation" >
                                                        <a role="menuitem" class="<?= $validable ? 'accept-end' : '' ?> btn btn-round  btn-info btn-xs" style=" color:black;" tabindex="1" >accept</a>
                                                    </li>
                                                    <li role="presentation" >
                                                        <a role="menuitem" class="<?= $validable ? 'avoid-end' : '' ?>  btn btn-round btn-danger btn-xs" style="color:black" tabindex="1" >avoid</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button"  class="status btn btn-round btn-xs <?= $project['info']['btn_class']; ?>" ><?= $project['info']['statut']; ?></button>
                                        </td>
                                        <td>
                                             <button data-toggle="modal" data-target="#modalDetails" class="btn btn-xs btn-primary  details project-details"><i class="glyphicon glyphicon-eye-open"></i> View </button>
                                            
                                            <button  id="<?= $project['info']['id_projet'] ?>" class="btn btn-xs btn-info  editBtn project" <?= $editable ? '' : 'disabled'  ?>  data-toggle="modal" data-target="<?= $editable ? '#modalUpdate' : ''  ?>  "> 
                                                <i class="fa fa-pencil">Edit </i>
                                            </button >
                                            <a href="<?= \yii\helpers\Url::to(['project/view-details', 'projectId'=>$project['info']['id_projet'], 'type'=>$type2]); ?>" class="btn btn-default btn-xs"><i class="fa fa-external-link"></i> Details</a>
                                           
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- end project list -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('project-details-modal.php'); ?>
<?php include('create-project-form.php'); ?>
<?php include('update-project-form.php'); ?>

<?php $this->registerJsFile('js/project.js'); ?>
<?php $this->registerJsFile('js/libs/jquery.dataTables.min.js')?>
<?php $this->registerJsFile('js/libs/dataTables.keyTable.min.js')?>
<?php $this->registerJsFile('js/libs/dataTables.jqueryui.min.js')?>
<?php $this->registerJsFile('js/customDataTable.js')?>