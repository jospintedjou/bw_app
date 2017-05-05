<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->title = $type;
$this->registerCss('span.comment{font-size:14px; font-weight: bold;  position: relative; bottom: 0em}'); 
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= ucfirst($type) ?> <small>consulter et envoyer vos <?= $type ?> </small></h3>
            </div>            
        </div>

        
        
        <div class="row">
            <div class="col-md-12">

                <div class="x_content">

                    <div class="x_panel">
                        <div class="x_title">
                            <h4>veuillez entrer vos <?= $type ?> ici</h4>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <!-- start form for validation -->
                            <?php $form = ActiveForm::begin(['action' => Url::toRoute('publication/add')]); ?>
                            <p style="padding: 5px;">

                                <?= $form->field($model, 'contenu', ['inputOptions' => ['id' => 'contenu']])->textarea(['class' => 'form-control'])->label('Message:') ?>
                                <?= $form->field($model, 'type')->hiddenInput(['maxlength' => 15, 'class' => 'form-control'])->label(false) ?>                          
                            <?= Html::submitButton('Envoyer', ['class' => 'btn btn-primary btn lg', 'id' => 'btn_submit']) ?>

                            <?php ActiveForm::end(); ?>
                            <!-- end form for validations -->

                        </div>
                    </div>

                    <!--   </div> -->                 
                    <?php if (empty($publications)) { ?>

                        <?php
                        echo "<div class='alert alert-success' style='text-align: center'><strong>AUNCUN CONTENU A AFFICHER</strong></div>";
                    } else { ?>
                    <div class='col-lg-11 col-lg-offset-0' style="">
                      <?php  foreach ($publications as $pub) { ?>
                            <div class='row' style="padding:0px; margin:0px; box-sizing: border-box">

                          <ul id="menu1" class="list-unstyled msg_list"  >
                               <li style=' background-color: white;; border:0px solid grey; border-radius: 5px;font-family: "Open Sans , sans-serif";'>
                               
                              <div class="col-lg-1">

                                  <div class="avatar">
                                      <span  <span class="image">
                                          <img src="<?='../../backend/web/uploads/'.$pub['nom_fich'] ?>" alt="Profile Image" />
                                      </span>
                                   </div>
                                  <div class="icons">

                                  </div>

                                  <span>
                                      <span><?= ($pub['id_user'] == Yii::$app->user->identity->id) ? 'VOUS' : HTML::Encode($pub['prenom']);  ?> </span>
                                  </span>

                                  <div class="clearfix"></div>
                              </div>
                               <a class='pub_content' data-trigger="manual" data-title='Note' data-toggle='popover' data-content="Cliquer pour ajouter ou voir les commentaires " href="<?= Url::toRoute(['publication/view-comments' ,'publicationId' => $pub['id_publ'],'nature'=> $nature ] ) ?>">
                          <div class="col-lg-9 " style="color:#215348; background-color: #d7edfc; width:100%;padding: 0px; margin:0px 0px 0px 0px">
                                      <div class="message" style=" margin:10px; font-size:18px; font-weight: 500; line-height: 1.4;" >
                                          <?= HTML::Encode($pub['contenu']); ?>
                                      </div>  
                              <div class='row' style=' min-width:30em;'>
                               <?php if($pub['nb'] != 0){ ?>
                                  
                                 <div class="col-lg-5 col-lg-offset-1"> <button class="btn btn-xs btn-primary ">Avis <span class="comment badge"> <?= HTML::Encode($pub['nb']); ?> </span>
                                 </button>
                                     <?php  if($pub['non_lus'] != 0){ ?>
                                         non lus <span class=" badge" style="background-color:orange"> <?= HTML::Encode($pub['non_lus']); ?>  </span>
                                 <?php } ?>
                                     
                                 </div>
                               <?php } ?>
                               <div class=" col-lg-offset-5" style="min-width:10em; font-size:13px; font-weight: bold; margin-top:8px; position: relative; bottom: 0em"> <?= HTML::Encode($pub['date_post']); ?></div>
                              </div>
                               <div class="clearfix"></div>
                          </div> 
                         </a>
                             </li>  
                          </ul>

                      </div> 
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
<?php //$this->registerJsFile('js\libs\bootstrap.min.js') ?>
<?php $this->registerJsFile('js\Publication.js') ?>