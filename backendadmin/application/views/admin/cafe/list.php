<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Cafe</h1>
        <!--   <a class="" href="<?php echo base_url();?>admin/cafe/add">+Add</a> -->
         <p align="right"><a href="<?php echo base_url();?>admin/cafe/add" class="btn btn-primary btn-icon-split">
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
                <table class="table table-bordered" id="myCafe" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="8">Sl No.</th>
                      <th class="no-sort" width="25">Image</th>
                     <!--  <th>Item Name</th> -->
                      <th width="15">Cafe</th>
                      <th width="25">Address</th>
                     <!--  <th>Price</th> -->
                     <!--  <th>Start date</th> -->
                      <th class="no-sort" width="25">Status</th>
                      <th class="no-sort" width="25">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th width="8">Sl No.</th>
                      <th class="no-sort" width="25">Image</th>
                     <!--  <th>Item Name</th> -->
                      <th width="15">Cafe</th>
                      <th width="25">Address</th>
                     <!--  <th>Price</th> -->
                     <!--  <th>Start date</th> -->
                      <th class="no-sort" width="25">Status</th>
                      <th class="no-sort" width="25">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ ?>
                      <tr>
                      <td><?php echo $i;?></td>
                       <td>
                      
                        <?php if(!empty($cafe_img_list['image_list'][$row['cafe_id']])){
                                foreach($cafe_img_list['image_list'][$row['cafe_id']] as $ilist){;?>
                                  <img style="height:75px;width:75px;" src="<?php echo  base_url().'public/upload_images/cafe_images/'.$ilist['image']; ?>"  alt="Cafe Image">
                                       <?php  } ?>
                                       <?php  }else{ ?>
                                  <img  style="height:75px;width:75px;" src="<?php echo base_url();?>public/assets/img/110x110.png"  alt="Cafe Image">
                                       <?php  } ?>
                        
                      </td>
                     <!--  <td><?php echo $row['name'];?></td> -->
                      <td><?php echo $row['cafe_name'];?></td>
                      <td><?php echo $row['cafe_location'];?></td>
                     <!--  <td><?php echo $row['price'];?></td> -->
                      <td>
                         <?php 
                 $buttonActive = (($row['status'] == 1)?'block':'none');
                 $buttonInActive = (($row['status'] == 0)?'block':'none');
                 echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="activeBtn'.$row['cafe_id'].'" onclick="activeInactiveCafe(\''.$row['cafe_id'].'\',0);" class=""><p style="color:green; font-size: 15px;"> Active</p></a>
                <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="inactiveBtn'.$row['cafe_id'].'" onclick="activeInactiveCafe(\''.$row['cafe_id'].'\',1);" class=""><p style="color:red; font-size: 15px;">Inactive</p></a>';
                 ?>
                      </td>
                      <!-- <td><?php echo date('d-m-Y', strtotime($row['created_ts']));?></td> -->
                      <td>
                      <!--  <a class="" href="<?php echo base_url();?>admin/cafe/edit/<?php echo $row['cafe_id'];?>">
                       <i class="fa fa-pencil" aria-hidden="true"></i> Edit</a> -->  
                       <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/cafe/edit/<?php echo $row['cafe_id'];?>">
                       <i class="fas fa-edit" aria-hidden="true"></i> </a> 

                      <!--  <a class="" href="<?php echo base_url();?>admin/cafe/details/<?php echo $row['cafe_id'];?>">
                        <i class="fa fa-eye" aria-hidden="true"></i> </a> -->
                     
                      

                       <a class="delete_cafe btn btn-danger btn-circle btn-sm" id="<?php echo $row['cafe_id']; ?>" href="javascriot:void(0);">
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
                        <td colspan="6">No Cafe Found</td>
                          
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
     