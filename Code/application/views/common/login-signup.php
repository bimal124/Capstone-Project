
<?php /*
<div class="inn p-5 text-center mt-5">
	<h4>Share Your Thoughts</h4>
	<p>Sign up to leave a comment.</p>
	<?php 
if(!$this->session->userdata(SESSION.'user_id')){?>
	<a href="" class="btn btn-outline-primary showLogin">Login </a>
	<a href="" class="btn btn-success showRegister">Signup </a>
<?php }else{?> 
	<a href="<?php echo base_url('my-account/user')?>" class="btn btn-outline-primary">Profile </a>
	
<?php } ?>
<hr>
</div>
*/?>
<input type="hidden" name="api_url" value="<?php echo base_url('api')?>">
<input type="hidden" name="base_url" value="<?php echo base_url()?>">

<!-- Login  -->
<div class="modal fade LoginPop" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content sickPop">
        <button type="button" class="close text-right mr-2" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h1 class="text-center mt-0"><b class="loginTitle">LOG IN</b></h1>
		<p class="mt-2 text-center mb-4">New to this site? <a href="" class="text-success modal-singup">Sign Up</a></p>
		<div class="alert alert-success success-message"  style="display: none;">
			</div>
			<div class="alert alert-danger error-message" style="display: none;">
			</div>
		<div class="socialLogin">
				<!-- <div class="fb-login-button" data-width="320px" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();"></div> -->


			<div id="googleSigninBtn" class="btn btn-primary btn-block mt-2">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 28 28">
                    <defs>
                        <clipPath id="clip-path">
                            <path style="fill:none;" d="M22.79,12.36H14.21v3.48h4.94c-.46,2.21-2.39,3.48-4.94,3.48A5.32,5.32,0,1,1,17.6,9.87l2.68-2.62A9.29,9.29,0,0,0,14.21,5,9.08,9.08,0,0,0,5,14a9.08,9.08,0,0,0,9.21,9A8.59,8.59,0,0,0,23,14,7.31,7.31,0,0,0,22.79,12.36Z"></path>
                        </clipPath>
                    </defs>
                    <g>
                        <path style="fill:#fff;" d="M26.45,0H1.55A1.55,1.55,0,0,0,0,1.55V26.45A1.55,1.55,0,0,0,1.55,28H26.45A1.55,1.55,0,0,0,28,26.45V1.55A1.55,1.55,0,0,0,26.45,0Z"></path>
                        <g style="clip-path:url(#clip-path);">
                            <path style="fill:#fbbc05;" d="M4.16,19.32V8.68L11.28,14Z"></path>
                        </g>
                        <g style="clip-path:url(#clip-path);">
                            <path style="fill:#ea4335;" d="M4.16,8.68,11.28,14l2.93-2.5,10-1.6V4.18H4.16Z"></path>
                        </g>
                        <g style="clip-path:url(#clip-path);">
                            <path style="fill:#34a853;" d="M4.16,19.32,16.72,9.91l3.31.41,4.23-6.14V23.82H4.16Z"></path>
                        </g>
                        <g style="clip-path:url(#clip-path);">
                            <path style="fill:#4285f4;" d="M24.26,23.82,11.28,14,9.6,12.77,24.26,8.68Z"></path>
                        </g>
                    </g>
                </svg>
				Log in with Google</div>

				<div class="text-center">
					<p class="mt-5 mb-4 bdr"><span>or</span></p>

					<a href="" class="btn btn-outline-dark btn-block toggleLogin">Log in with Email</a>
				</div>
		</div>

		<div class="emailLogin" style="display: none;">
			<form id="emailLoginForm">
				<p class="text-success reset_password_msg">
					<?php if($this->session->flashdata('reset_password')){?>
						<?php echo $this->session->flashdata('reset_password');?>
                      <?php }?>
				</p>
				<div class="form-group"><label>Email</label>
					<input type="text" name="email" placeholder="" class="form-control">
					<label class="error email-error" for="email"></label>
				</div>
				<div class="form-group"><label>Password</label>
					<input type="Password" name="password" placeholder="" class="form-control">
					<label class="error password-error" for="password"></label>
				</div>
				<p class="text-center"><a href="" class="text-dark forgotPasswordLink">Forgot Password?</a></p>
				<button class="btn btn-success btn-block btn-lg"> Log In</button>
			</form>
			<div class="text-center">
				<p class="mt-5 mb-4 bdr"><span>or </span></p>
				<a href="" class="btn btn-outline-dark btn-block toggleLogin">Quick Login</a>
				
			</div>
		</div>

			<div class="forgotPassword" style="display: none;">
				<form id="forgotPasswordForm">
					<div class="form-group"><label>Email</label>
						<input type="text" name="email" placeholder="" class="form-control" required="">
						<label class="error email-error" for="email"></label>
					</div>
					<p class="text-primary reset-link-sent"></p>
					<button class="btn btn-success btn-block btn-lg"> Send Password Reset Link</button>
				</form>
			</div>

    	</div>
    </div>
  </div>
  
  <!-- Login section ends here -->
