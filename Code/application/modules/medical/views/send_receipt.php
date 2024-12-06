<div id="ReceiptErrorAlert" class="alert alert-danger alert-dismissible" style="display:none;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Please correct following errors:</h4>
    <div id="receiptFormValidationErrors"></div>
</div>
<div class="fill-up supper_admin">
    <form id="receiptForm" autocomplete="off">
        <div class="row form-group">
            <div class="col-md-3">
                <label>Physician:<span class="text-red">*</span></label>
            </div>
            <?php 
            $physician = "Dr. Ramesh Kharel, Baneshower-7, Kathmandu, Nepal"
            ?>
            <div class="col-md-9">
                <textarea class="form-control" rows="3" name="physician"><?php echo $physician?></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3">
                <label>Tax ID:<span class="text-red">*</span></label>
            </div>
            <div class="col-md-9">
                <input type="text" name="tax_id" class="form-control" value="26-4322487" readonly>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-3">
                <label>Patient Name:<span class="text-red">*</span></label>
            </div>
            <div class="col-md-9">
                <input type="text" name="patient_name" value="<?php echo $patient_info->name.' '.$patient_info->last_name?>" class="form-control">
            </div>
        </div>
        <?php 
        $address = $patient_info->address.' '.$patient_info->address2."\n".$patient_info->city.', '.$patient_info->state.' '.$patient_info->zip; 

        ?>
        <div class="row form-group">
            <div class="col-md-3">
                <label>Address:<span class="text-red">*</span></label>
            </div>
            <div class="col-md-9">
                <textarea class="form-control" rows="3" name="address"><?php echo $address;?></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3">
                <label>Medical Service:<span class="text-red">*</span></label>
            </div>
            <div class="col-md-9">
            	<textarea class="form-control" rows="3" name="appointment_type"><?php echo ($patient_info->appointment_type == '1')?'House Call':'Telemedicine'?></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3">
                <label>Date of Service:<span class="text-red">*</span></label>
            </div>
            <div class="col-md-9">
                <input type="text" name="post_date" class="form-control" value="<?php echo the_date($patient_info->post_date)?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3">
                <label>Diagnosis:<span class="text-red">*</span></label>
            </div>
            <div class="col-md-9">
                <textarea class="form-control" rows="3" name="diagnosis"></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3">
                <label>Amount Paid:<span class="text-red">*</span></label>
            </div>
            <div class="col-md-9">
                <input type="text" name="amount" class="form-control" value="<?php echo $this->general->formate_amount($patient_info->total_amount)?>">
            </div>
        </div>
        <input type="hidden" name="patient_id" value="<?php echo $patient_info->id?>">
    <div class="row">
        
        <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary btn-block" id="submit_receipt">SUBMIT</button>
        </div>
        <div class="form-group col-md-6">
        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">CANCEL</button>
        </div>
        
    </div>
    </form>
</div>

<script type="text/javascript">

        var send_receipt_url = '<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/medical/send_receipt';

    </script>

<script type="text/javascript">
	$("#receiptForm").validate({
	
      submitHandler: function(form){
        
        $.ajax({
			url : send_receipt_url,
			type : 'POST',
			datatype : 'json',
			data : $("#receiptForm").serialize(),
			beforeSend : function () {
				$("#submit_receipt").html('Sending...<i class="fa fa fa-spinner fa-spin"></i>');
				$("#submit_receipt").attr("disabled", true);
			},
			complete : function () {
				$("#submit_receipt").removeAttr("disabled");
				$("#submit_receipt").html('SUBMIT');
			},
			success : function (data) {
				
				var response = jQuery.parseJSON(data);
				let { status, message } = response;
				if (status == "success") {			
					setTimeout(function(){ 
		       			location.reload();
		       		}, 2000);			
				} else {					
					$("#ReceiptErrorAlert").show();
					$("#receiptFormValidationErrors").html(message);
				}
								
			}
		});
		return false;
      },
      // errorElement: 'span',
      
      rules: {
        
        physician:{
          required: true,
        },
        tax_id:{
          required: true,
        },
        patient_name:{
          required: true,
        },
        address:{
          required: true,
        },
        appointment_type:{
          required: true,
        },
        post_date:{
          required: true,
        },
        diagnosis:{
          required: true,
        },
        amount:{
          required: true,
        },
	  }

    });
</script>