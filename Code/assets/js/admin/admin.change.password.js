$(document).ready(function() {
  $(".change_password_form").validate({
    submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        old_password:{
          required: true
        },
        new_password:{
          required: true,
          
        },
        re_password:{
          required: true,
          equalTo: "#new_password"
        }
      }
      
  });

  });
jQuery.validator.addMethod('checkOldpass', function(value, element, param) {
  console.log($(param).val());
return ( value != ($(param).val()))
},'Old Password does not match' );





