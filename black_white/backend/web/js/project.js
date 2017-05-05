
$(document).ready(function(){
    /** loading div**/
   
    //alert(divLoading.text());
   /** Affichage et masquage des  tâches d'une activité **/	
    $(".taskIcon1").on("click", function() {
        var parent = $(this).parent().parent();
        parent.next().find('.subTasks1').toggle();
        $(this).toggleClass('fa-plus-circle');
        $(this).toggleClass('fa-minus-circle');
    });
   
   /** Fill the modal with task or activity info when .details is clisked**/
   $(".details").on("click", function() {
        var parent = $(this).parents('tr').eq(0),
            pName = parent.find('.projectName'), 
            prov = parent.find('.provider'),
            desc = parent.find('.description'),
            devs = parent.find('.devName'),
            chief = parent.find('.chief'),
            startDate = parent.find('.startDate'),
            endDate = parent.find('.endDate'),
            status = parent.find('.status'),
            count=1;
            if($(this).hasClass('project-details')){
                //alert('a');
                
                $('#modalDetails').find('li').eq(0).find('span.info').text(pName.find('strong').text());
                $('#modalDetails').find('li').eq(1).find('span.info').text(desc.attr('name'));
                $('#modalDetails').find('li').eq(2).find('span.info').text(prov.text());
                $('#modalDetails').find('li').eq(3).find('span.info').eq(0).text(startDate.text());
                $('#modalDetails').find('li').eq(3).find('span.info').eq(1).text(endDate.text());
                $('#modalDetails').find('li').eq(4).find('span.info').text(chief.text());
                $('#modalDetails').find('li').eq(5).find('span.info').text(status.text());
                
                $('#modalDetails ul .devs').remove();
                devs.each(function(){
                    var li = $('<li class="list-group-item devs row"><span style="font-weight:bold" class="col-lg-6">Dev'+count+'</span><span class="info col-lg-6">'+ $(this).text() +'</span></li>');
                    $('#modalDetails .list-group').append(li);
                    count++;
                });
            
            }else{
                //alert('non');
                
                $('#modalDetails').find('td').eq(0).text(pName.find('strong').text());
                $('#modalDetails').find('td').eq(1).text(desc.attr('name'));
                $('#modalDetails').find('td').eq(2).text(prov.text());
                $('#modalDetails').find('td').eq(3).text(startDate.text());
                $('#modalDetails').find('td').eq(4).text(endDate.text());
                $('#modalDetails').find('td').eq(5).text(status.text());
                
                $('#modalDetails table .devs').remove();
                devs.each(function(){
                    var tr = $('<tr class="devs"><th>Dev'+count+'</th><td>'+ $(this).text() +'</td></tr>');
                    $('#modalDetails table').append(tr);
                    count++;
                });
            }
            
            
            
            
           
            
            
        //$('#projectUpdate #devsId').html(allDevs); 
        //$('#projectUpdate #chiefId').html( chiefOpt );
    });
   
    $('#chiefId').parent().hide();
    $('.multiselect').multiselect();
    $('.modalClose').on('click', function(){
        $('.resetForm').trigger('click');
    });

     $('#right_All_1, #right_Selected_1, #left_Selected_1, #left_All_1') .on('click', function(){
               var options='',
               currentDevs = $(' #multiselect_to_1 option') ;
              if( !$.isEmptyObject(currentDevs) ){
                currentDevs.each(function(){
                    var exist = $("#projectUpdate").find('#'+$(this).attr('id'));
                    if(exist !== null){
                        options += "<option value="+$(this).val() +" >"+$(this).text()+"</option>";  
                    }
                   
                });  
            }else{
                options = '<option></option>';
            }
               // alert(options.html());

               $("#projectUpdate #chiefId").html(options);
      });  
     /** Change the create form action when user want to create a new task **/
     $('.addTask').on('click', function(){
         var parent = $(this).parents('tr'),
             activityId = $(this).attr('name');
         $('#projectCreate').attr('action', 'index.php?r=project/project/add-task');
         $('#projectCreate #activityId').val(activityId);
         //$('#modalCreate h4').text('Nouvelle Tâche');
         
     });
      
     /** Fill the update form with activity, task or project details when .editBtn is clicked**/
    $('.editBtn').on('click', function(){
        
        var parent = $(this).parents('tr').eq(0),
            pName = parent.find('.projectName'), 
            prov = parent.find('.provider'),
            allDevs = $('#projectCreate #devsId').html(),
            desc = parent.find('.description'),
            devs = parent.find('.devName'),
            chief = parent.find('.chief'),
            startDate = parent.find('.startDate'),
            endDate = parent.find('.endDate'),
            projectId = $(this).attr('id'),
            activityId = $(this).attr('name'),
            taskId = "",
            status = parent.find('.status').text(),
            chiefOpt = "",
            multiselect = $('.multiselect'),
            devsOpts=""; 
           // activityId = $(this).attr('name')
            /**  Change update form action if it is a task  **/  
            if($(this).hasClass('task')){
                $('#projectUpdate').attr('action', 'index.php?r=project/project/update-task');
                    taskId = $(this).attr('name');
                    activityId = $(this).attr('actId');
            }
           
        $('.multiselect option').show();
        $('#projectUpdate #devsId2').html(allDevs); 
        devs.each(function(){
            var id = $(this).attr('id');
            if( multiselect.has('.multiselect option[value=' + id +']').empty()){
                $('#projectUpdate .multiselect option[value=' + id +']').hide();
            }
                devsOpts += "<option value="+ id + ">" + $(this).text() + "</option>";
        });
        
        $('#projectUpdate #multiselect_to_1').html(devsOpts);
        $("#projectUpdate #chiefId").html(devsOpts);

        chiefOpt = "<option value="+ chief.attr('id') + ">" + chief.text() + "</option>" ;
        $('#projectUpdate #titleId').val( pName.find('strong').text() ) ;
        $('#projectUpdate #provId').val( prov.text() ) ;
        $('#projectUpdate #descId').val( desc.attr('name') );
        //$('#projectUpdate #devsId').html(allDevs); 
        //$('#projectUpdate #chiefId').html( chiefOpt );
        //$('#projectUpdate #startDateId').val( startDate.text());
        //$('#projectUpdate #endDateId').val( endDate.text());
        if(status == 'en cours'){
            $('#projectUpdate input[name1=startDateId2]').parents('.form-group').eq(0).hide();
        }
        $('#projectUpdate input[name1=startDateId2]').val(startDate.text());
        $('#projectUpdate input[name1=endDateId2]').val( endDate.text());
        $('#projectUpdate #projectId').val(projectId);
        $('#projectUpdate #activityId').val(activityId);
        $('#projectUpdate #taskId').val(taskId);

     }); 
     
     /** Ajax call to notify project task or activity end 
      * @param  $type project, activity or task
      * @param $id the id
      * @param parent the tr element, parent of the concerned td
      * **/
     function notifyEnd($type, $id, parent){
         var url ;
         var divLoading = $("<div style='position:fixed; top:30%; left:65%; display:none'><img src='uploads/ajax-loader.gif' />  </div> ");
        $('body').append(divLoading);
         $(divLoading).show();
         switch($type){
            case 'project': url='index.php?r=project/project/notify-end-project&projectId='+$id;
                            break;
            case 'activity': url='index.php?r=project/project/notify-end-activity&activityId='+$id;
                            break;
            case 'task': url='index.php?r=project/project/notify-end-task&taskId='+$id;
                            break;
            default: url=' '; break;
         }
         
        $.ajax({
           url: url,
           type: 'POST',
           dataType:'json',
           success: function(data){
              // alert(data.status);
              if(data.status === 'true'){
               parent.find('.status').text('terminé non validé').attr('class', 'status btn btn-round btn-xs btn-warning');
               parent.find('.btn-validate').removeAttr('disabled');

                parent.next().find('.subTasks1 .editBtn').each(function(){
                                $(this).attr('disabled', true);
                            });           
              
                parent.next().find('.subTasks1 .btn-validate').each(function(){
                    $(this).removeAttr('disabled'); 
                });
                parent.next().find('.subTasks1 .notify-end').each(function(){           
                        $(this).attr('disabled', true);  
                });
                parent.next().find('.subTasks1 .status').each(function(){ 
                    if( $(this).text() !== 'terminé' ){
                        $(this).text('terminé non validé').attr('class', 'status btn btn-round btn-xs btn-warning'); 
                    }
                });
               $(divLoading).hide();
             }
           } 
            
        });
     }
        
 
     /** Ajax call to notify project task or activity end 
      * @param  $type project, activity or task
      * @param $id the id
      * @param parent the tr element, parent of the concerned td
      * @param $validated string true when accepting project end, false otherwhise
      * **/
    function validateEnd($type, $id, parent, $validated){
        var url;
         var divLoading = $("<div style='position:fixed; top:30%; left:65%; display:none'><img src='uploads/ajax-loader.gif' />  </div> ");
        $('body').append(divLoading);
         $(divLoading).show();
        $('#divLoading').show();
        switch($type){
           case 'project': url='index.php?r=project/project/validate-end-project&projectId='+$id+'&validated='+$validated;
                           break;
           case 'activity': url='index.php?r=project/project/validate-end-activity&activityId='+$id+'&validated='+$validated;
                           break;
           case 'task': url='index.php?r=project/project/validate-end-task&taskId='+$id+'&validated='+$validated;
                           break;
           default: url=' '; break;
        }
       $.ajax({
          url: url,
          type: 'POST',
          dataType:'json',
          success: function(data){
             // alert(data.status);
             if(data.status === 'true'){
                 if($validated === 'true'){
                    parent.find('.status').text('terminé').attr('class', 'status btn btn-round btn-xs btn-success'); 
                    parent.find('.editBtn').attr('disabled', true);
                    parent.next().find('.subTasks1 .status').text('terminé').attr('class', 'status btn btn-round btn-xs btn-success'); 
                    parent.next().find('.subTasks1 .editBtn').attr('disabled', true);
                    parent.next().find('.subTasks1 .notify-end').attr('disabled', true);
                    parent.next().find('.subTasks1 .btn-validate').attr('disabled', true);
                 }else{
                     parent.find('.status').text('en cours').attr('class', 'status btn btn-round btn-xs btn-info');
                     parent.find('.editBtn').attr('disabled', false);
                     parent.next().find('.subTasks1 .status').each(function(){  
                       if($(this).text() !== 'terminé'){
                         $(this).text('en cours')
                               .attr('class', 'status btn btn-round btn-xs btn-info');
                        }
                    });
                     parent.next().find('.subTasks1 .editBtn').attr('disabled', false);
                     parent.next().find('.subTasks1 .notify-end').attr('disabled', false);
                     parent.next().find('.subTasks1 .btn-validate').attr('disabled', true);
                 }
              $(divLoading).hide();
            }
          } 
       });
    }
     
     $('.notify-end').on('click', function(){
         
         var parent = $(this).parents('tr').eq(0),
             editBtn = parent.find('.editBtn'),
             status = parent.find('.status').text(),
             info = activityInfo(editBtn),
             id = info.id,
             type = info.type;
         
             if(status==="en cours" || status==="en attente" ){
                 //alert(type);
                notifyEnd(type, id, parent);
             }else{
               showAlert('btn-danger');              
             }
     });
    $('.accept-end').on('click', function(){
       //alert('cool');
       var parent = $(this).parents('tr').eq(0),
           status = parent.find('.status').text(),
           editBtn = parent.find('.editBtn'),
           info = activityInfo(editBtn),
           id = info.id,
           type = info.type;

           if(status==="terminé non validé"){
               validateEnd(type, id, parent, 'true');
           }else{
             showAlert('btn-danger');           
           }       
    });
     
     $('.avoid-end').on('click', function(){
        // alert('cool');
        var parent = $(this).parents('tr').eq(0),
            status = parent.find('.status').text(),
            editBtn = parent.find('.editBtn'),
            info = activityInfo(editBtn),
            id = info.id,
            type = info.type;
            
            if( status === "terminé non validé" || status === "terminé" ){
                validateEnd(type, id, parent, 'false');
                parent.find('.notify-end').removeAttr('disabled');
            }else{
               showAlert('btn-danger');           
            }  
            
     });
     
     /** The following function return the activity type and id 
      * @param editBtn JSobject  the edit button
      * @return JSobject a javascript object containing activity typr and id
      * **/
     function activityInfo(editBtn){
         var res = '',
             attrId = editBtn.attr('id'),
             attrName = editBtn.attr('name');
        if(editBtn.hasClass('activity')){
             res = {'id':attrName, 'type': 'activity'};
         }else if(editBtn.hasClass('task')){
              res = { 'id' : attrName, 'type' : 'task' };
         }else if(editBtn.hasClass('project')){
              res = { 'id': attrId,'type' : 'project'};
         }
           return res;
     }
     
     /** The following function displays an alert message 
      * @param $alertClass  the message type; 'success', 'failed' 
      * **/
     function showAlert($alertClass){
      var closeBtn =  $('<span><a href="#" style="color: white; font-weight: bold" class="close" data-dismiss="alert" aria-label="close">&times;</a></span>'),
          alertDiv = $("<div class='alert "+$alertClass+"' style='z-index:1000;position:fixed; top:50%; left:50%'> Echec, l'état actuel du projet ne correspond pas!!</div>");

        alertDiv.prepend(closeBtn);
        $('.right_col').prepend(alertDiv);
        alertDiv.fadeOut(9000);
    }
    
});