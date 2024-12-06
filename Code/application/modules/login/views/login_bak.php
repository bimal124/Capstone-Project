<form name="admin_login" action="" method="post" accept-charset="utf-8">
   <div class="loginbox">
    
      
    <div id="box">
        <h1></h1>
        <div style="color:red;" align="center">
            <?php echo validation_errors(); ?>
            <?php if($this->session->flashdata('message')) echo $this->session->flashdata('message');?>
        </div>
        <div class="boxinside">
            
            <div id="namefields">
                <div class="name">
                    Username :
                </div>
                <div class="txtfield"><input name="username" type="text"  /></div>
                <div class="clear"></div>
                <div class="name">
                    Password :
                </div>
                <div class="txtfield"><input name="password" type="password"  class="nm_txtfield" /></div>
                <div class="clear"></div>

                <div class="submit" style="margin-left:100px;">
                 
                    <input type="submit" value="Login" class="btn" />
                </div>
            </div>

            <div class="clear"></div>

        </div>


    </div>
</div>
</form>