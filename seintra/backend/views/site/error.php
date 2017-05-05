<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use linchpinstudios\backstretch\Backstrech;

$mess = ereg_replace('[0-9]|#|\(|\)', '', $name);
$code = ereg_replace('[^0-9]', '', $name);

$this->title = 'Error ' . $code;
$this->registerCssFile('css/style.css');
?>
<div class="site-error">
    <div id="error-div" class="text-center">
        <div>
            <h1 class="error-number"><?= Html::encode($code) ?></h1>
            <h2><?= Html::encode($mess) ?></h2>
        </div>

        <div class="alert alert-danger" style="opacity: 0.6">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            The above error occurred while the Web server was processing your request.
        </p>
        <p>
            Please contact us if you think this is a server error. Thank you.
        </p>
    </div>
    
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <?= Backstrech::widget([
                                'clickEvent' => false,
                                'images' => [['image' => 'uploads/seinovaLogo.jpg']],
                                'options' => ['fade' => 500],
                            ]);
    ?>

</div>
