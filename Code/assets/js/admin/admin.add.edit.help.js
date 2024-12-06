$(document).ready(function() {
  $(".add_help_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        'lang_id[]':{
          required: true
        },
        'name[1]':{
          required: true,
          
        },
        'hlep_category[1]':{
          required: true,
          
        }
      }
      
  });

  $(".edit_help_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        help_category:{
          required: true
        },
        name:{
          required: true,
          
        },
        description:{
          required: true,
          
        }
      }
      
  });

  });






