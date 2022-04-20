<!--Begin Page Content -->
        <div class="container-fluid">
                   
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">App Booking Discount</h6>
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
                      <th>Discount Percentage(%)</th>                        
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Sl No.</th>
                        <th>Discount Percentage(%)</th>
                        <th class="no-sort">Status</th>
                        <th class="no-sort">Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if (!empty($lists)) { 
                        foreach ($lists as $key => $list) { 
                        //PR($banner_active_list);                        
                        ?>
                          <tr>
                              <td><?= $key + 1 ?></td>                                                                                        
                              <td><?= $list['percentage'] ?></td>                                                                     
                              <td>
                              <?php 
                                $buttonActive = (($list['status'] == 1)?'block':'none');
                                $buttonInActive = (($list['status'] == 0)?'block':'none');
                                echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="'.$list['id'].'" class="change-p-status" data-status="0" data-column_name="id" data-table="appbookingdiscount"><p style="color:green;font-size: 15px;"> Active</p></a>
                                <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="'.$list['id'].'" class="change-p-status" data-status="1" data-column_name="id" data-table="appbookingdiscount"><p style="color:red;font-size: 15px;">  Inactive</p></a>';
                                ?>
                              </td>
                              <td>
                                <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/appbookingdiscount/edit/<?php echo $list['id'];?>">
                                  <i class="fas fa-edit" aria-hidden="true"></i> </a>                                                                              
                              </td>
                          </tr>                   
                    <?php
                    } 
                  }else{ ?>
                     <tr>
                        <td colspan="4">No record Found</td>                          
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
