<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Cms</h1>
      
          <p align="right"><a href="<?php echo base_url('admin/cms/add');?>" class="btn btn-primary btn-icon-split">
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
               <?php if ($this->session->flashdata('success_message')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('success_message') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('error_message') ?>
                </div>
            <?php endif ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="myCms" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="8">Sl No.</th>
                     <!--  <th width="25">User ID</th> -->
                      <th width="15">Name</th>
                    
                      <!--<th width="25"> description</th>-->
                    <!--   <th class="no-sort" width="25">Status</th>-->
                      <th class="no-sort" width="25">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th width="8">Sl No.</th>
                    <!--   <th width="25">User ID</th> -->
                      <th width="15">Name</th>

                      <!--<th width="25">description</th>-->
                    <!--   <th class="no-sort" width="25">Status</th>-->
                      <th class="no-sort" width="25">Action</th> 
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ ?>
                      <tr>
                      <td><?php echo $i;?></td>
                     <!--  <td><?php// echo $row['user_id'];?></td> -->
                      <td><?php echo $row['page_name'];?></td>
                    
                      
                      <!--<td><?php //if(!empty($row['description'])){ echo substr($row['description'],0,40); }?>
                       <?php //if(strlen($row['content'])>40){ echo "...";}?></td>-->
                   
                      
                      <td>
                       
                       <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/cms/edit/<?php echo $row['page_id'];?>">
                       <i class="fas fa-edit" aria-hidden="true"></i> </a> 

                      <!--  <a class="" href="<?php echo base_url();?>admin/cafe/details/<?php echo $row['page_id'];?>">
                        <i class="fa fa-eye" aria-hidden="true"></i> </a> -->
                     
                      

                     <!--   <a class="delete_cafe btn btn-danger btn-circle btn-sm" id="<?php echo $row['page_id']; ?>" href="javascriot:void(0);">
                        <i class="fas fa-trash"></i> </a> -->
                      
                      </td>
                   
                    </tr>
                   
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="5">No Record Found</td>
                          
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
     