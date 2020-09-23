<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">User List</h1>
           <p align="right"><a href="<?php echo base_url();?>admin/member/add" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span></a></p>
          
        <form action="" method="post" autocomplete="off">   
                 <div class="row">
                   <div class="col-sm-3">
                    <div class="form-group reserform_panel">
                      <label>From Date</label>
                      <div class="input-group">
                          <input id="start_date" name="start_date" type="text" class="form-control" value="<?php if(!empty($start_date)): echo $start_date; endif;?>"  placeholder="YYYY/MM/DD" />
                          <div class="input-group-append">
                          <span class="input-group-text">
                            <span class="fa fa-calendar-o"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="col-sm-3">
                    <div class="form-group reserform_panel">
                      <label>To Date</label>
                      <div class="input-group">
                          <input id="end_date" name="end_date" type="text" class="form-control" value="<?php if(!empty($end_date)): echo $end_date;endif;?>" placeholder="YYYY/MM/DD" />
                          <div class="input-group-append">
                          <span class="input-group-text">
                            <span class="fa fa-calendar-o"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                 
                  <div class="col-sm-3">
                    <div class="form-group reserform_panel">
                      <label>App Registered</label>
                      <div class="input-group">
                        <select name="user_type" class="form-control">
                                                            
                          <option value="">All </option>
                          <option value="App" <?php if(!empty($user_type)&&$user_type=="App"){ echo "selected"; } ?>>Yes</option>
                          <option value="Web" <?php if(!empty($user_type) && $user_type=="Web"){ echo "selected"; } ?>>No</option>
                        </select>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                
                <div class="row">
              <div class='col-sm-2'>
                  <div class="form-group">
                  
                     <p style="text-align: right; margin-top: 2px;">
                 
                   <button type="submit"  class="btn btn-primary btn-user btn-block" id="search_btn">
                        <i class="fa fa-search" aria-hidden="true"></i> Search
                   </button>
                  </p>
                  </div>
                </div> 
                <div class='col-sm-2'>
                        <div class="form-group">
                        
                         <p style="text-align: left; margin-top: 2px;">
                          <button type="button" onclick="location.href='<?php echo base_url('admin/member');?>';" class="btn btn-primary btn-user btn-block">Reset</button></p>
                        </div>
                      </div>
           </div>
              </div>
            </form>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listing</h6>
            </div>
            <div class="card-body table_panel">
               <?php if ($this->session->flashdata('success_msg')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('error_message') ?>
                </div>
            <?php endif ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="myMemberList" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL No.</th>                                                                                
                        <th>Name</th>
                        <th>Source</th>
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
                        <th>Source</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        
                        <th>Registered On</th>
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if (!empty($member_all_list)) { 
                                //PR($member_active_list);
                        ?>
                        <?php     foreach ($member_all_list as $key => $actv_mem) { ?>
                        <tr>
                            
                            <td><?= $key + 1 ?></td>                                                                                        
                            <td class="name_space" =""><?= ucfirst($actv_mem['name']) ?></td>
                            <?php if($actv_mem['added_form'] == "Admin"): 
                                    $added_form  = 'Offline';
                                  elseif($actv_mem['added_form'] == "App"): 
                                    $added_form  = 'App';
                                  else: 
                                    $added_form  = 'Web';
                                  endif; 
                             ?>
                            <td><?= $added_form; ?></td>                                                                                        
                           
                                                                                                    
                            <td><?php echo $actv_mem['mobile'] ?></td>
                            <td><?php echo $actv_mem['email']?></td>                                                                                
                            
                            <td><?= date('d/m/Y H:i',strtotime($actv_mem['created_date'])); ?></td>
                                                                          
                      <td>
                         <?php 
                 $buttonActive = (($actv_mem['status'] == 1)?'block':'none');
                 $buttonInActive = (($actv_mem['status'] == 0)?'block':'none');
                 echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="'.$actv_mem['user_id'].'" class="change-p-status" data-status="0" data-column_name="user_id" data-table="user"><p style="color:green;font-size: 15px;"> Active</p></a>
                <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="'.$actv_mem['user_id'].'" class="change-p-status" data-status="1" data-column_name="user_id" data-table="user"><p style="color:red;font-size: 15px;">  Inactive</p></a>';
                 ?>
                      </td>
                      
                      <td>
                         <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/member/edit/<?php echo $actv_mem['user_id'];?>">
                      <i class="fas fa-edit" aria-hidden="true"></i> </a> 

                     
                       <a class="change-p-delete btn btn-danger btn-circle btn-sm" id="<?php echo $actv_mem['user_id']; ?>" data-column_name="user_id" data-table="user" href="javascriot:void(0);">
                        <i class="fa fa-trash" aria-hidden="true"></i> </a>
                       
                      
                      </td>
                    </tr>
                   
                    <?php
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="9">No user Found</td>
                          
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
