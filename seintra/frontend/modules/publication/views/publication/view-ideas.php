<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Idees';
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Idées <small>consulter et envoyer vos idées</small></h3>
            </div>           
        </div>



        <div class="row">
            <div class="col-md-12">


                <div class="x_content">


                    <div class="x_panel">
                        <div class="x_title">
                            <h4>veuillez entrer vos Idées ici</h4>
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
                                <?= $form->field($model, 'type')->hiddenInput(['value'=>'idee', 'maxlength' => 15, 'class' => 'form-control'])->label(false) ?>                          
                            <?= Html::submitButton('Envoyer', ['class' => 'btn btn-primary btn lg', 'id' => 'btn_submit']) ?>

                            <?php ActiveForm::end(); ?>
                            <!-- end form for validations -->
                        </div>
                    </div>
                    <!--   </div> -->
                    <?php if (empty($publications)) { ?>

                        <?php
                        echo "<div class='alert alert-success' style='text-align: center'><strong>AUNCUNE IDEE PUBLIEE!!!!!!!!!</strong></div>";
                    } else {
                        foreach ($publications as $idee) {  ?>
                            <div style="background-color: white; padding:5px">
                                <ul id="menu1" class="list-unstyled msg_list" >
                                    <li>
                                       <a href="<?= Url::toRoute(['publication/view-comments' ,'publicationId' => $idee['id_publ']] ) ?>">
                                            <span class="image">
                                             <img src="<?='../../backend/web/uploads/'.$idee['nom_fich'] ?>" alt="Profile Image" />                             
                                            </span>
                                           
                                            <span>
                                                    <span><?= ($idee['id_user'] == Yii::$app->user->identity->id) ? 'VOUS' : HTML::Encode($idee['prenom']);  ?> </span>
                                                <span class="time" style="position: absolute; right:50px"> <?= HTML::Encode($idee['date_post']); ?></span>
                                            </span>
                                            <span class="message" style="font-size: small;" >
                                                <?= HTML::Encode($idee['contenu']); ?>
                                            </span>
                                            
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
<div align="left"><?= LinkPager::widget(['pagination' => $pagination]) ?></div>
<?php $this->registerJsFile('js\Publication.js')?>