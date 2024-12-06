$(function () {
	const API_URL = $('input:hidden[name=api_url]').val();
	const BASE_URL = $('input:hidden[name=base_url]').val();

	$("#emailRegisterForm").validate({
		submitHandler: function(form){
			$.ajax(
		    {
			        type: "POST",
			        url: `${API_URL}/email_register`,
			        data: $(form).serialize(),
			        dataType: 'json',
			        beforeSend: function(){
			        	$('.btn-lg').prop('disabled', true);
			       		$('.success-message').css('display','none');
			        	
			       },
			       success: function (data) {
			       	let { status,message } = data;
		        	$('.btn-lg').prop('disabled', false);
			       	if(status == 'success'){
			       		$('.alert').css('display','none');
			       		$('.success-message').css('display','block');
			       		$('.success-message').html(message);

			       	}
			       }
			       
			        
			    } )
		    },
        rules : {
    		email : {required: true, email: true, checkDuplicateEmail:true},
    		password : {required: true,minlength: 6},
    		re_password : {required:true, equalTo : "#password", minlength: 6},
		},
		messages: {
            re_password: {
                equalTo: "Password and Confirm password doesnot match."
            }
        }
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

	}, "Email already exists.");

	$('.showRegister').click(function(e){
		e.preventDefault();
		$('.RegisterPop').modal('show');
	});

	$('.toggleRegister').click(function(e){
		e.preventDefault();
		$('.socialRegister').toggle();
		$('.emailRegister').toggle();
	});

	$(".RegisterPop").on("hidden.bs.modal", function() {

	    $('.socialRegister').css('display','block');
	    $('.emailRegister').css('display','none');
	    $("#emailRegisterForm").validate().resetForm();
	    $("#emailRegisterForm").trigger('reset');
	    $('#socialRegisterDiv').html('');
	    $('.success-message').css('display','none');
	    $('.error-message').css('display','none');
	});


	// google registration
	 var googleUser = {};
	  var googleSignupOne = function() {
	    gapi.load('auth2', function(){
	      auth2 = gapi.auth2.init({
	        client_id: '906050758739-526s7qmj90atns2ib0bvqgcvnvuss77u.apps.googleusercontent.com',
	        cookiepolicy: 'single_host_origin',
	      });
	      attachSignup(document.getElementById('googleSignupBtn'));
	    });
	  };

	  function attachSignup(element) {
	    auth2.attachClickHandler(element, {},
	        function(googleUser) {
				let profile = auth2.currentUser.get().getBasicProfile();
				let first_name = profile.getGivenName();
				let last_name = profile.getFamilyName();
				let email = profile.getEmail();
				$.ajax(
			    {
			        type: "POST",
			        url: `${API_URL}/social_register_showform`,
			        data: { email: email, first_name: first_name, last_name: last_name},
			        dataType: 'json',
			        beforeSend: function(){
			        	$('.error-message').css('display','none');
			       },
			       success: function (data) {
			       		let { status,message } = data;
			       		if(status == 'success'){
			       			let { register_form } = data;
			       			$('.socialRegister').css('display','none');
			       			$('#socialRegisterDiv').html(register_form);
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

	  googleSignupOne();

	  $('#community-read').click(function(e){
	  	e.preventDefault();
	  	let msg = $(this).html();
	  	if(msg == 'Read more'){
	  		$(this).html('Read less');
	  	}else{
	  		$(this).html('Read more');
	  	}
	  	$('#community-msg').toggle();
	  })

});


function statusChangeCallback1(response) {  // Called with the results from FB.getLoginStatus().
    // console.log('statusChangeCallback');
    // console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI1();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      // document.getElementById('status').innerHTML = 'Please log ' +
      //   'into this webpage.';
    }
  }

function checkLoginState1() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback1(response);
    });
  }

function testAPI1() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    FB.api('/me?fields=first_name,last_name,name,email', function(response) {
      let API_URI = $('input:hidden[name=api_url]').val();
      let email = response.email;
      let first_name = response.first_name;
      let last_name = response.last_name;
		$.ajax(
	    {
	        type: "POST",
	        url: `${API_URI}/social_register_showform`,
	        data: { email: email, first_name: first_name, last_name: last_name},
	        dataType: 'json',
	        beforeSend: function(){
	        	$('.error-message').css('display','none');
	       },
	       success: function (data) {
	       		let { status,message } = data;
	       		if(status == 'success'){
	       			let { register_form } = data;
	       			$('.socialRegister').css('display','none');
	       			$('#socialRegisterDiv').html(register_form);
	       		}else{
	       			$('.error-message').css('display','block');
	       			$('.error-message').html(message);
	       		}
	       }
		       
		        
		} )
    });
  }