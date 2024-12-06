<div class="login-box-body">

	

            	

                <div class="bodysec">

                <header>Forget  Your Pasword</header>

                	<?php echo form_open('',array('id' => 'adminForgetForm','autocomplete' => 'off'));  ?>

                    	<fieldset>

                        	<?php if($message): ?>

                            <div  class="message">

                            	<p><?php echo $message; ?></p>

                            </div>

                            <?php endif; ?>

                        	<p>

                            A reset link has been sent to your email address. Please check your email to continue with resetting the password. The link will expire in next 24 hours.

                            </p>

                        </fieldset>

                        

                    <?php echo form_close(); ?>

                  <footer>

                	© 2013 <a href="<?php echo site_url();?>">Penny Auction</a>. ALL RIGHTS RESERVED.

                </footer>

                </div>

             

             

</div>