$(document).ready(function(){

    $('body').on('click','button.button',function(event){
           
           var id = event.target.id;
           var searchBy = $(this).val();
          
            
           $(".button").html('Loading...');

           $.ajax({
                 
                  url: 'getdatabyajax.php',
                  method: 'POST',
                  data: {id:id,searchBy:searchBy},
                  dataType: 'Text',
                  success: function(data){
                     
                     if(data != '')
                     {
                        
                        $('.button').remove();
                        $('#searchvaluescontainer').append(data);  

                     }
                     else 
                     {
                         //$('.button').remove();
                     }

                  }


           });
    });

});