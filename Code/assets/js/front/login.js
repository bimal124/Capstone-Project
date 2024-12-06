$(function () {
	const API_URL = $('input:hidden[name=api_url]').val();
	const BASE_URL = $('input:hidden[name=base_url]').val();
	$("#emailLoginForm").validate({
		submitHandler: function(form){
			$.ajax(
		    {
			        type: "POST",
			        url: `${API_URL}/email_login`,
			        data: $(form).serialize(),
			        dataType: 'json',
			        beforeSend: function(){
			        	$('.btn-lg').prop('disabled', true);
			       },
			       success: function (data) {
			        	$('.btn-lg').prop('disabled', false);
				       	let {email_error, password_error} = data;
				       	if(email_error != '' || password_error != ''){
				       		$('#emailLoginForm .email-error').show();
				       		$('#emailLoginForm .email-error').text(email_error);
				       		$('#emailLoginForm .password-error').show();
				       		$('#emailLoginForm .password-error').text(password_error);
				       	}else{
				       		window.location.href = `${BASE_URL}my-account/user`;
				       	}
			       }
			       
			        
			    } )
	      },
	        rules : {
        		email : {required: true, email: true},
        		password : {required: true},
    		}
		});

	$('.showLogin').click(function(e){
		e.preventDefault();
		$('.LoginPop').modal('show');
	});	

	$('.toggleLogin').click(function(e){
		e.preventDefault();
		$('.socialLogin').toggle();
		$('.emailLogin').toggle();
	});

	$(".LoginPop").on("hidden.bs.modal", function() {
		$('.loginTitle').text("LOG IN");
		$('.reset-link-sent').text("");
	    $('.socialLogin').css('display','block');
	    $('.emailLogin').css('display','none');
	    $('.forgotPassword').css('display','none');
	    $("#emailLoginForm").validate().resetForm();
	    $("#emailLoginForm").trigger('reset');
	    $("#forgotPasswordForm").validate().resetForm();
	    $("#forgotPasswordForm").trigger('reset');
	    $('.btn-lg').prop('disabled', false);
	    
	    $('.success-message').css('display','none');
	    $('.error-message').css('display','none');

	});

	$('#emailLoginForm').on('submit',function(e){
		e.preventDefault();
		
	});

	$('.forgotPasswordLink').click(function(e){
		e.preventDefault();
		$('.forgotPassword').toggle();
		$('.emailLogin').toggle();
		$('.loginTitle').text("Create New Password");
	});

	$('#forgotPasswordForm').on('submit',function(e){
		e.preventDefault();
		let email = $('#forgotPasswordForm input[name=email]').val();
		$.ajax(
	    {
	        type: "POST",
	        url: `${API_URL}/forgot_password`,
	        data:{ email:email },
	        dataType: 'json',
	        beforeSend: function(){
	        	$('.btn-lg').prop('disabled', true);
	       },
	       success: function (data) {
	        	$('.btn-lg').prop('disabled', false);
		       	let {email_error} = data;
		       	if(email_error != ''){
		       		$('#forgotPasswordForm .email-error').show();
		       		$('#forgotPasswordForm .email-error').text(email_error);
		       	}else{
		       		$('.reset-link-sent').text('Password reset link send to your email.');
		       	}
	       }
	       
	        
	    } )
	});

	 var googleUser = {};
	  var googleSignin = function() {
	    gapi.load('auth2', function(){
	      auth2 = gapi.auth2.init({
	        client_id: '906050758739-526s7qmj90atns2ib0bvqgcvnvuss77u.apps.googleusercontent.com',
	        cookiepolicy: 'single_host_origin',
	      });
	      attachSignin(document.getElementById('googleSigninBtn'));
	    });
	  };

	  function attachSignin(element) {
	    auth2.attachClickHandler(element, {},
	        function(googleUser) {
				let profile = auth2.currentUser.get().getBasicProfile();
				let email = profile.getEmail();
				$.ajax({
			        type: "POST",
			        url: `${API_URL}/social_login`,
			        data: { email: email},
			        dataType: 'json',
			        beforeSend: function(){
			       },
			       success: function (data) {
			       		let { status,message } = data;
			       		if(status == 'success'){
			       			window.location.href = `${BASE_URL}/my-account/user`;
			       		}else{
			       			$('.error-message').css('display','block');
			       			$('.error-message').html(message);
			       		}
			       }
				       
				        
				} )
				          
	        }, function(error) {
	        	// console.log(JSON.stringify(error, undefined, 2));
	        });
	  }

	  googleSignin();

	  
	  $('.modal-singup').click(function(e) {
	  	e.preventDefault();
	  	$('.LoginPop').modal('hide');
	  	$('.RegisterPop').modal('show');
	  	$('input:hidden[name=fbLoginAction]').val('signup');
	  })

	  $('.modal-login').click(function(e) {
	  	e.preventDefault();
	  	$('.LoginPop').modal('show');
	  	$('.RegisterPop').modal('hide');
	  	$('input:hidden[name=fbLoginAction]').val('login');
	  })

 });

function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    // console.log('statusChangeCallback');
    // console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      // document.getElementById('status').innerHTML = 'Please log ' +
      //   'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '344490380534164',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v10.0'           // Use this Graph API version for this call.
    });


    // FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
    //   statusChangeCallback(response);        // Returns the login status.
    // });
  };
 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    FB.api('/me?fields=name,email', function(response) {
      let email = response.email;
      let API_URI = $('input:hidden[name=api_url]').val();
      let BASE_URI = $('input:hidden[name=base_url]').val();
      
		$.ajax({
			type: "POST",
			url: `${API_URI}/social_login`,
			data: { email: email},
			dataType: 'json',
		beforeSend: function(){
		},
		success: function (data) {
			let { status,message } = data;
			if(status == 'success'){
				window.location.href = `${BASE_URI}my-account/user`;
			}else{
				$('.error-message').css('display','block');
				$('.error-message').html(message);
			}
		}
		})
     

    });
  }