<script type="text/javascript">
    var urlCheckDuplicateEmail='<?php echo base_url('home/email_taken') ?>';
</script>



  <!-- Register Signup -->
<div class="modal fade RegisterPop" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content sickPop">
        <button type="button" class="close text-right mr-2" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<div class=""><h1 class="text-center mt-0"><b>SIGN UP</b></h1>
			<p class="mt-2 text-center mb-4">Already a member? <a href="" class="text-success modal-login">Log in</a></p>
			<div class="alert alert-success success-message" data-dismiss="alert" aria-label="Close" style="display: none;">
			</div>
			<div class="alert alert-danger error-message" data-dismiss="alert" aria-label="Close" style="display: none;">
			</div>
			<div id="socialRegisterDiv"></div>
			<div class="socialRegister">
			<!-- <div class="fb-login-button" data-width="320px" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState1();"></div> -->


			<div class="btn btn-primary btn-block mt-2" id="googleSignupBtn">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 28 28">
                    <defs>
                        <clipPath id="clip-path">
                            <path style="fill:none;" d="M22.79,12.36H14.21v3.48h4.94c-.46,2.21-2.39,3.48-4.94,3.48A5.32,5.32,0,1,1,17.6,9.87l2.68-2.62A9.29,9.29,0,0,0,14.21,5,9.08,9.08,0,0,0,5,14a9.08,9.08,0,0,0,9.21,9A8.59,8.59,0,0,0,23,14,7.31,7.31,0,0,0,22.79,12.36Z"></path>
                        </clipPath>
                    </defs>
                    <g>
                        <path style="fill:#fff;" d="M26.45,0H1.55A1.55,1.55,0,0,0,0,1.55V26.45A1.55,1.55,0,0,0,1.55,28H26.45A1.55,1.55,0,0,0,28,26.45V1.55A1.55,1.55,0,0,0,26.45,0Z"></path>
                        <g style="clip-path:url(#clip-path);">
                            <path style="fill:#fbbc05;" d="M4.16,19.32V8.68L11.28,14Z"></path>
                        </g>
                        <g style="clip-path:url(#clip-path);">
                            <path style="fill:#ea4335;" d="M4.16,8.68,11.28,14l2.93-2.5,10-1.6V4.18H4.16Z"></path>
                        </g>
                        <g style="clip-path:url(#clip-path);">
                            <path style="fill:#34a853;" d="M4.16,19.32,16.72,9.91l3.31.41,4.23-6.14V23.82H4.16Z"></path>
                        </g>
                        <g style="clip-path:url(#clip-path);">
                            <path style="fill:#4285f4;" d="M24.26,23.82,11.28,14,9.6,12.77,24.26,8.68Z"></path>
                        </g>
                    </g>
                </svg>
			Sign up with Google</div>

			<div class="text-center">
				<p class="mt-5 mb-4 bdr"><span>or</span></p>
				<a href="" class="btn btn-outline-dark btn-block toggleRegister">Sign up with Email</a>
			</div>
		</div>

		<div class="emailRegister" style="display: none;">
			<!-- Social login form -->
			<form id="emailRegisterForm">
				
				<div class="form-group"><label>Email</label>
					<input type="text" name="email" placeholder="" class="form-control">
				</div>
				<div class="form-group"><label>Password</label>
					<input type="password" id="password" name="password" placeholder="" class="form-control">
				</div>
				<div class="form-group"><label>Confirm Password</label>
					<input type="password" name="re_password" placeholder="" class="form-control">
				</div>
				<div class="form-group mb-5"><label>Select User type</label>
					<select class="form-control" name="member_type">
						<option value="1">Private Patient</option>
						<option value="3">Company</option>
					</select>
				</div>
				<button class="btn btn-success btn-block btn-lg"> Sign Up</button>
			</form>

			<div class="text-center">
			<p class="mt-5 mb-4 bdr"><span>or</span></p>
			<a href="" class="btn btn-outline-dark btn-block toggleRegister">Quick Signup</a>
			
		</div>
		</div>
		<div class="form-check mt-5">
		  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="">
		  <label class="form-check-label" for="defaultCheck1">Join this site’s community. <a href="" id="community-read">Read more</a></label><p id="community-msg" style="display: none;">Connect with members of our site. Leave comments, follow people and more. Your nickname, profile image, and public activity will be visible on our site.</p>
		</div>
	
			</div>
    	</div>
    </div>
  </div>

<!-- Register signup ending -->
<style type="text/css">
	.modal {
  overflow-y:auto;
}
</style>