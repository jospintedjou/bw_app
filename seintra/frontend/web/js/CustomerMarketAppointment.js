/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    
    // reset form when we click on close button  
    $('.close.closemodal').on('click', function () {
        $('#resetForm.resetForm').trigger('click');
    });
    $('.btn.btn-default').on('click', function () {
        $('#resetForm.resetForm').trigger('click');
    });
    
//    $('.miguel').on('hide.bs.modal', function () {
//        $('#resetForm.resetForm').trigger('click');
//    });
    
    //set disparition off flash message        
    $(".alert-success.alert.fade.in").fadeOut(9000);
    $(".alert-warning.alert.fade.in").fadeOut(9000);
    $(".alert-info.alert.fade.in").fadeOut(9000);
    $(".alert-danger.alert.fade.in").fadeOut(9000);

    // Setup - add a text input to each header cell of datatable
    $('table  thead  .search ').each(function () {
        var title = $(this).text();
        $(this).append('<br><br><input type="text" placeholder="Search ' + title + '" />');
    });

    // DataTable
    var table = $('table').DataTable({
        responsive: true,
        keys: true
    });

    // Apply the search
    table.columns().every(function () {
        var that = this;

        $('input', this.header()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                        .search(this.value)
                        .draw();
            }
        });
    });

});

