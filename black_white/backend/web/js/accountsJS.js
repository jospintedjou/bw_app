var detach = [];

$(document).on('ready pjax:success', function(){
    $('#createBtn').click(function(){
        $('#createModal').modal('show');
    });
    
    
    $('.changePWDBtn').click(function(){
        $('#idUserChangePass').attr('value', $(this).attr('value'));
        $('#changePassModal').modal('show');
    });

    
    $('.deleteBtn').click(function(){
        $('#deleteModal').modal('show');
    });
    
    // pour modifier le critere de tri
    $('#critere').on('change', function(){
        var sel = $('#critere option:selected').val();
        if (sel == 'ALL'){
            $.each(detach, function(i, v) { $('#account_container').append(v); });
            detach = [];
        }else{
            $.each(detach, function(i, v) { $('#account_container').append(v); });
            detach = [];
            var attach = [];
            attach.push($('.'+sel+'').detach());
            detach.push($('.profile_details').detach());
            $.each(attach, function(i, v) { $('#account_container').append(v); });
        }
    });
    
    // pour pré-remplir les champs du formulaire de mise à jour
    $('.updateBtn').on('click', function(){
        $.ajax({
            url: $(this).attr('value'),
            type: 'post',
            dataType: 'json',
            success: function(response){
                $('#nameUpdate').attr('value', response.name);
                $('#surnameUpdate').attr('value', response.surname);
                $('#usernameUpdate').attr('value', response.username);
                $('#emailUpdate').attr('value', response.email);
                if (response.sex){
                    $('#sexeUpdate option[value='+response.sex+']').prop('selected', true);
                }
                $('#phoneNumberUpdate').attr('value', response.phoneNumber);
                $('#idUserUpdate').attr('value', response.idUser);
                $('#roleUpdate option[value='+response.role+']').prop('selected', true);
            }
        });
        $('#updateModal').modal('show');
    });

    
    // pour le reset du mot de passe a partir de l'email de l'admin connecté
    $('.resetBtn').click(function(){
        var str = '<div style="position: fixed; top: 0; bottom: 0; left: 0; right: 0; display:none">'
                    +'<div style="position: absolute; width: 50px; height: 50px; top:0; bottom:0; left:0; right: 0; margin: auto">'
                        +'<img src="uploads/ajax-loader.gif" width="50" height="50"/>'
                    +'</div>'  
                 +'</div>';
        var divLoading = $(str);
        $('body').append(divLoading);
        $(divLoading).show();
        
        $.ajax({
            url: $(this).attr('value'),
            type: 'post',
            success: function(response){
                $(divLoading).detach();
                if (response.success){
                    $.pjax.reload({container: '#pjax-box'});
                }
                $.notify(response.growl, response.options);
            }
        });
    });
    
    
     // Pour mettre l'url souhaitee dans l'attribut 'value' du bouton de confirmation de suppression
    $('.deleteBtn').click(function(){
        $('#idUserDelete').attr('value', $(this).attr('value'));
    });
    
    // Pour reset la modale de modification sur l'evenement hide.
    $('#resetFormUpdateBtn').click(function(){
        $('#nameUpdate').removeAttr('value');
        $('#surnameUpdate').removeAttr('value');
        $('#usernameUpdate').removeAttr('value');
        $('#emailUpdate').removeAttr('value');
        $('#phoneNumberUpdate').removeAttr('value');
        $('#idUserUpdate').removeAttr('value');
    });
});



