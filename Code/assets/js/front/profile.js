$(function () {
	const USER_DASHBOARD_PATH = $('input:hidden[name=USER_DASHBOARD_PATH]').val();

	$("#profileForm").validate({
		submitHandler: function(form){
			$.ajax(
		    {
		        type: "POST",
		        url: `${USER_DASHBOARD_PATH}/update_userinfo`,
		        data: $(form).serialize(),
		        dataType: 'json',
		        beforeSend: function(){
		        	$('.btn-lg').prop('disabled', true);
		       		$('#profileForm .fa-spin').css('display','inline-block');
		       		$('#profileForm .success-message').css('display','none');

		       },
		       success: function (data) {
		       	let { status,message } = data;
	        	$('.btn-lg').prop('disabled', false);
		       	if(status == 'success'){
		       		$('#profileForm .fa-spin').css('display','none');

		       		$('#profileForm .success-message').css('display','block');
		       		$('#profileForm .success-message').html(message);

		       	}
		       	setTimeout(function(){ 
	       			$('.success-message').css('display','none');
	       		}, 2000);
		       }
		       
		        
		    } )
		    },
        rules : {
    		email : {required: true, email: true, checkDuplicateEmail:true},
    		first_name : {required: true},
    		last_name : {required: true},
    		day : {required: true},
    		month : {required: true},
    		year : {required: true},
		},
		
	});

	$.validator.addMethod("checkDuplicateEmail", function(a, b) {
	    var c = "";
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

	}, "Email taken.");

	$("#profileAddressForm").validate({
		submitHandler: function(form){
			$.ajax(
		    {
		        type: "POST",
		        url: `${USER_DASHBOARD_PATH}/update_useraddress`,
		        data: $(form).serialize(),
		        dataType: 'json',
		        beforeSend: function(){
		       		$('#profileAddressForm .fa-spin').css('display','inline-block');
		       		$('#profileAddressForm .success-message').css('display','none');

		       },
		       success: function (data) {
		       	let { status,message } = data;
		       	if(status == 'success'){
		       		$('#profileAddressForm .fa-spin').css('display','none');
		       		$('#profileAddressForm .success-message').css('display','block');
		       		$('#profileAddressForm .success-message').html(message);
		       		setTimeout(function(){ 
		       			$('.success-message').css('display','none');
		       		}, 2000);

		       	}
		       }
		       
		        
		    } )
		    },
        rules : {
    		phone : {required: true},
    		address : {required: true},
    		city : {required: true},
    		state : {required: true},
    		post_code : {required: true},
    		country : {required: true},
		},
		
	});

	$("#updatePasswordForm").validate({
		submitHandler: function(form){
			$.ajax(
		    {
		        type: "POST",
		        url: `${USER_DASHBOARD_PATH}/update_password`,
		        data: $(form).serialize(),
		        dataType: 'json',
		        beforeSend: function(){
		       		$('#updatePasswordForm .fa-spin').css('display','inline-block');
		       		$('#updatePasswordForm .success-message').css('display','none');
		       		$('#updatePasswordForm .error-message').css('display','none');

		       },
		       success: function (data) {
		       	let { status,message } = data;
	       		$('#updatePasswordForm .fa-spin').css('display','none');
		       	if(status == 'success'){
		       		$('#updatePasswordForm .success-message').css('display','block');
		       		$('#updatePasswordForm .success-message').html(message);
		       		setTimeout(function(){ 
		       			location.reload();
		       		}, 2000);
		       	}
		       	if(status == 'error'){
		       		$('#updatePasswordForm .error-message').css('display','block');
		       		$('#updatePasswordForm .error-message').html(message);
		       	}
		       	setTimeout(function(){ 
	       			$('.success-message').css('display','none');
	       		}, 2000);
		       }
		       
		        
		    } )
		    },
        rules : {
    		old_password : {required: true},
    		new_password : {required: true, minlength: 6},
    		re_password : {required:true, equalTo : "#new_password", minlength: 6},
		},
		
	});

	$("#companyProfileForm").validate({
		submitHandler: function(form){
			$.ajax(
		    {
		        type: "POST",
		        url: `${USER_DASHBOARD_PATH}/update_companyinfo`,
		        data: $(form).serialize(),
		        dataType: 'json',
		        beforeSend: function(){
		        	$('.btn-lg').prop('disabled', true);
		       		$('#companyProfileForm .fa-spin').css('display','inline-block');
		       		$('#companyProfileForm .success-message').css('display','none');

		       },
		       success: function (data) {
		       	let { status,message } = data;
	        	$('.btn-lg').prop('disabled', false);
		       	if(status == 'success'){
		       		$('#companyProfileForm .fa-spin').css('display','none');
		       		$('#companyProfileForm .success-message').css('display','block');
		       		$('#companyProfileForm .success-message').html(message);

		       	}
		       	setTimeout(function(){ 
	       			$('.success-message').css('display','none');
	       		}, 2000);
		       }
		       
		        
		    } )
		    },
        rules : {
    		company_name : {required: true},
    		company_reg_no : {required: true},
    		company_addr : {required: true},
    		company_city : {required: true},
    		company_state : {required: true},
    		company_postal_code : {required: true},
    		company_country : {required: true},
		},
		
	});

});