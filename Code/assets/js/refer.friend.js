$(document).ready(function(){
	jQuery.validator.addMethod("required_if_email_exit", function (value, element) {
    var index = $(element).attr('name').match(/\d+/)[0];
    
    if($('.referral-form').find('[name="email['+index+']"]').val()){
        if(value){
            
            return true;
        }
        return false;
    }else{
        if(!value){
            
            return true;
        }
        return false;
    }
}, "Name is required only if email is filled.");
jQuery.validator.addMethod("required_if_name_exit", function (value, element) {
    var index = $(element).attr('name').match(/\d+/)[0];
    
    if($('.referral-form').find('[name="name['+index+']"]').val()){
        
        if(value){
            return true;
        }
        return false;
    }else{
        
        if(!value){
            
            return true;
        }
        return false;
    }
    
}, "Email is required only name is filled.");

jQuery.validator.addMethod("required_unique", function (value, element) {
    var result = false;
    $.ajax({
        url:referal_unique_validation_link,
        type:'post',
        dataType:'json',
        async: false,
        data:{
            email:value,
            csrf_emts_name:$("#csrf_token_user").val()
        },
        success:function(response){
            $("#csrf_token_user").val(response.csrf_token);
            if(response.status == 'success'){
                result =  true;
            }else{
                result =  false;
            }
        }
    })
    return result;
    
}, "This email is used by existing user.");

$('.referral-form').validate({
    errorElement: "div",
    errorClass: "m_title",
    rules:{
        'name[0]':{
            required:true
        },
        'name[1]':{
            required_if_email_exit:true
        },
        'name[2]':{
            required_if_email_exit:true
        },
        'name[3]':{
            required_if_email_exit:true
        },
        'name[4]':{
            required_if_email_exit:true
        },
        'email[0]':{
            required:true,
            required_unique:true
        },
        'email[1]':{
            required_if_name_exit:true
        },
        'email[2]':{
            required_if_name_exit:true
        },
        'email[3]':{
            required_if_name_exit:true
        },
        'email[4]':{
            required_if_name_exit:true
        },
    },
    submitHandler: function (form) {
        $.ajax({
            url:referal_post_link,
            type:'post',
            data:$(form).serialize()+'&csrf_emts_name='+$("#csrf_token_user").val(),
            dataType:'json',
            beforeSend: function (xhr, opts) {
                $('.send-indicate').show();
            },
            complete: function () {
                $('.send-indicate').hide();
            },
            success:function(response){
                $("#csrf_token_user").val(response.csrf_token);
                $('.refer-friend-form-error-container .alert').hide();
                if(response.status == 'success'){
                    $('.refer-friend-form-error-container #msg-success .alert-msg').html(response.message);
                    $('.refer-friend-form-error-container #msg-success').show();
                }else{
                    $('.refer-friend-form-error-container #msg-error .alert-msg').html(response.message);
                    $('.refer-friend-form-error-container #msg-error').show();
                }
            }
        })
    }
})
$('.referral-form input').on('input',function(e){
    $('.referral-form input:input').focusout();
})
})