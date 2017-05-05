
<!-- ADD ALL TYPE OF MARKET -->


<?php $this->registerCssFile('css/libs/jquery-ui.css') ?>
<?php $this->registerCssFile('css/libs/dataTables.jqueryui.min.css') ?>
<?php $this->registerCssFile('css/CustomerMarketAppointmentPurch.css') ?>

<?php $this->registerJsFile('js/libs/jquery.dataTables.min.js') ?>
<?php $this->registerJsFile('js/libs/dataTables.keyTable.min.js') ?>
<?php $this->registerJsFile('js/libs/dataTables.jqueryui.min.js') ?>
<?php $this->registerJsFile('js/CustomerMarketAppointment.js') ?>

<?php
$this->registerJs("$(function () {
          if ($('#etat_private').val() == 'en_attente')
                $('#privatemarketform-date_reponse-kvdate input').attr('disabled', true);      
         
           
        $('#etat_private').change(function () {
            
            if ($('#etat_private').val() == 'en_attente'){
                $('#privatemarketform-date_reponse-kvdate input').attr('disabled', true);
            
                $('#privatemarketform-date_reponse-kvdate input').val('');
                $('div.form-group.field-privatemarketform-date_reponse.has-error p.help-block-error').html('');
                $('div.form-group.field-privatemarketform-date_reponse.has-error').addClass('has-success');
                $('div.form-group.field-privatemarketform-date_reponse.has-error').removeClass('has-error');
                }
            else
                $('#privatemarketform-date_reponse-kvdate input').removeAttr('disabled');

        });
        
          if ($('#etat_public').val() == 'en_attente')
                $('#publicmarketform-date_reponse-kvdate input').attr('disabled', true);
        $('#etat_public').change(function () {
            if ($('#etat_public').val() == 'en_attente'){
            
                 $('#publicmarketform-date_reponse-kvdate input').attr('disabled', true);
                 $('#publicmarketform-date_reponse-kvdate input').val('');
                $('div.form-group.field-publicmarketform-date_reponse.has-error p.help-block-error').html('');
                $('div.form-group.field-publicmarketform-date_reponse.has-error').addClass('has-success');
                $('div.form-group.field-publicmarketform-date_reponse.has-error').removeClass('has-error');
                }
            else
                 $('#publicmarketform-date_reponse-kvdate input').removeAttr('disabled');

        });
    });"
)
?>

<?php
$this->registerCss('.view_marche_even'
        . '{'
        . 'background-color:#f9f9f9;'
        . 'border: 2px solid #ddd;'
        . 'border-top:none;'
        . '}'
);
$this->registerCss('.view_marche_odd'
        . '{'
        . 'border: 2px solid #ddd;'
        . 'border-top:none;'
        . '};'
);
?>