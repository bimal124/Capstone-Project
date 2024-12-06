$(document).ready(function(){

	$("#userregform").validate({

		submitHandler: function(form) {		   

		   form.submit();

		},
		ignore: [],
		errorElement: "span",

		//errorClass: "form_validation_error",

		rules: {

			first_name: {

				required: true,

				// minlength:6,

				// maxlength:100,

				//alphanumeric:true,								

			},

				last_name: {

				required: true,

				// minlength:6,

				// maxlength:100,

				//alphanumeric:true,								

			},

			email: {

				required: true,

				email:true,

				checkDuplicateEmail:true

			},

			country: {

				required: true,

			},
			dob: {

				required: true,

			},
			user_name: {

				required: true,

				maxlength:20,

				minlength:4

			},

			password: {

				required: true,

				minlength:4,

				maxlength:20

			},

			re_password: {

				required: true,

				minlength:4,

				maxlength:20,

				equalTo: "#password"

			},	

			t_c: {

				required: true,

			},

			voucher:{checkVoucher:true}

		},

		

	});// Administrator Register validate



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



	$.validator.addMethod("checkVoucher", function(a, b) {

    var c = "";

    console.log(urlCheckVoucher);

    return $.ajax({

        type: "POST",

        url: urlCheckVoucher,

        data: {

            str: a

        },

        async: !1,

        success: function(a) {

            "" == a && void 0 == a && null == a || (c = a.trim())

        }

    }), this.optional(b) || c==true

}, vouchermsg);

});