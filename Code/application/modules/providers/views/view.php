<?php

if($this->uri->segment(4))

    $status = $this->uri->segment(4);

else

    $status = '0';

?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            <?php echo $modules_name; ?>

        </h1>      

        <?php echo $this->breadcrumb->output(); ?>

    </section>

    <!-- Main content -->

    <section class="content">

        <?php if ($this->session->flashdata('message')) { ?>

            <div class="alert alert-success alert-dismissible">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('message'); ?></h4>

            </div>

        <?php } ?>

        <div class="alert alert-success alert-dismissible" id="msgSuccess" style="display:none;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4><i class="icon fa fa-check"></i> <span id="successMsg"></span></h4>

        </div>

        <div class="alert alert-danger alert-dismissible" id="msgError" style="display:none;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4><i class="icon fa fa-check"></i> <span id="errorMsg"></span></h4>

        </div>

        <div class="box">

            <div class="box-header with-border">

                <h3 class="box-title"><?php echo $modules_heading; ?></h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body no-padding" >

                <div class="row filter-sec" >

                    <div class="col-lg-12 data-search-inputs" style="padding-top:10px">

                        <div class="col-md-6">

                            <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/providers/add'); ?>" id="select-all-mem" class="btn btn-sm btn-success" title="Add Provider">Add Provider</a>

                        </div>



                        <div class="col-md-6 form-group text-right">

                            <?php

                            if($status!='1'){

                                ?>

                                <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/providers/index/1');?>" class="btn btn-sm btn-primary" title="Active Providers"><i class="fa fa-list"></i> Active Providers</a>

                                <?php

                            } else { 

                                ?>

                                <a href="#" class="btn btn-sm btn-default" title="Active Provider"><i class="fa fa-list"></i> Active Providers</a>

                                <?php

                            }

                            ?>



                            <?php

                            if($status!='0'){

                             ?>

                             <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/providers/index/0');?>" class="btn btn-sm btn-primary" title="Inactive Provider"><i class="fa fa-list"></i> Inactive Providers</a>

                             <?php

                         } else { 

                            ?>

                            <a href="#" class="btn btn-sm btn-default" title="Inactive Provider"><i class="fa fa-list"></i> Inactive Providers</a>

                            <?php

                        }

                        ?>



                        <?php
                        if($status!='2'){

                            ?>

                            <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/providers/index/2');?>" class="btn btn-sm btn-primary" title="Suspended Providers"><i class="fa fa-list"></i> Suspended Providers</a>

                            <?php

                        } else { 

                            ?>

                            <a href="#" class="btn btn-sm btn-default" title="Suspended Providers"><i class="fa fa-list"></i> Suspended Providers</a>

                            <?php

                        }

                        ?>



                        <?php
							/*
                        if($status!='2'){

                            ?>

                            <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/providers/index/2');?>" class="btn btn-sm btn-primary" title="Suspended Providers"><i class="fa fa-list"></i> Suspended Providers</a>

                            <?php

                        } else { 

                            ?>

                            <a href="#" class="btn btn-sm btn-default" title="Suspended Providers"><i class="fa fa-list"></i> Suspended Providers</a>

                            <?php

                        }
							*/
                        ?>                            

                    </div>    

                </div>

            </div>



            <div class="row">

                <form id="form1" name="form1" method="post" action="">

                    <div class="col-lg-12 data-search-inputs" style="padding-top:10px">

                        <div class="col-lg-12" >

                            <div class="col-lg-5 search-box" >

                                <div class="row">

                                    <div class="col-md-12">

                                        Search

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-9">

                                        <div class="form-group">

                                            <input type="text" class="form-control" name="srch" id="srch" placeholder="Search by Name/Contact/Email">

                                        </div>

                                    </div>
                                    
                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-primary" name="Search" id="search" value="Search">

                                        </div>

                                    </div>

                                </div>

                            </div>                            

                        </div>

                    </div>

                </form>

            </div>

            <div class="row" >

                <div class="col-lg-12">

                    <div class="col-lg-12">

                        <table class="table table-striped">

                            <thead>

                                <tr>

                                    <th align="left"><div align="left">Name</div></th>

                                    <th align="left"><div align="left">Contact</div></th>

                                    <th align="center"><div align="left">Email</div></th>

                                    <th align="center"><div align="left">Address </div></th>
                                    
                                    <th align="center"><div align="center">Status</div></th>

                                    <th colspan="2" align="center" style="border-right:none;"><div align="center">Options</div></th>

                                </tr>



                            </thead>

                            <tbody class="item-display-container">

                                <?php

                                $i = 1;

                                if($result_data)

                                {



                                    foreach($result_data as $data)

                                    {

                                        ?>

                                        <tr> 

                                            <td align="left"><div align="left"><?php print($data->first_name.' '.$data->last_name);?></div></td>

                                            <td align="left"><div align="left"><?php print($data->phone);?></div></td>

                                            <td align="left"><div align="left"><a href="mailto:<?php print($data->email);?>"><?php print($data->email);?></a></div></td>

                                            <td align="left"><div align="left"><?php print($data->address);?></div></td>

                                            <td align="left"><div align="center"><?php print($this->general->member_status($data->status));?></div></td>

                                            <td colspan="2" align="center" style="border-right:none;">
                                                <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/members/login_user/<?php print($data->id);?>" style="margin-right:5px;" title="Login this User" target="_blank"><i class="fa fa-lock"></i></a>

                                                <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/providers/edit/<?php print($status);?>/<?php print($data->id);?>" style="margin-right:5px;" title="Edit"><i class="fa fa-edit"></i></a>   
                                                  <a  style="margin-left:5px;" href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/providers/delete/<?php print($status);?>/<?php print($data->id);?>" onClick="return doconfirm();" title="Delete"><i class="fa fa-trash"></i></a>
                                                  <?php if($status=='0'){?>
                                                  <a  style="margin-left:5px;" href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/providers/member_activation_mail/<?php print($data->id);?>" title="Send Activation Mail"><i class="fa fa-repeat"></i></a> 
													<?php }?>
                                                  </td>

                                              </tr>

                                              <?php

                                          }

                                          $i++;

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

                                <?php

                                if($links)

                                {

                                    echo $links;

                                }

                                ?>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- /.box-body -->        

            </div>

        </section>

        <!-- /.content -->

    </div>

    <script type="text/javascript">

        function doconfirm()

        {

            job=confirm("Are you sure to delete permanently?");

            if(job!=true)

            {

                return false;

            }

        }

    </script>