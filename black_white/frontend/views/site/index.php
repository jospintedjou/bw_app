<?php
/* @var $this yii\web\View */
use linchpinstudios\backstretch\Backstrech;
use yii\helpers\Html;
$this->title = 'Acceuil';
?>
<div class="ba">
   
    
    <?= Backstrech::widget([
                                'clickEvent' => false,
                                'images' => [['image' => 'uploads/Black.jpg']],
                                'options' => ['fade' => 500],
                            ]);
    ?>
    
   
</div>
