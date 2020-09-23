<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Hourly Price</h1>
            
          <div class="form_panel"> 
            <?php if ($this->session->flashdata('success_msg')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>             
              <form method="post" id="MediaEditform" role="form" action="<?php echo base_url();?>admin/setting/update_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Hourly Price*</label>
                     
                       <input type="number" name="cafe_price" id="cafe_price" class="form-control"
                        value="<?php echo $row['cafe_price'];?>" 
                      required>
                    </div>
                </div>
                  
                 
					
                  
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    
                     <button type="submit" class="btn btn-primary btn-user btn-block">Upadte</button>
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