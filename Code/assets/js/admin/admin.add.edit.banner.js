$(document).ready(function() {
  $(".banner_add_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        lang:{
          required: true,
        },
        img1:{
          required: true,
        }
        
      }
      
  });

  $(".edit_banner_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        lang:{
          required: true,
        }
        
      }
      
  });
});

jQuery.validator.addMethod('greaterThan', function(value, element, param) {
  console.log(param);
return ( value > param);
},false );



