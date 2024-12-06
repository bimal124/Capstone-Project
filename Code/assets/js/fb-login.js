$(document).ready(function(){
	$.validator.addMethod("checkDuplicateEmail", function(a, b) {
    var c = "";
    console.log(urlCheckDuplicateEmail);
    return $.ajax({
        type: "POST",
        url: urlCheckDuplicateEmail,
        data: {
            email: a
        },
        async: !1,
        success: function(a) {
            "" == a && void 0 == a && null == a || (c = a.trim())
        }
    }), this.optional(b) || "available" == c
}, "Email already exists.");
	 $(document).on('click','#getEmailBtn',function(e){
        console.log(urlSocialRegister);
               $("#getEmailForm").validate({

            errorElement: 'p',
            errorClass:'text-danger',
            //validClass:'success',
              
            highlight: function (element, errorClass, validClass) { 
              $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 
            }, 
            
            unhighlight: function (element, errorClass, validClass) { 
                $(element).parents("div.form-group").removeClass('has-error'); 
                $(element).parents(".error").removeClass('has-error').addClass('has-success'); 
            },
            
            rules: {
                email: {
                    required: true,
                    email: true,
                    checkDuplicateEmail : true
                },
                
            },

            // messages: {

            //     email: {
            //         required: required,
            //         email: email,
            //         checkDuplicateEmail : duplicateEmail
            //     },
                
            // },

            submitHandler: function(form) {
                jQuery.ajax({
                    type: "POST",
                    url: urlSocialRegister,
                    datatype: 'json',
                    data: $('form#getEmailForm').serialize(),
                    beforeSend: function(){
                        $('#getEmailBtn').html('Signing Up');
                        $('#getEmailBtn').attr('disabled',true);
                    },
                    success: function(json) {
                        console.log(json);
                        data = jQuery.parseJSON(json);
                        
                        $('#getEmailBtn').html('Sign up');
                        $('#getEmailBtn').removeAttr('disabled');
                        
                        if (data.status == 'success') {

                            $('#getEmailResponse').css('display','inline-block');
                            $('#getEmailResponse').removeClass('error').addClass('success');
                            $('#getEmailResponse').html(data.message);
                            $("#getEmailForm").trigger('reset');
                                
                            setTimeout(function(){
                                //remove class and html contents
                                $("#getEmailResponse").html('');
                                $("#getEmailResponse").css("display", "none");
                                
                                 //redirect to users my account if automatic login
                                if(data.login=='yes'){
                                    //window.location.href = site_url + 'my-account/index'; 
                                    window.location.href = data.redirect_url;
                                }
                            },3000);
                            location.reload();
                        } else {
                            $('#getEmailResponse').css('display','inline-block');
                            $('#getEmailResponse').removeClass('success').addClass('error');
                            $('#getEmailResponse').html(data.message);
                        }
                        
                        setTimeout(function(){
                            //remove class and html contents
                            $("#getEmailResponse").html('');
                            $("#getEmailResponse").css("display", "none");
                            $('#myEmailModal').css("display", "none");

                        },3000);
                        // location.reload();
                    }
                });
                return false;
            }
        });
    })
})