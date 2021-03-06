<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-12 text-gray-800">Package Type</h1>
          
            <!-- <p align="right"><a href="<?php echo base_url();?>admin/packagetype/add" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span></a></p> -->
        

          <!-- DataTales Example -->
			<div class="clearfix"></div>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listing</h6>
            </div>
            <div class="card-body table_panel">
               <?php if ($this->session->flashdata('Packagetype_success_message')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('Packagetype_success_message') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('Packagetype_error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('Packagetype_error_message') ?>
                </div>
            <?php endif ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="myPackageType" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>Package Type Name</th>
                     <!--  <th>Created_on</th> -->
                     <!--  <th class="no-sort">Status</th> -->
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sl No.</th>
                      <th>Package Type Name</th>
                     <!--  <th>Created_on</th> -->
                     <!--  <th>Status</th> -->
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ ?>
                      <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['package_type_name'];?></td>
                      
                    <!--  <td>
                         <?php 
                 $buttonActive = (($row['status'] == 1)?'block':'none');
                 $buttonInActive = (($row['status'] == 0)?'block':'none');
                // echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="activeBtn'.$row['movie_id'].'" onclick="activeInactiveMovie(\''.$row['movie_id'].'\',0);" ><p style="color:green;font-size: 15px;"> Active</p></a>
               //<a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="inactiveBtn'.$row['movie_id'].'" onclick="activeInactiveMovie(\''.$row['movie_id'].'\',1);" ><p style="color:red;font-size: 15px;">  Inactive</p></a>';
                 ?>
                      </td> -->
                   <td>     
                  <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/packagetype/edit/<?php echo $row['package_type_id'];?>">
                      <i class="fas fa-edit" aria-hidden="true"></i> </a> 
                     
                      

                     <!--   <a class="delete_mcat btn btn-danger btn-circle btn-sm" id="<?php echo $row['package_type_id']; ?>" href="javascriot:void(0);">
                        <i class="fa fa-trash" aria-hidden="true"></i> </a> -->
                       
                      
                      </td>
                    </tr>
                   
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="3">No Package Type Found</td>
                          
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
