jQuery(document).ready(function($) {

	jQuery.validator.addMethod("exactlength", function(value, element, param) {

	 return this.optional(element) || value.length == param;

	}, jQuery.format("Please enter exact characters."));

	$('input[name=admin_username]').focus();

	//Login
	$("#adminLoginForm").validate({
		submitHandler: function(form) {		   
		   form.submit();
		},

		errorElement: "div",

		rules: {

			username: {
				required: true,				
			},
			password: {
				required: true,
			},
			admin_captcha: {
				required: true,
				exactlength: 5
			}
		},
		messages: {
			username: {
				required: "Username is required",
			},
			password: {
				required: "Password is required",
			},
			captcha_code: {
				exactlength: "Invalid Verification Code",
				required: "Verification Code is Required",
			}

		},
		errorPlacement: function(error, element) {
			if(element.attr("name") == "admin_captcha") {
				error.appendTo( $('#admincapcha_error_container') );
			}
			else {
				error.insertAfter(element);
		  	}
		}
	});//Login validate

	//Reload Captcha
	$(".login-box-body").delegate(".load_new_captcha", "click", function() {

				$(".fa-refresh").addClass("fa-spin");
                $.ajax({

                        url : reload_captcha_url,
                        cache : false,
                        success : function(imageFromTheController){ //the success will not be executed until the server respond whith 200okk status

                           var newCaptcha = $('<span id="admin_captcha_container">'+imageFromTheController+'</span>');
                           $('#admin_captcha_container').replaceWith(newCaptcha);
						   $(".fa-refresh").removeClass("fa-spin");
                        }                       

                });

                return false;

			});
});