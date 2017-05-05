/* 
 * This Js script is loaded on all SEINTRA pages. It updates the menu to tell user how many
 *  publication he has not read.
*/

$(document).ready(function(){
    var mess='', nature='idee';
    /** This function refresh the number of unread publications ((idea, suggestion or the twice) **/
    function refreshMenu(){
       getUnread();   
       getUnreadComments();   
    }
    
    
    
    setInterval(refreshMenu, 2000);
    setTimeout(notifyMe, 2500);
    setInterval(notifyMe, 15000);

    function getUnread(){
        mess = '';
        url = 'index.php?r=publication/publication/unread-publs';
        $.ajax({
          url: url,
          type: 'POST',
          dataType:'json', 
          success: function(data){
                   if(data.nbIdeas != "0" || data.nbSuggs != "0"){
                    if(data.nbIdeas != "0"){
                        $('#nbNewIdeas').text(data.nbIdeas);
                        mess = (data.nbIdeas == "1") ? (data.nbIdeas+" nouvelle idée ") : (data.nbIdeas+" nouvelles idées ") ;
                        nature = 'idee';
                    }
                    if(data.nbSuggs != "0"){
                        $('#nbNewSuggestions').text(data.nbSuggs);
                        if(data.nbIdeas != "0" ){
                           mess += (data.nbSuggs == "1") ? ('et\n' + data.nbSuggs+" nouvelle suggestion ") : ('et\n' + data.nbSuggs+" nouvelles suggestions ") ; 
                        }else{
                            mess = (data.nbSuggs == "1") ? (data.nbSuggs+" nouvelle suggestion ") : (data.nbSuggs+" nouvelles suggestions ") ;
                            nature = 'suggestion';
                        }
                        
                    }
                    if(data.nbPubls != "0"){
                        $('#nbNewPubls').text(data.nbPubls);
                    }
                   // notifyMe(mess);
                  }
                 }
        });
    }
    
    function getUnreadComments(){
        
        mess = '';
        url = 'index.php?r=publication/publication/unread-comments';
        $.ajax({
          url: url,
          type: 'POST',
          dataType:'json', 
          success: function(data){
              //alert(data);
                    if(data.nbComments != "0"){
                        $('#nbNewComments').text(data.nbComments);
                        if(data.nbCommentsIdeas !="0"){
                            $('#nbNewCommentsIdeas').text(data.nbCommentsIdeas);
                             nature = 'idee';
                        }
                        if(data.nbCommentsSuggs !="0"){
                            $('#nbNewCommentsSuggs').text(data.nbCommentsSuggs);
                            $('#suggText').text('Suggest.');
                             nature = 'suggestion';
                        }
                        if(mess == ''){
                            mess = (data.nbComments == "1") ? (data.nbComments+" nouvel avis ") : (data.nbComments+" nouveaux avis ") ;
                        }else{
                            mess += (data.nbComments == "1") ? ('et\n'+ data.nbComments+" nouvel avis ") : ('et\n'+ data.nbComments+" nouveaux avis ") ;
                        }
                    }
          }
      });
    }
    
   document.addEventListener('DOMContentLoaded', function () {
    if (!Notification) {
      alert('Votre navigateur ne suppoorte pas les notifications Desktop. Utilisez Chrome'); 
      return;
    }
  });

    function notifyMe() {
        if(mess != '' ){
            //alert('notif');
            if (Notification.permission !== "granted"){
                Notification.requestPermission();
                var myStack = {"dir1":"down", "dir2":"right", "push":"top"};

                new PNotify({
                        title: "Notification",
                        text:  mess,
                        addclass: "stack-custom",
                        stack: myStack
                    });
                PNotify.prototype.options.styling = "fontawesome";
            }else {
                var notification = new Notification('Notification', {
                  icon: 'uploads/seinova.png',
                  body:  mess,
                  tag : 'notification',
                  dir: 'ltr'
                });
                var audio = new Audio('uploads/glass.mp3');
                audio.play();
                notification.onclick = function () {
                  window.open("index.php?r=publication/publication/view-pubs&nature="+nature);      
                };
                setTimeout(notification.close.bind(notification), 5000);
               // setTimeout(notifyMe, 15000);
            }
        }
    }
    

});
