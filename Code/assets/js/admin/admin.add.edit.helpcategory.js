$(document).ready(function() {
  $(".add_help_cat_form").validate({
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
          
        }
      }
      
  });

  $(".edit_help_cat_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        'lang_id[]':{
          required: true
        },
        name:{
          required: true,
          
        }
      }
      
  });

  });






