<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Food</h1>
          <!-- <a class="" href="<?php echo base_url();?>admin/food/add">+Add</a> -->
          <p align="right"><a href="<?php echo base_url();?>admin/food/add" class="btn btn-primary btn-icon-split">
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
                <table class="table table-bordered" id="myFood" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>Image</th>
                      <th>Item Name</th>
                     <!--  <th>Cafe</th> -->
                      <th>Category</th>
                      <th>Price</th>
                      <th>Food Type</th>
                     <!--  <th>Food Varient</th> -->
                     <!--  <th>Start date</th> -->
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sl No.</th>
                      <th>Image</th>
                      <th>Item Name</th>
                     <!--  <th>Cafe</th> -->
                      <th>Category</th>
                      <th>Price</th>
                      <th>Food Type</th>
                     <!--  <th>Food Varient</th> -->
                     <!--  <th>Start date</th> -->
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ ?>
                      <tr>
                      <td><?php echo $i;?></td>
                       <td>
                      
                        <!-- <img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"> -->
                        <?php if(!empty($row['image'])){?>
                               
                                  <img style="height:35px;width:35px;" src="<?php echo  base_url().'public/upload_images/food_images/'.$row['image']; ?>"  alt="">
                                      
                                       <?php  }else{ ?>
                                  <img  style="height:35px;width:35px;" src="<?php echo base_url();?>public/assets/img/110x110.png"  >
                                       <?php  } ?>
                        
                      </td>
                      <td><?php echo $row['name'];?></td>
                      <!-- <td><?php echo $row['cafe_name'];?></td> -->
                      <td><?php echo $row['category_name'];?></td>
                      <td><?php echo $row['price'];?></td>
                      <td><?php echo $row['veg_nonveg'];?></td>
                      <!-- <td><?php echo $row['food_variant_name'];?></td> -->
                      <td>
                         <?php 
                 $buttonActive = (($row['status'] == 1)?'block':'none');
                 $buttonInActive = (($row['status'] == 0)?'block':'none');
                 echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="activeBtn'.$row['food_id'].'" onclick="activeInactive(\''.$row['food_id'].'\',0);" class=""><p style="color:green; font-size: 15px;"> Active</p></a>
                <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="inactiveBtn'.$row['food_id'].'" onclick="activeInactive(\''.$row['food_id'].'\',1);" class=""><p style="color:red; font-size: 15px;">Inactive</p></a>';
                 ?>
                      </td>
                      <!-- <td><?php echo date('d-m-Y', strtotime($row['created_ts']));?></td> -->
                      <td>
                        <a class="varient" href="<?php echo base_url();?>admin/food/variant/<?php echo $row['food_id'];?>">
                      Varient</a> 
                         <a class="varient" href="<?php echo base_url();?>admin/food/addon/<?php echo $row['food_id'];?>">
                        Addon</a> 
                         <!-- <a class="" href="<?php echo base_url();?>admin/food/edit/<?php echo $row['food_id'];?>">
                       <i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>  -->
                        <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/food/edit/<?php echo $row['food_id'];?>">
                       <i class="fas fa-edit" aria-hidden="true"></i> </a> 

                      <!--  <a class="" href="<?php echo base_url();?>admin/food/details/<?php echo $row['food_id'];?>">
                        <i class="fa fa-eye" aria-hidden="true"></i> </a> -->
                     
                      

                       <a class="delete_img btn btn-danger btn-circle btn-sm" id="<?php echo $row['food_id']; ?>" href="javascriot:void(0);">
                        <i class="fas fa-trash"></i> </a>
                      
                      </td>
                    </tr>
                    <!-- <tr>
                      <td>Tiger Nixon</td>
                      <td>System Architect</td>
                      <td>Edinburgh</td>
                      <td>61</td>
                      <td>2011/04/25</td>
                      <td>$320,800</td>
                    </tr>
                    <tr>
                      <td>Garrett Winters</td>
                      <td>Accountant</td>
                      <td>Tokyo</td>
                      <td>63</td>
                      <td>2011/07/25</td>
                      <td>$170,750</td>
                    </tr>
                    -->
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="7">No Food Found</td>
                          
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
        