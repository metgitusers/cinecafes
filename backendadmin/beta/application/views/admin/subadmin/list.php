<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Subadmin List</h1>
           <p align="right"><a href="<?php echo base_url();?>admin/subadmin/add" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span></a></p>
          
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listing</h6>
            </div>
            <div class="card-body table_panel">
                <?php if ($this->session->flashdata('sub_success_message')) : ?>
                        <div class="alert alert-success">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                          <?php echo $this->session->flashdata('sub_success_message') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('sub_error_message')) : ?>
                        <div class="alert alert-danger">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                          <?php echo $this->session->flashdata('sub_error_message') ?>
                        </div>
                    <?php endif ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="mysubadmin" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL No.</th>                                                                                
                        <th>Name</th>
                        <!-- <th>Source</th> -->
                        <th>Mobile</th>
                        <th>Email</th>
                        
                        <th>Registered On</th>
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                       <th>Sl No.</th>
                          <th>Name</th>
                        <!-- <th>Source</th> -->
                        <th>Mobile</th>
                        <th>Email</th>
                        
                        <th>Registered On</th>
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if (!empty($list)) { 
                                //PR($member_active_list);
                        ?>
                        <?php     foreach ($list as $key => $row) { ?>
                        <tr>
                            
                            <td><?= $key + 1 ?></td>                                                                                        
                            <td><?= ucfirst($row['name']) ?></td>
                                                                                                                   
                           
                                                                                                    
                            <td><?php echo $row['mobile'] ?></td>
                            <td><a href="mailto:<?php echo $row['email']?>"><?php echo $row['email']?></a></td>                                                                                
                            
                            <td><?= date('d/m/Y',strtotime($row['created_date'])); ?></td>
                                                                          
                      <td>
                         <?php 
                 $buttonActive = (($row['status'] == 1)?'block':'none');
                 $buttonInActive = (($row['status'] == 0)?'block':'none');
                 echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="'.$row['user_id'].'" class="change-p-status" data-status="0" data-column_name="user_id" data-table="user"><p style="color:green;font-size: 15px;"> Active</p></a>
                <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="'.$row['user_id'].'" class="change-p-status" data-status="1" data-column_name="user_id" data-table="user"><p style="color:red;font-size: 15px;">  Inactive</p></a>';
                 ?>
                      </td>
                      
                      <td>
                         <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/subadmin/edit/<?php echo $row['user_id'];?>">
                      <i class="fas fa-edit" aria-hidden="true"></i> </a> 

                     
                       <a class="change-p-delete btn btn-danger btn-circle btn-sm" id="<?php echo $row['user_id']; ?>" data-column_name="user_id" data-table="user" href="javascriot:void(0);">
                        <i class="fa fa-trash" aria-hidden="true"></i> </a>
                       
                      
                      </td>
                    </tr>
                   
                    <?php
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="8">No Subadmin Found</td>
                          
                      </tr>
                      <?php } ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content-->
