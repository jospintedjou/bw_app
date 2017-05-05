
<style> li, td{font-size:16px} 
    .nav li span{ font-size:17px; font-weight: 900}
    .main-table thead th{  background-color: #8c8c8c   }
    .second-table thead th{  background-color: #cccc99  }
  /**  .main-tbody tr:nth-child(odd) td {
   background-color: #ccc;
}

 .second-tbody tr:nth-child(odd) td {
   background-color: red;
    } **/
</style>

<div id="typeActivite" name="project"></div>
<div class="right_col" role="main" style="">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h2 style="margin-left:25px">RECAPITULATIF DE SUIVI DE PROJET
                    <h4> <?= $project['nom'] ?></h4>
                    <hr/> </h2>
                
            </div>
            
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Propriétés du projet</h3>
                     
                        <ul class="nav navbar-right panel_toolbox">
                            <li>  <span> Intitulé: </span> <?= $project['nom'] ?> </li>
                            <li> <span>Descrition:</span> <?= $project['description'] ?> </li>
                            <li> <span>Type:</span> <?= 'projet'.' '.$type2 ?> </li>
                            <li> <span>DU:</span> <?= $project['date_debut'] ?>
                                <span> AU:</span> <?= $project['date_fin'] ?> 
                            </li>
                            <li><?php if( !empty($project['prestataire']) ) {
                                    echo '<span>Prestataire: </span>'.$project['prestataire'];
                              } ?>
                            </li>
                            <li><?php if($project['type'] !='adm_struct'){
                                    echo '<span>Developpeurs: </span>';
                                    foreach( $devs as $dev){ 
                                       echo($dev['nom']).', ';
                                       if($dev['role']=='chef'){
                                           $chef = $dev['nom'];
                                       }
                                    }
                                    echo '<li><span>Chef de projet:</span> '.$chef.'</li>';
                                    
                            } ?>
                            </li>
                        </ul>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                       <h3>Déroulement du projet</h3>
                        <!-- start project list -->
                        <table id="datatable-buttons" class="main-table table table-striped table-bordered">
                            <thead >
                                <tr >
                                    <th >N°</th>
                                    <th>Nom de l'acivité</th>
                                    <th>Description</th>
                                    <th>Prestataire</th>
                                    <?php if ($type == 'technique') { ?>
                                        <th class='search'>Developpeurs</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody class="main-tbody">
                               <?php if( !empty($finals)) { ?>
                                <?php foreach ($finals as $i => $project) { ?>
                                    <tr>
                                        <td><?= $i + 1; ?>
                                          
                                        </td>
                                       
                                        <td>
                                            <div class="projectName"> <strong><?php echo $project['info']['nom_activite']; ?></strong> </div>
                                            <span><small>Durée: <span class="startDate"><?php echo $project['info']['date_debut']; ?> </span></small></span>
                                            /
                                            <span><small> <span class="endDate"><?php echo $project['info']['date_fin']; ?></span> </small></span>
                                        </td>
                                         <td> <?= $project['info']['desc'] ?> </td>
                                        <td><span class="provider"><?php echo $project['info']['prestataire']; ?></span></td>
                                        <?php if ($type == 'technique') { ?>
                                            <td>
                                                <ul class="list-inline">
                                                    <?php foreach ($project['devs'] as $j => $dev) { ?>
                                                        <li>
                                                            <span class="devName " id="<?= $dev['id'] ?>" >  <?php echo $dev['prenom'] . " " . $dev['nom']; ?> </span>
                                                        </li>
                                                    <?php } ?> 
                                                </ul>
                                            </td>
                                        <?php } ?>
                        
                                        
                                       
                                    </tr>      
                                    <?php if (!empty($project['tasks'])) { ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td colspan=6> 
                                            <table id="datatable-buttons" class="second-table subTasks1 table table-striped table-bordered" style='background-color:#dcb; display: none'>
                                                <caption  style='font-size:1.2em; text-align:center'>Tasks</caption>
                                            <thead>
                                              <tr>
                                               
                                                <th>N°</th>
                                                <th>Nom Tâche</th>
                                                <th>Description</th>
                                                <th>Prestataire</th>
                                                <?php if ($type == 'technique') { ?>
                                                    <th>Developpeurs</th>
                                                <?php } ?>
                                              </tr>
                                            </thead>
                                            <tbody class="second-tbody">
                                            <?php foreach ($project['tasks'] as $cnt=>$task){ ?>
                                                <tr>
                                                   
                                                    <td><?= $cnt+1 ?></td>
                                                    
                                                    <td>
                                                        <div class="projectName"> <strong><?php echo $task['info']['nom_tache']; ?></strong> </div>
                                                        <span><small>Durée: <span class="startDate"><?php echo $task['info']['date_debut']; ?> </span></small></span>
                                                        /
                                                        <span><small> <span class="endDate"><?php echo $task['info']['date_fin']; ?></span> </small></span>
                                                    </td>
                                                    <td> <span class="description" name="<?=  $task['info']['desc']  ?>"> <?php echo $task['info']['desc']; ?></span> </td>
                                                    
                                                    <td><span class="provider"><?php echo $task['info']['prestataire']; ?></span></td>
                                                    <?php if ($type == 'technique') { ?>
                                                        <td>
                                                            <ul class="list-inline">
                                                                <?php foreach ($task['devs'] as $cnt2 => $dev) { ?>
                                                                    <li>
                                                                       
                                                                        <span class="devName " id="<?= $dev['id'] ?>" >  <?php echo $dev['prenom'] . " " . $dev['nom']; ?> </span>
                                                                    </li>
                                                                <?php } ?> 
                                                            </ul>
                                                        </td>
                                                    <?php } ?>
                          
                                                   
                                                   
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



