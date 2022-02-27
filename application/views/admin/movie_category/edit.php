<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Movie category</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/moviecategory" class="btn btn-primary btn-icon-split">
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
              <form method="post" id="MovieCatEditform" role="form" action="<?php echo base_url();?>admin/moviecategory/update_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
             
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Category*</label>
                      <input type="text" name="category_name" id="category_name" class="form-control"  value="<?php echo $row['category_name'];?>" required>
                      
                    </div>
                </div>
                <!--  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Subcategory</label>
                      <input type="text" name="subcategory_id" id="subcategory_id" class="form-control"  value="<?php echo set_value('subcategory_id');?>" required>
                    </div>
                </div> -->
                
              <!--   <div class="col-md-12 col-xs-12 col-xs-12">
                  <div class="form-group">
                    <input type="hidden" name="category_id" value="<?php // echo $row['category_id'];?>">
                     <button type="submit" class="btn btn-light px-5">Update</button>
                      
                     </div>
                </div> -->
              </div>
                 <div class="row">
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                      <input type="hidden" name="category_id" value="<?php echo $row['category_id'];?>">
                     <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                        <!--  <input type="button" value="Submit"/> -->
                     </div>
                </div>
            
            </div>
            
            </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->