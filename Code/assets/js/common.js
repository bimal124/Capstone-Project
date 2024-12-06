 $(function () {
		// $("#bookAppoint").validate({
		// 	submitHandler: function(form){
		// 	console.log("submit");
	 //      },
  //           rules : {
  //               		card_number : {required: true},
  //               		cemail : {equalTo : "#email"},
		// 				symptoms: {required: true, maxlength: 150},
  //           		}
		// });

  
  $(".covid_test").click(function(){
    $("#covid_test_form").toggle( "slow" );
	if($('input[name="covid_test"]:checked').val()=="0"){
		$("#covid_test_type").val("");
		$("#covid_no_test").val("1");
		$("#covid_test_price").val("0");
		
		//display total cost
		 var appointment_type = $('input[name="appointment_type"]:checked').val();		
		 	 if(appointment_type == 1){
				 var house_call_cost = parseFloat($('input[name="house_call_visit"]:checked').data('price'));
				 var house_call_additional_cost = parseFloat($('input[name="house_call_visit"]:checked').data('additional'));
				 var house_call_additional_member = parseInt($("#house_call_additional_member").val());
				 $("#total_amount").val(house_call_cost + (house_call_additional_cost*house_call_additional_member));
			 }else{
				 $("#total_amount").val(parseFloat($('input[name="appointment_type"]:checked').data('price')));
			 }
	}
  });
  
  $("#covid_test_type").on('change', function(){
		var covid_test_type = $(this).val();
		var covid_test_type_price = $(this).find(':selected').data('price');
		//var covid_test_additional_price = $(this).find(':selected').data('additional');
		//alert(covid_test_type_price);
		var covid_no_test = 1;			
			$("#covid_no_test").val('1');
		
		var total_covid_cost = parseFloat(covid_test_type_price) * parseInt(covid_no_test);	
		$("#covid_test_price").val(total_covid_cost);
		
		//display total cost
		 var appointment_type = $('input[name="appointment_type"]:checked').val();		
		 	 if(appointment_type == 1){
				 var house_call_cost = parseFloat($('input[name="house_call_visit"]:checked').data('price'));
				 var house_call_additional_cost = parseFloat($('input[name="house_call_visit"]:checked').data('additional'));
				 var house_call_additional_member = parseInt($("#house_call_additional_member").val());
				 $("#total_amount").val(total_covid_cost + house_call_cost + (house_call_additional_cost*house_call_additional_member));
			 }else{
				 $("#total_amount").val(total_covid_cost + parseFloat($('input[name="appointment_type"]:checked').data('price')));
			 }
			 
		
			
  });
  
  $("#covid_no_test").on('change', function(){
	  var covid_no_test = $(this).val();	  
	  var covid_test_type_price = $("#covid_test_type").find(':selected').data('price');
	  var covid_test_additional_price = $("#covid_test_type").find(':selected').data('additional');	 
	  var total_covid_cost = parseFloat(covid_test_type_price) + ((parseInt(covid_no_test)-1) * parseFloat(covid_test_additional_price));
		$("#covid_test_price").val(total_covid_cost);
	  
	  	//display total cost
		 var appointment_type = $('input[name="appointment_type"]:checked').val();		
		 	 if(appointment_type == 1){
				 var house_call_cost = parseFloat($('input[name="house_call_visit"]:checked').data('price'));
				 var house_call_additional_cost = parseFloat($('input[name="house_call_visit"]:checked').data('additional'));
				 var house_call_additional_member = parseInt($("#house_call_additional_member").val());
				 $("#total_amount").val(total_covid_cost + house_call_cost + (house_call_additional_cost*house_call_additional_member));
			 }else{
				 $("#total_amount").val(total_covid_cost + parseFloat($('input[name="appointment_type"]:checked').data('price')));
			 }
  });
  
  $(".appointment_type").click(function(){
    	if($(this).val() == 1){
			$(".appointment_type_option").show();
				 
				 var total_covid_cost = parseFloat($("#covid_test_price").val());				 
				 var house_call_cost = parseFloat($('input[name="house_call_visit"]:checked').data('price'));
				 var house_call_additional_cost = parseFloat($('input[name="house_call_visit"]:checked').data('additional'));
				 var house_call_additional_member = parseInt($("#house_call_additional_member").val());
				 $("#total_amount").val(total_covid_cost + house_call_cost + (house_call_additional_cost*house_call_additional_member));
			
		}
		else{
				$(".appointment_type_option").hide();
				var total_covid_cost = parseFloat($("#covid_test_price").val());
				$("#total_amount").val(total_covid_cost + parseFloat($('input[name="appointment_type"]:checked').data('price')));
		}
  });
  
  $(".house_call_visit").click(function(){
	   var total_covid_cost = parseFloat($("#covid_test_price").val());				 
	   var house_call_cost = parseFloat($('input[name="house_call_visit"]:checked').data('price'));
	   var house_call_additional_cost = parseFloat($('input[name="house_call_visit"]:checked').data('additional'));
	   var house_call_additional_member = parseInt($("#house_call_additional_member").val());
	   $("#total_amount").val(total_covid_cost + house_call_cost + (house_call_additional_cost*house_call_additional_member));
  });
  
  $("#house_call_additional_member").on('change', function(){
	 	var total_covid_cost = parseFloat($("#covid_test_price").val());	
	  
	  	//display total cost
		 var appointment_type = $('input[name="appointment_type"]:checked').val();		
		 	 if(appointment_type == 1){
				 var house_call_cost = parseFloat($('input[name="house_call_visit"]:checked').data('price'));
				 var house_call_additional_cost = parseFloat($('input[name="house_call_visit"]:checked').data('additional'));
				 var house_call_additional_member = parseInt($("#house_call_additional_member").val());
				 $("#total_amount").val(total_covid_cost + house_call_cost + (house_call_additional_cost*house_call_additional_member));
			 }else{
				 $("#total_amount").val(total_covid_cost + parseFloat($('input[name="appointment_type"]:checked').data('price')));
			 }
  });
  

	$('#date_picker').datetimepicker({ 
										format:'YYYY-MM-DD',
									}).on('dp.change', function (e) {
		var pickedDay = new Date(e.date).getDate();
		var pickedMonth = new Date(e.date).getMonth() + 1;
	    var pickedYear = new Date(e.date).getFullYear(); 
		$("#day").val(pickedDay);
		$("#month").val(pickedMonth);
		$("#year").val(pickedYear);
	});

	$('.btn-next').click(function(e){
		e.preventDefault();
		var form = $("#bookAppoint");
		form.validate({
			 // ignore: ":hidden:not(.valid)",
					rules: {
						name: {required: true},
						last_name: {required: true},
						phone: {required: true},
						email : {required: true, email: true},
                		cemail : {required: true, equalTo : "#email"},
						symptoms: {required: true},
						month: {required: true},
						day: {required: true},
						year: {required: true},
						pickedYear: {required: true},
						address: {required: true},
						city: {required: true},
						state: {required: true},
						zip: {required: true},
					},
					invalidHandler: function(form, validator) {

				        if (!validator.numberOfInvalids())
				            return;

				        $('html, body').scrollTop($(validator.errorList[0].element).offset().top-100);

				    }
					
				});
				if (form.valid() === true){
					$('.section-1').hide();
					$('.section-2').show();
					$('.profileInfo').hide();
					$("html, body").scrollTop(450);

				}
	});

	$('.btn-prev').click(function(e){
		e.preventDefault();
		$('.section-1').show();
		$('.section-2').hide();
		$('.profileInfo').show();
		$("html, body").scrollTop(450);

	});

	$('#defaultCheck1').change(function(){
		if(this.checked){
			$('input[name=billing_name]').val($('input[name=name]').val());
			$('input[name=billing_last_name]').val($('input[name=last_name]').val());
			$('input[name=billing_address]').val($('input[name=address]').val());
			$('input[name=billing_address2]').val($('input[name=address2]').val());
			$('input[name=billing_city]').val($('input[name=city]').val());
			$('input[name=billing_state]').val($('input[name=state]').val());
			$('input[name=billing_zip]').val($('input[name=zip]').val());
		}else{
			$('input[name=billing_name]').val('');
			$('input[name=billing_last_name]').val('');
			$('input[name=billing_address]').val('');
			$('input[name=billing_address2]').val('');
			$('input[name=billing_city]').val('');
			$('input[name=billing_state]').val('');
			$('input[name=billing_zip]').val('');
		}
	});

	$('#profileInfo').change(function(){
		if(this.checked){
			$('input[name=name]').val(user_info.first_name);
			$('input[name=last_name]').val(user_info.last_name);
			$('input[name=phone]').val(user_info.phone);
			$('input[name=email]').val(user_info.email);
			$('input[name=cemail]').val(user_info.email);
			$('input[name=address]').val(user_info.address);
			$('input[name=city]').val(user_info.city);
			$('input[name=state]').val(user_info.state);
			$('input[name=zip]').val(user_info.post_code);
			$('#year').val(user_info.year);
			$('#month').val(user_info.month);
			$('#day').val(user_info.day);
		}else{
			$('input[name=name]').val('');
			$('input[name=last_name]').val('');
			$('input[name=phone]').val('');
			$('input[name=email]').val('');
			$('input[name=cemail]').val('');
			$('input[name=address]').val('');
			$('input[name=city]').val('');
			$('input[name=state]').val('');
			$('input[name=zip]').val('');
			$('select[name=year]').val('');
			$('select[name=month]').val('');
			$('select[name=day]').val('');

		}
	});

	
	const cardErrorMessage = () => {
		$("html, body").scrollTop(450);
		$('#bookAppoint .error-message').css('display','block');
		$('#bookAppoint .error-message').html('Please ensure Credit Card values are in a proper format.');
	}

	$('#bookAppoint').submit(function(e){
            e.preventDefault();
            // let card_number = $('input[name=card_number]').val();
            let BASE_URL = $('input:hidden[name=base_url]').val();
            // let card_type = $('input:hidden[name=card_type]').val();
            // card_number = card_number.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            // let card_length = card_number.length;
            // if(card_length < 1){
            // 	return false;
            // }
            // if(card_type == 'visa' && card_length != 13 && card_length != 16){
            // 	cardErrorMessage();
            // 	return false;
            // }else if(card_type == 'american-express' && card_length != 15){
            // 	cardErrorMessage();
            // 	return false;
            // }else if(card_type == 'diners' && card_length != 14){
            // 	cardErrorMessage();
            // 	return false
            // }else if((card_type == 'mastercard' || card_type == 'discover' || card_type == 'jcb') && card_length != 16){
            // 	cardErrorMessage();
            // 	return false;
            // }else if(card_type == 'default'){
            // 	cardErrorMessage();
		    //    	return false;
            // }


            $.ajax(
		    {
		        type: "POST",
		        url: `${BASE_URL}api/book_appointment`,
		        data: $('#bookAppoint').serialize(),
		        dataType: 'json',
		        beforeSend: function(){
		        	$(".btn-booking").html('Submitting... <i class="fa fa fa-spinner fa-spin"></i>');
					$(".btn-booking").attr("disabled", true);
					$('#bookAppoint .success-message').css('display','none');
					$('#bookAppoint .error-message').css('display','none');
		       },
		       success: function (data) {
					$(".btn-booking").attr("disabled", false);
		       		$(".btn-booking").html('Complete Booking');
		        	let { status,message } = data;
			       	if(status == 'success'){
						window.location.href = `${BASE_URL}booking-success`;
			       	}else if(status == 'error'){
				       	$("html, body").scrollTop(100);
						$(".btn-booking").attr("disabled", false);
			       		$(".btn-booking").html('Complete Booking');
			       		$('#bookAppoint .error-message').css('display','block');
			       		$('#bookAppoint .error-message').html(message);
			       	}
		       }
		       
		        
		    } )
        })
	const flags = [
		{ name: "default", value: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 15 10'%3E%3Cg fill='%23CFD4D8'%3E%3Cpath d='M15 2v-.5c0-.85-.65-1.5-1.5-1.5h-12C.65 0 0 .65 0 1.5V2h15zM0 2.5h15v1H0zM0 4v4.5C0 9.35.65 10 1.5 10h12c.85 0 1.5-.95 1.5-1.75V4H0zm2.25 2.5h2.5c.15 0 .25.1.25.25S4.9 7 4.75 7h-2.5C2.1 7 2 6.9 2 6.75s.1-.25.25-.25zm4 1.5h-4C2.1 8 2 7.9 2 7.75s.1-.25.25-.25h4c.15 0 .25.1.25.25S6.4 8 6.25 8z'/%3E%3C/g%3E%3C/svg%3E"},
		{ name: "american-express",value: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 31 19'%3E%3Cdefs%3E%3ClinearGradient id='a' x1='0%25' y1='0%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%231D91CE'/%3E%3Cstop offset='100%25' stop-color='%2335AFEF'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath fill='url(%23a)' d='M27.58 19H3.42A2.4 2.4 0 0 1 1 16.62V2.38A2.4 2.4 0 0 1 3.42 0h24.16A2.4 2.4 0 0 1 30 2.38v14.25A2.4 2.4 0 0 1 27.58 19z'/%3E%3Cpath fill='%23FFF' d='M5.063 11.896L4.591 13H.36l3.339-7h7.975l.805 1.546L13.231 6H23.983l.919.961.987-.961h4.993l-3.545 3.492L30.729 13h-4.832l-1.081-1.031L23.744 13H6.496l-.519-1.104'/%3E%3Cpath fill='%231D91CE' fill-rule='nonzero' d='M5.98 11.97h-.92.92zM16.2 7h-2.1l-1.58 3.35L10.82 7h-2.1v4.85L6.55 7H4.58l-2.32 5h1.42l.47-1.14h2.7L7.39 12H10V7.93L11.85 12h1.22l1.84-4v4h1.29V7zm8.67 1.62L23.37 7h-6.02v5h5.82l1.65-1.64L26.48 12h1.55l-2.37-2.53L28.1 7h-1.62l-1.61 1.62zM21.7 11h-3.06V9.9h3.06v-1h-3.06V8h3.06v-.85l2.27 2.27-2.27 2.28V11zM5.53 7.82l.88 2.03H4.58l.95-2.03z'/%3E%3C/g%3E%3C/svg%3E"},
		{ name: "discover", value: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 29 19'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath fill='%23EBF1F8' d='M26.58 19H2.42A2.4 2.4 0 0 1 0 16.62V2.38A2.4 2.4 0 0 1 2.42 0h24.16A2.4 2.4 0 0 1 29 2.38v14.25A2.4 2.4 0 0 1 26.58 19z'/%3E%3Cpath fill='%23F27712' d='M15.24 19h11.34A2.4 2.4 0 0 0 29 16.62v-2.85A46.81 46.81 0 0 1 15.24 19z'/%3E%3Cpath fill='%23000' fill-rule='nonzero' d='M28 10.9h-1.03l-1.16-1.53h-.11v1.53h-.84V7.1h1.24c.97 0 1.53.4 1.53 1.12 0 .59-.35.97-.98 1.09L28 10.9zm-1.24-2.65c0-.37-.28-.56-.8-.56h-.26v1.15h.24c.54 0 .82-.2.82-.59zM21.92 7.1h2.38v.64h-1.54v.85h1.48v.65h-1.48v1.03h1.54v.64h-2.38V7.1zm-2.7 3.9L17.4 7.09h.92l1.15 2.56 1.16-2.56h.9L19.69 11H19.22zm-7.61-.01c-1.28 0-2.28-.87-2.28-2 0-1.1 1.02-1.99 2.3-1.99.36 0 .66.07 1.03.23v.88a1.5 1.5 0 0 0-1.05-.43c-.8 0-1.41.58-1.41 1.31 0 .77.6 1.32 1.45 1.32.38 0 .67-.12 1.01-.42v.88c-.38.16-.7.22-1.05.22zM9.07 9.74c0 .74-.61 1.25-1.49 1.25-.64 0-1.1-.22-1.49-.72l.55-.47c.19.34.51.51.91.51.38 0 .65-.23.65-.53 0-.17-.08-.3-.25-.4a3.48 3.48 0 0 0-.58-.22c-.79-.25-1.06-.52-1.06-1.05 0-.62.58-1.09 1.34-1.09.48 0 .91.15 1.27.43l-.44.5a.92.92 0 0 0-.68-.3c-.36 0-.62.18-.62.42 0 .2.15.31.65.48.96.3 1.24.58 1.24 1.2v-.01zM4.94 7.1h.84v3.81h-.84V7.1zm-2.7 3.81H1V7.1h1.24c1.36 0 2.3.78 2.3 1.9 0 .57-.28 1.11-.77 1.47-.42.3-.89.44-1.54.44h.01zm.98-2.86c-.28-.22-.6-.3-1.15-.3h-.23v2.52h.23c.54 0 .88-.1 1.15-.3.29-.24.46-.6.46-.97s-.17-.72-.46-.95z'/%3E%3Cpath fill='%23F27712' d='M15 7c-1.1 0-2 .88-2 1.97 0 1.16.86 2.03 2 2.03 1.12 0 2-.88 2-2s-.87-2-2-2z'/%3E%3C/g%3E%3C/svg%3E"},
		{ name: "diners", value: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 29 19'%3E%3Cdefs%3E%3ClinearGradient id='a' x1='0%25' y1='0%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%23EBF1F8'/%3E%3Cstop offset='100%25' stop-color='%23C1D5ED'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath fill='url(%23a)' d='M26.58 19H2.42A2.4 2.4 0 0 1 0 16.62V2.38A2.4 2.4 0 0 1 2.42 0h24.16A2.4 2.4 0 0 1 29 2.38v14.25A2.4 2.4 0 0 1 26.58 19z'/%3E%3Cpath fill='%230165AC' d='M12 2.02V2h5v.02a7.5 7.5 0 0 1 0 14.96V17h-5v-.02a7.5 7.5 0 0 1 0-14.96z'/%3E%3Cpath fill='%23FFF' fill-rule='nonzero' d='M14 13.74a4.5 4.5 0 0 0 0-8.48v8.48zm-3-8.48a4.5 4.5 0 0 0 0 8.48V5.26zM12.5 16a6.5 6.5 0 1 1 0-13 6.5 6.5 0 0 1 0 13z'/%3E%3C/g%3E%3C/svg%3E"},
		{ name: "visa", value: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 29 19'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath fill='%23F6F9FC' d='M26.58 19H2.42A2.4 2.4 0 0 1 0 16.62V2.38A2.4 2.4 0 0 1 2.42 0h24.16A2.4 2.4 0 0 1 29 2.38v14.25A2.4 2.4 0 0 1 26.58 19z'/%3E%3Cpath fill='%23F99F1B' d='M0 16v.63A2.4 2.4 0 0 0 2.42 19h24.16A2.4 2.4 0 0 0 29 16.62V16H0z'/%3E%3Cpath fill='%232D4990' fill-rule='nonzero' d='M0 3v-.63A2.4 2.4 0 0 1 2.42 0h24.16A2.4 2.4 0 0 1 29 2.38V3H0zm13.9 3.12l-1.48 6.77h-1.77l1.46-6.77h1.79zm7.47 4.38l.94-2.55.54 2.55h-1.48zm1.99 2.4H25l-1.44-6.78h-1.51a.8.8 0 0 0-.76.5l-2.67 6.27h1.87l.37-1h2.28l.22 1v.01zm-4.64-2.22c0-1.78-2.51-1.88-2.5-2.68.01-.24.25-.5.76-.57a3.4 3.4 0 0 1 1.75.3l.31-1.43c-.42-.15-.97-.3-1.66-.3-1.76 0-3 .92-3 2.24-.01.97.88 1.52 1.55 1.84.7.33.93.55.93.84-.01.46-.56.66-1.07.66-.9.02-1.41-.23-1.82-.42l-.33 1.48c.42.19 1.19.35 1.98.36 1.87 0 3.09-.9 3.1-2.32zm-7.37-4.56L8.47 12.9H6.6L5.18 7.5c-.09-.33-.17-.45-.43-.6A7.53 7.53 0 0 0 3 6.33l.04-.2h3.03c.38 0 .73.26.82.7l.75 3.91 1.85-4.6h1.86v-.02z'/%3E%3C/g%3E%3C/svg%3E"},
		{ name: "mastercard", value: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 29 19'%3E%3Cdefs%3E%3ClinearGradient id='a' x1='0%25' y1='0%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%23003663'/%3E%3Cstop offset='100%25' stop-color='%231D629C'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath fill='url(%23a)' d='M26.58 19H2.42A2.4 2.4 0 0 1 0 16.62V2.38A2.4 2.4 0 0 1 2.42 0h24.16A2.4 2.4 0 0 1 29 2.38v14.25A2.4 2.4 0 0 1 26.58 19z'/%3E%3Ccircle cx='10.5' cy='9.5' r='6.5' fill='%23EB1C26'/%3E%3Ccircle cx='18.5' cy='9.5' r='6.5' fill='%23F99F1B'/%3E%3Cpath fill='%23EF5D20' d='M14.5 4.38a6.49 6.49 0 0 0 0 10.24 6.49 6.49 0 0 0 0-10.24z'/%3E%3C/g%3E%3C/svg%3E"},
		{ name: "jcb", value: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 29 19'%3E%3Cdefs%3E%3ClinearGradient id='a' x1='0%25' y1='3.059%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%230C489C'/%3E%3Cstop offset='100%25' stop-color='%231F6AD3'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath fill='url(%23a)' d='M26.58 19H2.42A2.4 2.4 0 0 1 0 16.62V2.38A2.4 2.4 0 0 1 2.42 0h24.16A2.4 2.4 0 0 1 29 2.38v14.25A2.4 2.4 0 0 1 26.58 19z'/%3E%3Cpath fill='%23FFF' d='M18.737 10.873h1.18c.034 0 .113-.01.146-.01a.527.527 0 0 0 .416-.53.546.546 0 0 0-.416-.528c-.033-.011-.1-.011-.146-.011h-1.18v1.08z'/%3E%3Cpath fill='%23FFF' d='M19.782 3.419c-1.124 0-2.046.91-2.046 2.046V7.59h2.89c.067 0 .146 0 .202.011.652.034 1.136.371 1.136.956 0 .461-.327.855-.934.933v.023c.664.045 1.17.416 1.17.99 0 .618-.563 1.023-1.305 1.023h-3.17v4.16h3.002c1.124 0 2.046-.91 2.046-2.047V3.42h-2.99z'/%3E%3Cpath fill='%23FFF' d='M20.333 8.692c0-.27-.191-.45-.416-.483-.022 0-.079-.012-.112-.012h-1.068v.99h1.068c.033 0 .1 0 .112-.011a.478.478 0 0 0 .416-.484zM8.47 3.419c-1.124 0-2.046.91-2.046 2.046v5.049c.574.28 1.17.46 1.766.46.708 0 1.09-.427 1.09-1.011V7.579h1.754V9.95c0 .922-.573 1.676-2.518 1.676-1.18 0-2.103-.259-2.103-.259v4.307h3.002c1.125 0 2.047-.911 2.047-2.047V3.418H8.47zM14.127 3.419c-1.125 0-2.047.91-2.047 2.046v2.676c.517-.438 1.417-.72 2.867-.652a9.124 9.124 0 0 1 1.608.247v.866a3.892 3.892 0 0 0-1.551-.45c-1.102-.078-1.766.461-1.766 1.406 0 .956.664 1.495 1.766 1.405.64-.045 1.135-.247 1.551-.45v.866s-.82.214-1.608.248c-1.45.067-2.35-.214-2.867-.652v4.722h3.002c1.125 0 2.047-.91 2.047-2.046V3.419h-3.002z'/%3E%3C/g%3E%3C/svg%3E"}
	];

	var cardLink;

	$(".card_number").on("input",function(e){
		let value = $(this).val();
	    let v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
	    let matches = v.match(/\d{4,16}/g);
	    let match = matches && matches[0] || ''
	    let parts = []

	    for (i=0, len=match.length; i<len; i+=4) {
	        parts.push(match.substring(i, i+4))
	    }

	    let cardType = "default";

	    if(v.match(/^4[0-9]{1,}$/)){
	    	cardType = "visa";
	    }else if(v.match(/^5[1-5][0-9]/) || (v.length == 3 &&  v.match(/^222/) ) || v.match(/^222[1-9]/)|| v.match(/^22[3-9][0-9]/) || v.match(/^2[3-6][0-9]/) || v.match(/^27[01][0-9]/) || v.match(/^2720[0-9]/)){
	    	cardType = "mastercard";
	    }else if(v.match(/^3[47]/)){
	    	cardType = "american-express";
	    }else if(v.match(/^3(?:0[0-5]|[68][0-9])/)){
	    	cardType = "diners";
	    }else if(v.match(/^6(?:011|5)/)){
	    	cardType = "discover";
	    }else if(v.match(/^(?:2131|1800|35[0-9])/) || v.match(/^3[01235689]/)){
	    	cardType = "jcb";
	    }else{
	    	cardType = "default";
	    }

	    cardLink = flags.filter(val => val.name == cardType);
	    if(cardLink.length){
	    	$('.card-image').attr("src",cardLink[0].value);
	    	$('input[name=card_type]').val(cardType);
	    }
	    if(v.length > 12){
	    	$('#bookAppoint .error-message').css('display','none');
	    }

	    if (parts.length) {
	        // return parts.join(' ');
	        $(this).val(parts.join(' '));

	    } else {
	    	// console.log(value);
	        return value;
	    }

	    
	})

 $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };

  $(".card_number").inputFilter(function(value) {
    return /^[\d\s]*$/.test(value);    // Allow digits only, using a RegExp
  });

  $(".cvc").inputFilter(function(value) {
    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
  });

  //book appointment by company
  $("#bookAppointCompany").validate({
		submitHandler: function(form){
			let BASE_URL = $('input:hidden[name=base_url]').val();
			$.ajax(
		    {
		        type: "POST",
		        url: `${BASE_URL}api/schedule_appointment`,
		        data: $(form).serialize(),
		        dataType: 'json',
				beforeSend: function(){
					$(".btn-booking").html('Submitting... <i class="fa fa fa-spinner fa-spin"></i>');
					$(".btn-booking").attr("disabled", true);
					$('#bookAppoint .success-message').css('display','none');
					$('#bookAppoint .error-message').css('display','none');
				},
				success: function (data) {
					$(".btn-booking").attr("disabled", false);
					$(".btn-booking").html('Complete Booking');
					let { status,message } = data;
					if(status == 'success'){
						window.location.href = `${BASE_URL}booking-success`;
					}else if(status == 'error'){
						$("html, body").scrollTop(100);
						$(".btn-booking").attr("disabled", false);
						$(".btn-booking").html('Complete Booking');
						$('#bookAppointCompany .error-message').css('display','block');
						$('#bookAppointCompany .error-message').html(message);
					}
				}
		       
		        
		    } )
		    },
        rules : {
    		company_name: {required: true},
    		reference_num: {required: true},
    		name: {required: true},
			last_name: {required: true},
			// phone: {required: true},
			// email : {required: true, email: true},
			month: {required: true},
			day: {required: true},
			year: {required: true},
			pickedYear: {required: true},
			// address: {required: true},
			// city: {required: true},
			// state: {required: true},
			// zip: {required: true},
			symptoms: {required: true},
		},
		
	});

});

