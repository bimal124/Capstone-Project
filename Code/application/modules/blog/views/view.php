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

                <h3 class="box-title">View <?php echo $modules_heading; ?> Details</h3>
				<div class="box-tools"> <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH.'/blog/add'); ?>" id="select-all-mem" class="btn btn-sm btn-success" title="Add Member">Add <?=$modules_heading;?></a></div>
            </div>

            <!-- /.box-header -->

            <div class="box-body no-padding" >

            

            <div class="row" >

                <div class="col-lg-12">

                    <div class="col-lg-12">

                        <table class="table table-striped">

                            <thead>

                                <tr>

                                    <th align="left"><div align="left">Name</div></th>
                                    <th align="left"><div align="left">Content</div></th>                                    
                                    <th width="10%" align="left"><div align="left">Author</div></th>
                                    <th width="10%" align="left"><div align="left">Is Display?</div></th>
                                    <th width="10%" align="center"><div align="center">Post Date</div></th>
                                    <th width="5%" colspan="2" align="center" style="border-right:none;"><div align="center">Options</div></th>

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
                                            <td align="left"><div align="left"><?php print($data->name);?></div></td>
                                            <td align="left"><div align="left"><?php print(character_limiter(strip_tags($data->content),80));?></div></td>
                                            <td align="left"><div align="left"><?php print($data->blogger_name);?></div></td>
                                            <td align="left"><div align="left"><?php echo ($data->is_display==1)?"Yes":"No";?></div></td>
                                            <td align="left"><div align="center"><?php print($this->general->date_time_formate($data->post_date));?></div></td>
                                           
                                            <td colspan="2" align="center" style="border-right:none;">

                                                <a href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/blog/edit/<?php print($data->id);?>" style="margin-right:5px;" title="Edit"><i class="fa fa-edit"></i></a>   
                                                  <a  style="margin-left:5px;" href="<?php echo site_url(ADMIN_DASHBOARD_PATH);?>/blog/delete/<?php print($data->id);?>" onClick="return doconfirm();" title="Delete"><i class="fa fa-trash"></i></a>
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