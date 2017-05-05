<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->title = 'Commentaires';
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Commentaires <small>consulter et ajouter vos commentaires</small></h3>
            </div>            
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_content" style='background-color: white'>
                    <div class="x_panel">
                        <div class="x_title">
                            <h4>veuillez entrer votre commentaire ici</h4>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- start form for validation -->
                            <?php $form = ActiveForm::begin(['action' => Url::toRoute('publication/comment')]); ?>
                            <p style="padding: 5px;">

                                <?= $form->field($model, 'contenu',['inputOptions'=>['id'=>'contenu']])->textarea([ 'class' => 'form-control'])->label('Message:') ?>
                            <div style="display: none">
                                <?= $form->field($model, 'publId')->hiddenInput(['value'=>$publ['id_publ'], 'maxlength' => 255, 'class' => 'form-control']) ?>
                            </div>                                
                            <?= Html::submitButton('Envoyer', ['class' => 'btn btn-primary btn lg','id'=>'btn_submit']) ?>

                            <?php ActiveForm::end(); ?>
                            <!-- end form for validations -->

                        </div>
                    </div>
                    <!-- Publication commentée -->
                    <div class='row' style="padding:3px; margin:0px; box-sizing: border-box">

                          <ul id="menu1" class="list-unstyled msg_list"  >
                               <li style='background-color: #d7edfc; border:1px solid grey; border-radius: 5px;font-family: 'Open Sans , sans-serif;'>
                              <div class="col-lg-1">

                                  <div class="avatar">
                                      <span  <span class="image">
                                          <img src="<?='../../backend/web/uploads/'.$publ['nom_fich'] ?>" alt="Profile Image" />
                                      </span>
                                   </div>
                                  <div class="icons">

                                  </div>

                                  <span>
                                      <span><?= ($publ['id_user'] == Yii::$app->user->identity->id) ? 'VOUS' : HTML::Encode($publ['prenom']);  ?> </span>
                                  </span>

                                  <div class="clearfix"></div>
                              </div>
                            <a>
                          <div class="col-lg-9 " style="color:#215348; background-color: #d7edfc; width:100%;padding: 0px; margin:0px 0px 0px 0px">
                                      <div class="message" style="font-size:18px; font-weight: 500; line-height: 1.4;" >
                                          <?= HTML::Encode($publ['contenu']); ?>
                                      </div>  
                              <div class='row' style=' min-width:30em;'>
                               <div class=" col-lg-offset-8 " style="min-width:10em; font-size:13px; font-weight: bold; margin-top:8px; position: relative; bottom: 0em; right:10px"> <?= HTML::Encode($publ['date_post']); ?></div>
                               
                              </div>
                              <div class="clearfix"></div>
                          </div>  
                          </a>
                             </li>  
                          </ul>

                      </div> 
                    
                    <!--   commentaires -->                 
                    <?php if (empty($comments)) { 
                      echo "<div class='alert alert-success' style='text-align: center'><strong>AUNCUN COMMENTAIRE A AFFICHER.</strong></div>";
                    } else { ?>
                    <h4 class="title_left col-lg-1 "> Commentaires</h4>
                        <div class='col-lg-11 col-lg-offset-1' style="">
                      <?php  foreach ($comments as $comment) {
                            ?>

                            <div class='row' style=" padding:3px; margin:0px; box-sizing: border-box; background-color: white">
                                
                                <ul id="menu1" class="list-unstyled msg_list"  >
                                     <li style='background-color: white; border:0px solid grey; border-radius: 5px;font-family: "Open Sans Light, sans-serif";'>
                                         
                                    <div class="col-lg-1" style=''>
                                   
                                        <div class="avatar">
                                            <span  <span class="image">
                                                <img class='img-circle' src="<?='../../backend/web/uploads/'.$comment['nom_fich'] ?>" alt="Profile Image" />
                                            </span>
                                         </div>
                                        <div class="icons">
                                           
                                        </div>
                                        
                                        <span>
                                            <span><?= ($comment['id_user'] == Yii::$app->user->identity->id) ? 'VOUS' : HTML::Encode($comment['prenom']);  ?> </span>
                                        </span>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                 <a>
                                <div class="col-lg-9 "style="background-color: #f5f9fd; width:100%; margin:0px 0px 0px 0px">
                                            <span class="message" style="font-size:18px; font-weight: 500; line-height: 1.4;" >
                                                <?= HTML::Encode($comment['contenu']); ?>
                                            </span>  
                                    
                                    <div class='row' style=' min-width:30em;'>
                                    <div class=" col-lg-offset-8 " style="min-width:10em; font-size:13px; font-weight: bold; margin-top:8px; position: relative; bottom: 0em"> <?= HTML::Encode($comment['date_post']); ?></div>
                               
                                    </div>
                                    
                                    
                                     <div class="clearfix"></div>
                                </div>  
                                </a>
                                   </li>  
                                </ul>
                             
                            </div>     
                      <?php  } ?>
                        </div>
                   <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
<?php $this->registerJsFile('js\Publication.js');
        
        ?>