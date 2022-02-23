<!--Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Wallet</h1>
      
        <!--  <p align="right"><a href="" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span></a></p> -->
        
			<div class="clearfix"></div>
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
                <table class="table table-bordered" id="myWallet" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="8">Sl No.</th>
                    
                      <th>Customer Details</th>                     
                      <th width="25">Wallet Balance</th>
                   
                      <th class="no-sort" width="25">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th width="8">Sl No.</th>
                      <th>Customer Details</th> 
                      <th width="25">Wallet Balance</th>
                    
                      <th class="no-sort" width="25">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ ?>
                      <tr>
                      <td><?php echo $i;?></td>
                     
                      <td><?php echo $row['name'];?>
                      <br><a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a>
                      <br><?php echo $row['mobile'];?></a></td> 
                      <td>Rs. <?php echo $row['wallet'];?></td> 
                   
                      <td>
                        <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/wallet/detail/<?php echo $row['user_id'];?>">
                        <i class="fa fa-eye" aria-hidden="true"></i> </a> 
                       </td>
                   
                    </tr>
                   
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="4">No Record Found</td>
                          
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
     