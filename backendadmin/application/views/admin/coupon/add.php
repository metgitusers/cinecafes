<style>
  .error{
   position:absolute;
   margin-top: 2px;
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Coupon</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/coupon" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">List</span></a></p>
          <div class="form_panel"> 
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
              <form method="post" id="CouponAddform" role="form" action="<?php echo base_url();?>admin/coupon/add_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Coupon Code*</label>
                      <input type="text" name="coupon_code" id="coupon_code" class="form-control"  value="<?php echo set_value('coupon_code');?>" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Start on*</label>
                       <input class="form-control" type="text"  name="start_on" id="start_on"  value="<?php echo set_value('start_on');?>"> 
                    </div>

                </div>
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>End on*</label>
                       <input class="form-control" type="text"  name="end_on" id="end_on"  value="<?php echo set_value('end_on');?>"> 
                    </div>

                </div>
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Select coupon Type*</label>
                      <input type="radio" id="coupon_type" name="coupon_type"  value="0" <?php //if($row['coupon_type']==0){ echo "checked"; }?>> Fixed
                      <input type="radio" id="coupon_type" name="coupon_type"  value="1" <?php //if($row['coupon_type']==1){ echo "checked"; }?>> Variable
                    </div>
                    
                </div>
                
                <span class="error"></span>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Amount*</label>
                       <input class="form-control" type="number" min="1" name="amount" id="amount"  value="<?php echo set_value('amount');?>"> 
                    </div>
                </div>
                
                <!--  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Min Price</label>
                       <input class="form-control" type="number" min="1" name="min_price" id="min_price"  value="<?php echo set_value('min_price');?>"> 
                    </div>
                </div> -->
               <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                        <!--  <input type="submit" name="submit" value="Submit"/> -->
                     </div>
                </div>
            
            </div>          
          </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->