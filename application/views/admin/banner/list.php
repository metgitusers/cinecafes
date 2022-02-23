<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Banner List</h1>
           <p align="right"><a href="<?php echo base_url();?>admin/banner/add" class="btn btn-primary btn-icon-split">
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
                <table class="table table-bordered" id="mybannerList" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL No.</th>                                                                                
                        <th>image</th>
                        
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                       <th>Sl No.</th>
                          <th>Image</th>
                        
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if (!empty($banner_all_list)) { 
                                //PR($banner_active_list);
                        ?>
                        <?php     foreach ($banner_all_list as $key => $actv_mem) { 
                          if($actv_mem['banner_image'] != '')
                        {
                          $banner_image = '<img src="'.base_url().'public/upload_images/banner/'.$actv_mem['banner_image'].'"style="width:200px;">';
                        }else{
                          $banner_image = '<img src="'.base_url().'public/upload_images/No_Image_Available.jpg" style="width:200px;">';
                        }
                          ?>
                        <tr>
                            
                            <td><?= $key + 1 ?></td>                                                                                        
                            <td ><?= $banner_image ?></td>
                            
                                                                          
                      <td>
                         <?php 
                 $buttonActive = (($actv_mem['status'] == 1)?'block':'none');
                 $buttonInActive = (($actv_mem['status'] == 0)?'block':'none');
                 echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="'.$actv_mem['id'].'" class="change-p-status" data-status="0" data-column_name="id" data-table="banner"><p style="color:green;font-size: 15px;"> Active</p></a>
                <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="'.$actv_mem['id'].'" class="change-p-status" data-status="1" data-column_name="id" data-table="banner"><p style="color:red;font-size: 15px;">  Inactive</p></a>';
                 ?>
                      </td>
                      
                      <td>
                         <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/banner/edit/<?php echo $actv_mem['id'];?>">
                      <i class="fas fa-edit" aria-hidden="true"></i> </a> 

                     
                       <a class="change-p-delete btn btn-danger btn-circle btn-sm" id="<?php echo $actv_mem['id']; ?>" data-column_name="id" data-table="banner" href="javascriot:void(0);">
                        <i class="fa fa-trash" aria-hidden="true"></i> </a>
                       
                      
                      </td>
                    </tr>
                   
                    <?php
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="9">No banner Found</td>
                          
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
