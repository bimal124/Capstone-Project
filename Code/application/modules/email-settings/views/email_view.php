<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?php echo $modules_name; ?>
    </h1>      
    <?php echo $this->breadcrumb->output(); ?>
  </section>
  <section class="content">
    <?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>
    </div>
    <?php } ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $modules_heading; ?></h3>
      </div>

      <div class="box-body" >
        <div class="row" >

                <div class="col-lg-12">

                    <div class="col-lg-12">

                        <table class="table table-striped">

                            <thead>

                                <tr>

                                    <th align="left"><div align="left">#</div></th>
                                    <th align="left"><div align="left">Subject</div></th>
                                    <th align="left"><div align="left">Code</div></th>

                                    <th align="left"><div align="left">Last Update</div></th>

                                    <th colspan="2" align="center" style="border-right:none;"><div align="center">Options</div></th>

                                </tr>



                            </thead>

                            <tbody class="item-display-container">

                                <?php

                                $i = 1;

                                if($email_data)

                                {



                                    foreach($email_data as $data)

                                    {

                                        ?>

                                        <tr> 

                                            <td align="left"><div align="left"><?php echo $i;?></div></td>

                                            <td align="left"><div align="left"><?php print($data->subject);?></div></td>
                                            <td align="left"><div align="left"><?php print($data->email_code);?></div></td>


                                            <td align="left"><div align="left"><?php print($this->general->date_time_formate($data->last_update));?></div></td>

                                            <td colspan="2" align="center" style="border-right:none;">

                                                <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/email-settings/edit/<?php print($data->id);?>/<?php print($data->email_code);?>" style="margin-right:5px;"><i class="fa fa-edit"></i></a>   
                                                 
                                                  </td>

                                              </tr>

                                              <?php

                                         $i++; }

                                          

                                      }else{

                                        ?>

                                        <tr> 

                                            <td colspan="7" align="center" style="border-right:none;"> (0) Zero Record Found </td>

                                        </tr>

                                        <?php

                                      }

                                      ?>

                                  </tbody>

                                </table>

                                

                            </div>

                        </div>

                    </div>
      </div>
    </div>
  </section>
  <div class="clear"></div>
</div>