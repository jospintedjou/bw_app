<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'Comptes';
$this->registerCssFile('css/style.css');
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php Pjax::begin(['id' => 'pjax-box']);?>
            <div class="page-title">
                <center>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="color: #000000;">
                        <h4 style="color: #0099ff; font-weight: bold;">List of accounts</h4>
                    </div>
                </center>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                    <div class="row">
                        <label class="col-lg-2 col-md-3 col-sm-3 col-xs-4 control-label">Sort by:</label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                               <select class="form-control" id="critere" name="critere" value="#">
                                <option value="ADMIN">Administrateur</option>
                                <option value="ALL" selected="">Tous</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <center>
                        <button style="margin-bottom: 3%; margin-top: 3%;" type="button" id="createBtn" class="btn btn-primary btn-sm btn-xs" data-toggle="modal" data-target="#createModal">
                            <span class="glyphicon glyphicon-plus"></span> New account
                        </button>
                    </center>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel" style="min-height: 74vh; width: 84%; margin-left: 8%">
                        <div class="x_content">
                            <div class="row" id="account_container">
                                <div></div>
                                <div></div>
                                
                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong>Développeur</strong></h4>
                                                <div class="left col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>Nguemkam yvan</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>yvan</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>yvan.guemkam@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-lg-4 col-md-4 col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs updateBtn" data-toggle="modal" data-target="#updateModal" value="#" style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-xs deleteBtn" value="#">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-primary btn-xs resetBtn" value=" " disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#changerPassModal" type="button" class="changePWDBtn btn btn-primary btn-xs" value="2">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong>Développeur</strong></h4>
                                                <div class="left col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>Nguemkam yvan</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>yvan</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>yvan.guemkam@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-lg-4 col-md-4 col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs updateBtn" data-toggle="modal" data-target="#updateModal" value="#" style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-xs deleteBtn" value="#">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-primary btn-xs resetBtn" value=" " disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#changerPassModal" type="button" class="changePWDBtn btn btn-primary btn-xs" value="2">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong>Développeur</strong></h4>
                                                <div class="left col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>Nguemkam yvan</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>yvan</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>yvan.guemkam@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-lg-4 col-md-4 col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs updateBtn" data-toggle="modal" data-target="#updateModal" value="#" style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-xs deleteBtn" value="#">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-primary btn-xs resetBtn" value=" " disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#changerPassModal" type="button" class="changePWDBtn btn btn-primary btn-xs" value="2">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong>Développeur</strong></h4>
                                                <div class="left col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>ngauss erick</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>erick</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>erick.ngauss@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button type="button" data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-xs updateBtn" value="" style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-xs deleteBtn" value=" ">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs resetBtn" value="/Seintra/trunk/seintra/backend/web/index.php?r=site%2Frequest-password-reset&amp;idAccount=3" disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button"  data-toggle="modal" data-target="#changerPassModal" class="changePWDBtn btn btn-primary btn-xs" value="3">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong>Directeur  Technique</strong></h4>
                                                <div class="left col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>Tchomobe Patrick</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>patrick</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>patrick.tchomobe@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs updateBtn" value=" " style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-danger btn-xs deleteBtn" value=" ">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs resetBtn" value="/Seintra/trunk/seintra/backend/web/index.php?r=site%2Frequest-password-reset&amp;idAccount=4" disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" class="changePWDBtn btn btn-primary btn-xs" value="4">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong>Développeur</strong></h4>
                                                <div class="left col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>Tedjou Jospin</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>jospin</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>jospin.tedjou@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs updateBtn" value=" " style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-danger btn-xs deleteBtn" value=" ">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs resetBtn" value="/Seintra/trunk/seintra/backend/web/index.php?r=site%2Frequest-password-reset&amp;idAccount=5" disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" class="changePWDBtn btn btn-primary btn-xs" value="5">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong>Développeur</strong></h4>
                                                <div class="left col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>Junior junior</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>junior</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>junior.toto@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs updateBtn" value=" " style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-danger btn-xs deleteBtn" value=" " style="margin-bottom: 4%;">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs resetBtn" value="/Seintra/trunk/seintra/backend/web/index.php?r=site%2Frequest-password-reset&amp;idAccount=8" disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" class="changePWDBtn btn btn-primary btn-xs" value="8">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong><i>Secrétaire du DT</i></strong></h4>
                                                <div class="left col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>Ngnegnang Rita</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>rita</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>rita.ngnegnang@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs updateBtn" value=" " style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-danger btn-xs deleteBtn" value="">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button type="button" class="btn btn-primary btn-xs resetBtn" value="/Seintra/trunk/seintra/backend/web/index.php?r=site%2Frequest-password-reset&amp;idAccount=9" disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button type="button" class="changePWDBtn btn btn-primary btn-xs" value="9">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-sm-4  profile_details DEV">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief" style="color: #0099ff;"><strong>Développeur</strong></h4>
                                                <div class="left col-xs-8">
                                                    <div min-height="200px">
                                                        <h4><strong>Kamdem Pascal</strong></h4>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-user"></i> <strong>Username: </strong> <i>miguel</i></li>
                                                            <li><i class="fa fa-envelope"></i> <strong>Email: </strong> <i>miguel.kamdem@seinova.com</i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right col-xs-4 text-center">
                                                    <img src="images/user.png" alt="photo de profil" class="img-circle" width="100%" height="80em">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center container-fluid">
                                                <div class="col-xs-12 emphasis container-fluid">
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-primary btn-xs updateBtn" value="" style="margin-bottom: 4%;">Edit</button></div>
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#deleteModal" type="button" class="btn btn-danger btn-xs deleteBtn" value="/Seintra/trunk/seintra/backend/web/index.php?r=site%2Fdelete&amp;idAccount=10">Delete</button></div>
                                                </div>
                                                <div class="col-xs-12 emphasis container-fluid  ">
                                                    <div class="col-xs-6 text-center"><button  type="button" class="btn btn-primary btn-xs resetBtn" value="/Seintra/trunk/seintra/backend/web/index.php?r=site%2Frequest-password-reset&amp;idAccount=10" disabled="disabled">Reset Password</button></div>
                                                    <div class="col-xs-6 text-center"><button data-toggle="modal" data-target="#changerPassModal" type="button" class="changePWDBtn btn btn-primary btn-xs" value="10">Edit Password</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php Pjax::end();?>
    </div>
</div>
<!-- /page content -->