$(document).ready(function() {

  $('input[type=radio][name=status]').change(function() {
    let status = $(this).val();
    if(status == '1'){
      $('.reasonDiv').hide();
    }else{
      $('.reasonDiv').show();

    }
  })

$('#start_datetimepicker').datetimepicker({
        format:'YYYY-MM-DD',
        
    });

$('#end_datetimepicker').datetimepicker({
        format:'YYYY-MM-DD',
        
    });
  $("#chang_pass").click(function(e) {
    e.preventDefault();
    $("#change_password").html('<input name="password" type="text" class="inputtext form-control" id="password" size="30" />');
    $("#btn_change_password").html('<input class="bttn btn btn-success" type="button" name="Submit" value="Change" id="changed"  onclick="changedpassword(this.value)" />');
  });

      $(".add_member_form").validate({
      submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        first_name:{
          required: true,
          alpha: true,
          //rangelength: [1,20],
        },
        last_name:{
          required: true,
          alpha: true,
          //rangelength: [1,20],
        },
        email:{
          required: true,
         email:true
        },
        country:{
          required: true,
        },dob:{
          required: true,
        },
        user_name:{
          required: true
        },

        password:{
          required:true,
          //minlength:6,
          // checkUnamePsw: "#user_name",
          // checkFnamePsw: "#first_name"
        },
         re_password:{
          required:true,
                  equalTo: "#password"
              }
      },
      messages: {
                first_name:
                  {
                    rangelength:'Please enter a value between 2 and 20 characters long.'
                  },
                  last_name:
                  {
                    rangelength:'Please enter a value between 4 and 20 characters long.'
                  },
                  password:
                  {
                    checkUnamePsw:'Username and Password Cannot be same',
                    checkFnamePsw:'Firstname and Password cannot be same'
                  }
                }

    });


       $(".edit_member_form").validate({
      submitHandler: function(form){
        
        form.submit();  
      },
      errorElement: 'span',
      
      rules: {
        
        first_name:{
          required: true,
          alpha: true,
          //rangelength: [2,20],
        },
        last_name:{
          required: true,
          alpha: true,
          //rangelength: [4,20],
        },
        email:{
          required: true,
         email:true
        },
        country:{
          required: true,
        },
        user_name:{
          required: true
        },

    
      },
      messages: {
                first_name:
                  {
                    rangelength:'Please enter a value between 2 and 20 characters long.'
                  },
                  last_name:
                  {
                    rangelength:'Please enter a value between 4 and 20 characters long.'
                  },
                  password:
                  {
                    checkUnamePsw:'Username and Password Cannot be same',
                    checkFnamePsw:'Firstname and Password cannot be same'
                  }
                }

    });
});

function changedpassword(value) {
  $.post(changepassword_url, 
   $("#uprofile").serialize(), 
   function(data)
   {
    $("#change_password").html('<span class="error">'+data.message+'</span>');
    if(data.status=='success'){
      $("#btn_change_password").html('');
    }
  },'json');
}

  $.validator.addMethod("alphanumeric", function(value, element, param) {
    return this.optional(element) || /^[a-zA-Z0-9_]+$/i.test(value);
  }, "Letters, numbers or underscores only please"); 

  $.validator.addMethod("checkUnamePsw", function (value, element, param) {
      if (value) return value != ($(param).val());
      else return this.optional(element);
  }, "Username and Password cannot be same.");
  
  $.validator.addMethod("checkFnamePsw", function (value, element, param) {
      if (value) return value != ($(param).val());
      else return this.optional(element);
  }, "First name and Password cannot be same.");

  $.validator.addMethod("alpha", function (value, element) {
      return this.optional(element) || /^[a-z _]+$/i.test(value);
  }, "Please Enter only alphabets");

 