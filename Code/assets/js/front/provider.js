$(function () {
	const MY_ACCOUNT_URL = $('input:hidden[name=MY_ACCOUNT_URL]').val();

	$('.schedulePatient').click(function(e){
		e.preventDefault();
		let patientDiv = $(this);
		let patient_id = $(this).attr('data-patient_id');
		let conf = confirm("Do you want to accept this patient?");
		if(conf == false){
			return false;
		}
		$.ajax(
	    {
	        type: "POST",
	        url: `${MY_ACCOUNT_URL}/provider/schedule_patient`,
	        data: { patient_id: patient_id },
	        dataType: 'json',
	        beforeSend: function(){
	        	$(patientDiv).html('<i class="fa fa fa-spinner fa-spin"></i>');
				$(this).attr("disabled", true);
	       },
	       success: function (data) {
	       	let { status,message } = data;
        	$('.btn-lg').prop('disabled', false);
	       	if(status == 'success'){
	       		alert(message);
	   //     		$('#schedulePatientForm .fa-spin').css('display','none');

	   //     		$('#schedulePatientForm .success-message').css('display','block');
	   //     		$('#schedulePatientForm .success-message').html(message);
	   //     		$(".btn-submit").html('Submit');
				// $(".btn-submit").attr("disabled", false);
				// setTimeout(function(){ 
	   //     			location.reload();
	   //     		}, 1000);
	       		location.reload();

	       	}
	       }
	       
	        
	    } )
		// $('#schedulePatientForm input:hidden[name=patient_id]').val(patient_id);
		// $('#SchedulePop').modal('show');
	});	


	$("#schedulePatientForm").validate({
		submitHandler: function(form){
			$.ajax(
		    {
		        type: "POST",
		        url: `${MY_ACCOUNT_URL}/provider/schedule_patient`,
		        data: $(form).serialize(),
		        dataType: 'json',
		        beforeSend: function(){
		        	$(".btn-submit").html('<i class="fa fa fa-spinner fa-spin"></i>');
					$(".btn-submit").attr("disabled", true);
		       },
		       success: function (data) {
		       	let { status,message } = data;
	        	$('.btn-lg').prop('disabled', false);
		       	if(status == 'success'){
		       		$('#schedulePatientForm .fa-spin').css('display','none');

		       		$('#schedulePatientForm .success-message').css('display','block');
		       		$('#schedulePatientForm .success-message').html(message);
		       		$(".btn-submit").html('Submit');
					$(".btn-submit").attr("disabled", false);
					setTimeout(function(){ 
		       			location.reload();
		       		}, 2000);

		       	}
		       }
		       
		        
		    } )
		    },
        rules : {
    		appointment_date : {required: true}
		},
		
	});

	$("#SchedulePop").on("hidden.bs.modal", function() {
		$(".btn-submit").attr("disabled", false);
		$(".btn-submit").html('Submit');
		$('.success-message').css('display','none');
	});

	$('.declinePatient').click(function(e){
		e.preventDefault();
		let patient_id = $(this).attr('data-patient_id');
		if(confirm("Do you want to continue?") == false){
			return false;
		}
		let btn = $(this);
		$.ajax(
		    {
		        type: "POST",
		        url: `${MY_ACCOUNT_URL}/provider/decline_patient`,
		        data: {patient_id: patient_id},
		        dataType: 'json',
		        beforeSend: function(){
		       		btn.html('<i class="fa fa fa-spinner fa-spin"></i>');
		       },
		       success: function (data) {
		       	let { status,message } = data;
		       	if(status == 'success'){
		       		alert('Declined !!');
		       		location.reload();
		       	}
		       }
		       
		        
		    } )
	});	

	$('.checkin-btn').click(function(e){
		e.preventDefault();
		let btn = $(this);
		let patient_id = $('input:hidden[name=patient_id]').val();
		let base_url = $('input:hidden[name=base_url]').val();
		// let checkinTime = $('input[name=checkin]').val();
		$.ajax(
		    {
		        type: "POST",
		        url: `${base_url}/my-account/report/checkin`,
		        data: {patient_id: patient_id},
		        dataType: 'json',
		        beforeSend: function(){
		        	btn.html('<i class="fa fa fa-spinner fa-spin"></i>');
		        	btn.attr("disabled", true);
		       		$('.checkin-success-message').css('display','none');
		       		$('.checkin-error-message').css('display','none');
		       },
		       success: function (data) {
		       	btn.html('Check in');
		       	let { status,message } = data;
		       	if(status == 'success'){
		       		$('.checkin-success-message').css('display','inline-block');
		       		$('.checkin-success-message').html(message);
		       	}
		       	if(status == 'error'){
		       		$("reportForm .btn-primary").attr("disabled", false);
		       		$('.checkin-error-message').css('display','inline-block');
		       		$('.checkin-error-message').html(message);
		       	}
		       }
		       
		        
		    } )
	});	

	$('.checkout-btn').click(function(e){
		e.preventDefault();
		let btn = $(this);
		let patient_id = $('input:hidden[name=patient_id]').val();
		let base_url = $('input:hidden[name=base_url]').val();
		// let checkoutTime = $('input[name=checkout]').val();
		// let checkinTime = $('input[name=checkin]').val();
		$.ajax(
		    {
		        type: "POST",
		        url: `${base_url}/my-account/report/checkout`,
		        data: {patient_id: patient_id},
		        dataType: 'json',
		        beforeSend: function(){
		        	btn.html('<i class="fa fa fa-spinner fa-spin"></i>');
		        	btn.attr("disabled", true);
		        	$('.checkout-success-message').css('display','none');
		        	$('.checkout-error-message').css('display','none');
		       },
		       success: function (data) {
		       	let { status,message } = data;
		       	btn.html('Check out');
		        	
		       	if(status == 'success'){
		       		$('.checkout-success-message').css('display','inline-block');
		       		$('.checkout-success-message').html(message);
		       		setTimeout(function(){ 
			       		window.location.href = `${base_url}my-account/provider/schedule`;
		       		}, 2000);
		       	}
		       	if(status == 'error'){
		       		btn.attr("disabled", false);
		       		$('.checkout-error-message').css('display','inline-block');
		       		$('.checkout-error-message').html(message);
		       	}
		       }
		    } )
	});	


	// Doctor add report
	$("#reportForm").validate({
		submitHandler: function(form){
			let base_url = $('input:hidden[name=base_url]').val();
			$.ajax(
		    {
		        type: "POST",
		        url: `${base_url}/my-account/report/update_report`,
		        data: $(form).serialize(),
		        dataType: 'json',
		        beforeSend: function(){
					$("reportForm .btn-primary").attr("disabled", true);
					$("#reportForm .fa-spin").css('display','inline-block');
					$('#reportForm .success-message').css('display','none');
		       },
		       success: function (data) {
		       	let { status,message } = data;
	       		$("#reportForm .btn-primary").attr("disabled", false);
	       		$("#reportForm .fa-spin").css('display','none');
		       	if(status == 'success'){
		       		$('#reportForm .success-message').css('display','block');
		       		$('#reportForm .success-message').html(message);
		       	}
		       }
		        
		    } )
		    },
        rules : {
    		age : {required: true},
    		gender : {required: true},
    		symptoms : {required: true},
    		past_medical_history : {required: true},
    		past_surgical_history : {required: true},
    		medications : {required: true},
    		allergies : {required: true},
    		social_history : {required: true},
    		family_history : {required: true},
    		// diagnosis : {required: true},
    		// plan : {required: true},
    		// rx : {required: true},
		},
		
	});

	$('#attachmentFile').change(function(e){
		e.preventDefault();    
		let base_url = $('input:hidden[name=base_url]').val();
		var formData = new FormData(attachmentForm);
		var file_data = $('#attachmentFile').prop('files')[0];   
	    formData.append('attachmentFile', file_data);
		$.ajax(
	    {
	        type: "POST",
	        url: `${base_url}/my-account/report/upload_attachment`,
	        data: formData,
		    cache: false,
	        contentType: false,
	        processData: false,
	        dataType: 'json',
	        beforeSend: function(){
	        	$("#attachmentForm .fa-spin").css('display','inline-block');
	       },
	       success: function (data) {
	       	let { status,message,attachment_html } = data;
	       	$("#attachmentForm .fa-spin").css('display','none');
	       	if(status == 'success'){
	       		$('#attachmentList').html(attachment_html);
	       	}
	       }
	    } )
	})

	$('#attachmentList').on('click','.remove-attachment',function(e){
		e.preventDefault();
		let attachment_id = $(this).attr('data-attachment_id');
		let base_url = $('input:hidden[name=base_url]').val();
		if(confirm("Do you want to continue?") == false){
			return false;
		}
		let btn = $(this);
		$.ajax(
		    {
		        type: "POST",
		        url: `${base_url}/my-account/report/remove_attachment`,
		        dataType: 'json',
		        data: {attachment_id: attachment_id},
		        beforeSend: function(){
		       		// btn.html('<i class="fa fa fa-spinner fa-spin"></i>');
		       },
		       success: function (data) {
		       	let { status,message,attachment_html } = data;
		       	$("#attachmentForm .fa-spin").css('display','none');
		       	if(status == 'success'){
		       		$('#attachmentList').html(attachment_html);
		       	}
		       }
		       
		        
		    } )
	});

	$('.share-report').click(function(e){
		let shareReport = $(this);
		e.preventDefault();
		let patient_id = $(this).attr('data-patient_id');
		let base_url = $('input:hidden[name=base_url]').val();
		$.ajax(
		    {
		        type: "POST",
		        url: `${base_url}/my-account/report/share`,
		        data: {patient_id: patient_id},
		        dataType: 'json',
		        beforeSend: function(){
		        	shareReport.html('<i class="fa fa fa-spinner fa-spin"></i>');
		       },
		       success: function (data) {
		       	let { status,message,share_html } = data;
		       	if(status == 'success'){
		       		shareReport.html('<i class="fa fa-check"></i>');
		       	}
		       }
		    } )
	});	



});