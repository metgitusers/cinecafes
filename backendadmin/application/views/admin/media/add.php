<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Media</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/media" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">List</span></a></p>
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
                         
              <form method="post" id="MediaAddform" role="form" action="<?php echo base_url();?>admin/media/add_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Media Name *</label>
                       
                         <input type="text" name="media_name" id="media_name" class="form-control"
                          value="<?php echo set_value('media_name');?>" 
                        required>
                      </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Media Order *</label>
                        <input type="text" name="media_order" id="media_order" class="form-control" value="<?php echo set_value('media_order');?>" required>
                    </div>
                  </div>
             
              

                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Image *</label>
                       <input type="file" id="file-input" name="imgInp" required="required">
                      
                    </div>
                </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  <span style="margin-top: 2px;" class="movieuuploadimg">
                   <span  style="text-decoration: none;"><img id="blah"></span></span> 
					       </div>
                 
                 
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