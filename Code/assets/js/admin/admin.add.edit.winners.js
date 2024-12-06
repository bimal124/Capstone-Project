$(document).ready(function() {
  $(".add_winners_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        'description[1]':{
          required: true
        },
        img1:{required:true}
      }
      
  });

  $(".edit_winners_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
          rules: {
        
        'description[1]':{
          required: true
        }
      }
      
  });

  });






