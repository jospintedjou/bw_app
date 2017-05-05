$(document).ready(function() {
   $(document).on('click','.fc-day',function(){
       var date = $this->attr('data-date');
       $('#modal').modal(show)
               .find('#modalContent')
               .load($this->attr('value'));
            
   });
   // creation de button au clique
   
   $('#modalButton').click(function(){ 
       $('#modal').modal(show)
               .find('#modalContent')
               .load($this->attr('value'));
       
   });
});

