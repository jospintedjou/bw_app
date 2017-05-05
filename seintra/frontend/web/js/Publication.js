
    $(document).ready(function () {
        
        $('.pub_content').popover({ 'trigger': 'hover' });
        
        $('#btn_submit').attr('disabled', true);
        $('#contenu').keyup(function () {
            if ($(this).val().length != 0)
                $('#btn_submit').attr('disabled', false);
            else
                $('#btn_submit').attr('disabled', true);
        });
	
    });
