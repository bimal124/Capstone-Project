$(document).ready(function() {
  $(".add_blockip_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        ip_address:{
          required: true,
        },
        message:{
          required: true,
        }
      }
      
  });

  $(".edit_blockip_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
         ip_address:{
          required: true,
        },
        message:{
          required: true,
        }
      }
      
  });

  });





