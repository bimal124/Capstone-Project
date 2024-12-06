$(document).ready(function() {

  $(".form-cat-add").validate({
      submitHandler: function(form){
      	console.log('adsadasdas');
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        is_display:{
          required: true,
        },
      
      }

    });
 });