$(function(){
    
    // Pour creer un nouveau compte
    $('#createAccount-form').on('beforeSubmit', function(e){
        e.preventDefault();
        var $form = $(this);
        var formdata = (window.FormData)? new FormData($form[0]): null;
        var data = (formdata !== null)? formdata : $form.serialize();
        $('#createModal').modal('hide');
        
        $.ajax({
            url: $form.attr('action'),
            type: 'post',
            contentType: false,
            processData: false,
            dataType: 'json',
            data: data,
            success: function(response){
                if (response.success){
                    $.pjax.reload({container: '#pjax-box'});
                }
                $.notify(response.growl, response.options);
            }
        });
        return false;
    });
    
    // Pour mettre un compte à jour
    $('#updateAccount-form').on('beforeSubmit', function(e){
        e.preventDefault();
        var $form = $(this);
        var formdata = (window.FormData)? new FormData($form[0]): null;
        var data = (formdata !== null)? formdata : $form.serialize();
        $('#updateModal').modal('hide');
        
        $.ajax({
            url: $form.attr('action'),
            type: 'post',
            contentType: false,
            processData: false,
            dataType: 'json',
            data: data,
            success: function(response){
                if (response.success){
                    $.pjax.reload({container: '#pjax-box'});
                }
                $.notify(response.growl, response.options);
            }
        });
        return false;
    });
    
    
    // pour supprimer un compte utilisateur
    $('#deleteAccount-form').on('beforeSubmit', function(e){
        e.preventDefault();
        var $form = $(this);
        var formdata = (window.FormData)? new FormData($form[0]): null;
        var data = (formdata !== null)? formdata : $form.serialize();
        $('#deleteModal').modal('hide');
        
        $.ajax({
            url: $form.attr('action'),
            type: 'post',
            contentType: false,
            processData: false,
            dataType: 'json',
            data: data,
            success: function(response){
                if (response.success){
                    $.pjax.reload({container: '#pjax-box'});
                }
                $.notify(response.growl, response.options);
            }
        });
        return false;
    });
    
    
    // Pour changer le mot de passe d'un compte
    $('#changePassword-form').on('beforeSubmit', function(e){
        e.preventDefault();
        var $form = $(this);
        var data = $form.serialize();
        var str = '<div style="position: fixed; top: 0; bottom: 0; left: 0; right: 0; display:none">'
                    +'<div style="position: absolute; width: 50px; height: 50px; top:0; bottom:0; left:0; right: 0; margin: auto">'
                        +'<img src="uploads/ajax-loader.gif" width="50" height="50"/>'
                    +'</div>'  
                 +'</div>';
        var divLoading = $(str);
        $('#changePassModal').modal('hide');
        $('body').append(divLoading);
        $(divLoading).show();
        
        $.ajax({
            url: $form.attr('action'),
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(response){
                $(divLoading).detach();
                if (response.success){
                    $.pjax.reload({container: '#pjax-box'});
                }
                $.notify(response.growl, response.options);
            }
        });
        return false;
    });
    
    
    // Pour reset le formulaire apres la fermetture de la modale de creation
    $('#createModal').on('hide.bs.modal', function(){
        $('#resetFormCreateBtn').trigger('click');
        //$('#image_preview').find('button[type="button"]').trigger('click');
    });
    
    
    // Pour reset le formulaire apres la fermetture de la modale d'edition
    $('#updateModal').on('hide.bs.modal', function(){
        $('#resetFormUpdateBtn').trigger('click');
        //$('#image_preview_up').find('button[type="button"]').trigger('click');
    });
    
    
    // Pour reset le formulaire apres la fermetture de la modale de changement de mot de passe
    $('#changePassModal').on('hide.bs.modal', function(){
        $('#resetFormChangeBtn').trigger('click');
    });
    
    
    // Pour reset le formulaire apres la fermetture de la modale de changement de photo de profil
    $('#changePhotoModal').on('hide.bs.modal', function(){
        $('#resetFormChangePhotoBtn').trigger('click');
    });
    
    // Pour changer la photo de profil
    $('#changePhotoBtn').on('click', function(){
        $('#changePhotoModal').modal('hide');
        var data = {"name": $('.photo_field').attr('value'), "idUser": $('#idUserChangePhoto').attr('value')};
        
        $.ajax({
            url: $(this).attr('value'),
            type: 'post',
            dataType: 'json',
            data: {param: JSON.stringify(data)},
            success: function(response){
                if (response.success){
                    $.pjax.reload({container: '#pjax-zone'});
                }
                $.notify(response.growl, response.options);
            }
        });
        return false;
    });
});

