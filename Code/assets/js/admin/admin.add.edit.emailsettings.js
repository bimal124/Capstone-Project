$(document).ready(function() {
  $(".email_settings_add_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        lang:{
          required: true,
        },
        subject:{
          required: true,
        },
        content:{
          required: true,
        }
      }
      
  });

  });





