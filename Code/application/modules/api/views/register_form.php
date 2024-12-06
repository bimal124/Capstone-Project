<form id="socialRegisterForm">
	<div class="form-group"><label>First Name</label>
		<input type="text" name="first_name" placeholder="" class="form-control" value="<?php echo $first_name?>">
	</div>
	<div class="form-group"><label>Last Name</label>
		<input type="text" name="last_name" placeholder="" class="form-control" value="<?php echo $last_name?>">
	</div>
	<div class="form-group"><label>Email</label>
		<input type="text" name="email" class="form-control" value="<?php echo $email?>" readonly>
	</div>
	<div class="form-group mb-5"><label>Select User type</label>
		<select class="form-control" name="member_type">
			<option value="1">Private Patient</option>
			<option value="3">Company</option>
		</select>
	</div>
	<button class="btn btn-success btn-block btn-lg"> Sign Up</button>
</form>

<script type="text/javascript">
	const API_URL = $('input:hidden[name=api_url]').val();
	const BASE_URL = $('input:hidden[name=base_url]').val();
	$("#socialRegisterForm").validate({
		submitHandler: function(form){
			$.ajax(
		    {
		        type: "POST",
		        url: `${API_URL}/social_register`,
		        data: $(form).serialize(),
		        dataType: 'json',
		        beforeSend: function(){
		        	$('.btn-lg').prop('disabled', true);
		       },
		       success: function (data) {
		       	let { status,message } = data;
	        	$('.btn-lg').prop('disabled', false);
		       	if(status == 'success'){
		       		$('.success-message').css('display','block');
		       		$('.success-message').html(message);
		       		window.location.href = `${BASE_URL}/my-account/user`;
		       	}
		       }
		       
		        
		    } )
		},
        rules : {
    		email : {required: true, email: true, checkDuplicateEmail:true},
    		first_name : {required: true},
    		last_name : {required: true}
		},
		
	});
</script>