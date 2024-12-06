$(document).ready(function() {
  $(".add_bidpackage_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        name:{
          required: true,
        },
        amount:{
          required: true,
        },
        credits:{
          required: true,
          integer: true
        }
      }
      
  });

  $(".edit_bidpackage_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        name:{
          required: true,
        },
        amount:{
          required: true,
        },
        credits:{
          required: true,
          integer: true
        }
      }
      
  });

  });





