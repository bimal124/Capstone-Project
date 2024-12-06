$(document).ready(function() {
  $(".add_testimonial_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        lang_id:{
          required: true
        },
        winner_name:{
          required: true,
          
        },
        product_name:{
          required: true,
          
        },
        description:{
          required: true,
          
        }
      }
      
  });

  $(".edit_testimonial_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        lang_id:{
          required: true
        },
        winner_name:{
          required: true,
          
        },
        product_name:{
          required: true,
          
        },
        description:{
          required: true,
          
        }
      }
      
  });

  });






