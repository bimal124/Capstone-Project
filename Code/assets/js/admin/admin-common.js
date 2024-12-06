$(document).ready(function() {
	 $('#datetime_picker').datetimepicker({
        format:'YYYY-MM-DD H:m',
         //minDate: new Date(),
    });
	 $('#start_datetime_picker').datetimepicker({
        format:'YYYY-MM-DD',
         //minDate: new Date(),
    });
    $('#end_datetime_picker').datetimepicker({
            //useCurrent: false, //Important! See issue #1075
            format:'YYYY-MM-DD',
           // minDate: new Date(),
        });
		
		$("#mailing_type").change(function () {
        if ($(this).val() == '3')
            $(".smtp").show();
        else
        {
            $(".smtp").hide();
        }
    });
});

$("#site_status").change(function () {
        if ($(this).val() == 'maintanance')
            $("#maintainance_key").show();
        else
        {
            $("#maintainance_key").hide();
        }
    });

$('#my-modal').modal({
        show: 'false'
    }); 


$(".assignProvider").click(function(e) {
	
	$("#patient_id").val($(this).data('id'));
	$('#assignProviderModal').modal('toggle');	
	
});

$(".sendReceipt").click(function(e) {
	e.preventDefault();
	let id = $(this).data('id');
	$.ajax({
			url : patient_receipt_url,
			type : 'POST',
			datatype : 'json',
			data : { id: id },
			beforeSend : function () {
				$(".send_receipt_html").html('<i class="fa fa fa-spinner fa-spin"></i>');
			},
			success : function (data) {
				var response = jQuery.parseJSON(data);
				let { status,message,receipt_form } = response;
				if (status == "success") {	
					$(".send_receipt_html").html(receipt_form);
				} else {					
					$(".send_receipt_html").html(message);
				}
				// var response = jQuery.parseJSON(data);
				// if (response.status == "success") {								
				// 	document.location.href = patients_history_url;
				// } else {					
				// 	$("#ProviderErrorAlert").show();
				// 	$("#providerFormValidationErrors").html(response.message);
				// }
								
			}
		});
	$('#sendReceiptModal').modal('toggle');	
	
});
	
$("#providerForm").validate({
	
      submitHandler: function(form){
        
        $.ajax({
			url : assign_provider_url,
			type : 'POST',
			datatype : 'json',
			data : $("#providerForm").serialize(),
			beforeSend : function () {
				$("#submit_provider").html('<i class="fa fa fa-spinner fa-spin"></i>');
				$("#submit_provider").attr("disabled", true);
			},
			complete : function () {
				$("#submit_provider").removeAttr("disabled");
				$("#submit_provider").html('SUBMIT');
			},
			success : function (data) {
				
				var response = jQuery.parseJSON(data);
				if (response.status == "success") {								
					document.location.href = patients_history_url;
				} else {					
					$("#ProviderErrorAlert").show();
					$("#providerFormValidationErrors").html(response.message);
				}
								
			}
		});
		return false;
      },
      errorElement: 'span',
      
      rules: {
        
        provider:{
          required: true,
        },
	  }

    });