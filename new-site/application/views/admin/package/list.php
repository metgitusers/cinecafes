<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Membership Package List</h1>
           <p align="right"><a href="<?php echo base_url();?>admin/package/add" class="btn btn-primary btn-icon-split">
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
               <?php if ($this->session->flashdata('Package Benefit_success_message')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('Package Benefit_success_message') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('Package Benefit_error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('Package Benefit_error_message') ?>
                </div>
            <?php endif ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="myMembershipPackage" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL No.</th>                                                                                
                        <th>Membership Name</th>
                        <!-- <th width='50%'>Membership Images</th> -->
                        <th >Membership Benefit</th>
                        <!-- <th width="25%">Membership Voucher</th> -->
                        <th>Membership Type</th>
                        <th>Membership Price</th>
                        <th>Membership Discount</th>
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                       <th>Sl No.</th>
                         <th>Membership Name</th>
                        <!-- <th width='50%'>Membership Images</th> -->
                        <th width="25%">Membership Benefit</th>
                        <!-- <th width="25%">Membership Voucher</th> -->
                        <th width="20%">Membership Type</th>
                      <th width="20%">Membership Price</th>
                        <th width="20%">Membership Discount</th>
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if (!empty($package_active_list['pkg_actv_data'])) { ?>
                        <?php     foreach ($package_active_list['pkg_actv_data'] as $key => $actv_pkg) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>  
                            <td><?= ucfirst($actv_pkg['package_name']); ?></td>
                            <!-- <td width='50%'>
                                <?php if(!empty($package_active_list['image_list'][$actv_pkg['package_id']])):
                                        foreach($package_active_list['image_list'][$actv_pkg['package_id']] as $ilist): ?>
                                            <div class="img_class" style="float:left"><img src="<?php echo  base_url().'public/upload_image/package_image/'.$ilist['images']; ?>" width="50px" height="50px"></div>
                                <?php      endforeach; ?>
                                <?php endif; ?>
                            </td> -->
                            <td width="25%">
                                <?php if(!empty($package_active_list['benifit_list'][$actv_pkg['package_id']])):?>
                                <?php      foreach($package_active_list['benifit_list'][$actv_pkg['package_id']] as $blist): ?>
                                            <?php echo  $blist['benefit_name']; ?></br>
                                <?php      endforeach; ?>
                                        </ul>
                                <?php endif; ?>
                            </td>
                            
                            <td width="20%">
                                <?= ucfirst($actv_pkg['package_type_name']); ?>
                            </td> 
                            <td width="20%">
                                <?= $actv_pkg['package_price']; ?>
                            </td> 
                            <td width="20%">
                                <?= $actv_pkg['discount_percent']; ?>%
                            </td> 
                                                                          
                      <td>
                         <?php 
                 $buttonActive = (($actv_pkg['status'] == 1)?'block':'none');
                 $buttonInActive = (($actv_pkg['status'] == 0)?'block':'none');
                 echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="'.$actv_pkg['package_id'].'" class="change-p-status" data-status="0" data-column_name="package_id" data-table="master_package"><p style="color:green;font-size: 15px;"> Active</p></a>
                <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="'.$actv_pkg['package_id'].'" class="change-p-status" data-status="1" data-column_name="package_id" data-table="master_package"><p style="color:red;font-size: 15px;">  Inactive</p></a>';
                 ?>
                      </td>
                      
                      <td>
                         <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/package/edit/<?php echo $actv_pkg['package_id'];?>">
                      <i class="fas fa-edit" aria-hidden="true"></i> </a> 

                     
                      

                       <a class="change-p-delete btn btn-danger btn-circle btn-sm" id="<?php echo $actv_pkg['package_id']; ?>" data-column_name="package_id" data-table="master_package" href="javascriot:void(0);">
                        <i class="fa fa-trash" aria-hidden="true"></i> </a>
                       
                      
                      </td>
                    </tr>
                   
                    <?php
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="9">No Membership Plan Found</td>
                          
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
