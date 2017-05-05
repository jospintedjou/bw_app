

/** 
 * 
 * Script for order products to wareHouse page
 * 
 */

$(document).ready(function(){
    var $sessionKeys = [],//session key got by ajax call
        keys =[], //selected rows on page
        $total = $('div.totalItems').attr('id');
    onChangePage();
    onResetPList();
    onCheckRow();
    onCheckAll();
    resetPList();
    onSave();
    disableTouchSpin();
    
    $(document).on('pjax:complete', function() {
        //alert('hello');
        onChangePage();
        onResetPList();
        onCheckRow();
        onCheckAll();
        onSave();
        disableTouchSpin();
        
         var $i=0, $str=""; 
        for($i=0; $i < $total; $i++){
            var $id = $sessionKeys.keyList[$i]['id'],
                  $nb = $sessionKeys.keyList[$i]['nb'],
                  $row = '';
            $str += $i + "->" + $id + '-' + $nb + "====== ";
            //$('.kv-grid-hide').children('input[value=' + $id + ']').show();
            $('.kv-tabform-row').find('td.kv-grid-hide input')
                        .each(function(){ 
                                //console.log($(this).text());
                            var $qteCmdeInput = $(this).parent().closest('tr').find('input[type="text"]');
                            if($(this).val() == $id && $nb != ''){ 
                                $(this).parent().closest('tr').find('.kv-row-checkbox')
                                        .attr('checked', 'checked');
                                $(this).parent().closest('tr').addClass('info');
                                $qteCmdeInput.removeAttr('disabled');
                                $(this).parent().closest('tr').find('input[type="text"]').val($nb);
                            }
                        });
            
            
        }
        //toastr.success($str);
    });
    
    /** This function save checked products keys and the number entered in session with **/
    function onChangePage(){
        $('ul.pagination>li').click(function(elt) {
            
            /** returns an array of pkeys, and #grid is your grid element id **/
            if(!$(this).is(".next") && !$(this).is(".prev")){
                updateKeysArray();
                    
                $.post({
                   url: 'index.php?r=/stocks/branch-stock/register-checked', // your controller action
                   dataType: 'json',
                   data: {keyList:keys, total: $total},
                   success: function(data) {
                      if (data.status === 'success') {
                          $sessionKeys= data;
                          //toastr.info('page ');

                      }
                    }
                });
                /** Reloads the page**/
                //var url = window.location.href,
                //  arr = url.split('&');
                //window.location.href =  arr[0].toString() + '&page='+$page;
            }
        });
    }
    
    /** This function save checked products on current page in session and then save session data in database **/
    function onSave(){
        $('#saveChecked').on('click', function(btn){ 
            var $valid = true;
            btn.preventDefault();
            updateKeysArray();
            $('input[type="text"]:enabled').each(function(){
                var $val = $(this).val();
                    if( $val === "0" && $valid){
                        $valid = false;
                        toastr.error('Vous devez entrer une quantité valide.');
                    }
            });
            if($valid){
                $.post({
                    url: 'index.php?r=/stocks/branch-stock/save-order', // your controller action
                    dataType: 'json',
                    data: {keyList:keys, total: $total},
                    success: function(data) {
                       if (data.status === 'success') {
                           toastr.success('Commande envoyée !');
                           pageReload();
                       }
                     },
                     error: function(err){
                         toastr.error('Un probléme est survenu lors de l\'envoie des données');
                         toastr.options = {"showDuration": "800"};
                     }
                });
            }
        });
    }
    
    /** Reloads the page**/
    function pageReload(){
        var url = window.location.href,
            arr = url.split('&');
            window.location.href =  arr[0].toString() + '&page='+1; 
    }
    
    /** This function put checked products in kays array **/
    function updateKeysArray(){
        /** Fills in the keys array **/
        $('#products-list').find(".kv-row-checkbox").each(function () {
            var $k = $(this).parent().closest('tr').find('td:first').text(),
                $nb = $(this).parent().closest('tr').find('input[type="text"]').val(),
                $id = $(this).parent().closest('tr').find('td.kv-grid-hide>input').val();

                keys[$k-1] = {"id": $id, "nb": $nb};
        });
    }
    
    /** This function reset the product list and reset the session **/
    function onResetPList(){
        $('#resetPList').on("click", function(e){
            //e.preventDefault();
            $('.kv-tabform-row.info').removeClass('info');
            $(".kv-row-checkbox:checked").removeAttr('checked');
            $(".select-on-check-all:checked").removeAttr('checked');
            $('input[type="text"]').val('').attr('disabled', 'disabled');
            resetPList(true);
        });
    }
    /** Ajax call to reset checked product in session **/
    function resetPList($pageRefresh=false){
        $.post({
                url: 'index.php?r=/stocks/branch-stock/reset-checked',
                dataType: 'json',
                success: function(data) {
                      if (data.status === 'success') {
                          //toastr.success('opération réussie !');
                          if($pageRefresh === true){
                          /** Reloads the page**/
                            var url = window.location.href,
                            arr = url.split('&');
                            window.location.href =  url;
                          }
                      }
                }
            });
    }
    
    /** This function disables/enables number input on checkbox click**/
    function onCheckRow(){
        $(".kv-row-checkbox").change(function(elt){
            var $qteCmdeInput = $(this).parent().closest('tr').find('input[type="text"]'),
                $checkBox = $(this).parent().closest('tr').find('checkbox'),
                $k = $(this).parent().closest('tr').find('td:first').text();
                if($qteCmdeInput.attr('disabled')){
                    $qteCmdeInput.removeAttr('disabled');
                    $qteCmdeInput.focus();
                    $qteCmdeInput.on('blur', function(){
                        //alert($checkBox);
                        if( !$(this).val() ){
                            if($checkBox.attr('checked')!== "undefined"){
                                toastr.error('Vous devez entrer la quantité à commander.');
                                toastr.options = {"showDuration": "800", "preventDuplicates": true};
                                $qteCmdeInput.focus();
                            }
                                
                        }
                    });
                }else{
                    $qteCmdeInput.attr('disabled', 'disabled');
                    $qteCmdeInput.val('');
                    keys[$k-1] = {"id":"", "nb":""};
                    
                }
        });
    }
    /** Disable input touchspin **/
    function disableTouchSpin(){
        $('input[data-krajee-touchspin]').attr('disabled', 'disabled');
    }
    /** This function disables/enables number input on checkbox click**/
    function onCheckAll(){
        $(".select-on-check-all").change(function(){
            var $qteCmdeInput = $('input[type="text"]');
                if($qteCmdeInput.attr('disabled')){
                    $qteCmdeInput.removeAttr('disabled');
                }else{
                    $qteCmdeInput.attr('disabled', 'disabled');
                }
        });
    }
});

