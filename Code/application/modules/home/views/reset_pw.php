<section class="serve">
<h2 class="mb-4 text-center text-uppercase">Change Password</h2>
<div class="mb-4 align-items-center">
<form action="" method="post" >
                      <?php if($this->session->flashdata('message')){?>
                      <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('message');?>
                      </div>
                      <?php }?>

                    <div class="form-group">
                      <label>New Password</label>
                      <input type="password" class="form-control" name="password">
                      <?=form_error('password')?>
                    </div>
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" name="re_password" id="re_password" value="">
                      <?=form_error('re_password')?>
                    </div>
                    <div class="form-group">
                      <input name="" type="submit" value="CHANGE PASSWORD" class="form-control button btn-primary">
                    </div>
                    
              </form>
            </div>
</section>