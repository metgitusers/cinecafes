<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Coupon</h1>
          <p align="right"><a href="<?php echo base_url();?>admin/coupon/add" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span></a></p>
           <!-- <a style="text-decoration: none" class="add_btn" href="<?php echo base_url();?>admin/room/add">+Add</a> -->
        

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
                <table class="table table-bordered" id="myCoupon" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>Coupon Code</th>
                      <th>Start on</th>
                      <th>End on</th>
                      <th>Coupon Type</th>
                      <th>Amount</th>
                      <th>Min Price</th>
                     <!--  <th>Created_on</th> -->
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sl No.</th>
                      <th>Coupon Code</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Coupon Type</th>
                      <th>Amount</th>
                      <th>Min. Price</th>
                     <!--  <th>Created_on</th> -->
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ ?>
                      <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['coupon_code'];?></td>
                     
                     <!--  <td><?php //echo date( 'd-M-Y h:ia', strtotime( $row['start_on'] ) );?></td>
                      <td><?php //echo date( 'd-M-Y h:ia', strtotime( $row['end_on'] ) );?></td> -->
                       <td><?php echo date( 'd-M-Y', strtotime( $row['start_on'] ) );?></td>
                      <td><?php echo date( 'd-M-Y', strtotime( $row['end_on'] ) );?></td>
                      <td><?php if($row['coupon_type']==0){echo "Fixed Amount";}else{echo "Percentage";}?></td>
                      <td>
                        <?php  if($row['coupon_type']==0){?>
                            <?php echo "Rs. ".'  '.$row['amount'];?>
                        <?php }else{?>
                            <?php echo $row['amount'].' '." %";?>
                        <?php } ?>
                      </td>
                      <td><?php echo "Rs. ".'  '.$row['min_price'];?></td>
                      
                     <!-- <td><?php echo date('d-m-Y', strtotime($row['created_on']));?></td>  -->
                      <td>
                         <?php 
                 $buttonActive = (($row['status'] == 1)?'block':'none');
                 $buttonInActive = (($row['status'] == 0)?'block':'none');
                 echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="activeBtn'.$row['coupon_id'].'" onclick="activeInactiveCoupon(\''.$row['coupon_id'].'\',0);" ><p style="color:green;font-size: 15px;"> Active</p></a>
                <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="inactiveBtn'.$row['coupon_id'].'" onclick="activeInactiveCoupon(\''.$row['coupon_id'].'\',1);" ><p style="color:red;font-size: 15px;">  Inactive</p></a>';
                 ?>
                      </td>
                      <!-- <td><?php echo date('d-m-Y', strtotime($row['created_ts']));?></td> -->
                      <td>
                         <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/coupon/edit/<?php echo $row['coupon_id'];?>">
                       <i class="fas fa-edit" aria-hidden="true"></i> </a> 

                      <!--  <a class="" href="<?php echo base_url();?>admin/food/details/<?php echo $row['coupon_id'];?>">
                        <i class="fa fa-eye" aria-hidden="true"></i> </a> -->
                     
                      

                       <a class="delete_coupon btn btn-danger btn-circle btn-sm" id="<?php echo $row['coupon_id']; ?>" href="javascriot:void(0);">
                        <i class="fa fa-trash" aria-hidden="true"></i> </a>
                       
                      
                      </td>
                    </tr>
                   
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="9">No Coupon Found</td>
                          
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
