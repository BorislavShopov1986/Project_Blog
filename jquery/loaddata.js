$(document).ready(function(){

    $('body').on('click','button.button',function(event){
           
           var id = event.target.id;
           var category = $(this).val();
            
           $(".button").html('Loading...');

           $.ajax({
                 
                  url: 'getdata.php',
                  method: 'POST',
                  data: {id:id,category:category},
                  dataType: 'Text',
                  success: function(data){
                     
                     if(data != '')
                     {
                        
                        $('.button').remove();
                        $('#last').append(data);  

                     }
                     else 
                     {
                         $('.button').remove();
                     }

                  }


           });
    });

});