<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Package type</h1>
          <div class="form_panel"> 
             <?php if ($this->session->flashdata('Packagetype_success_message')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('Packagetype_success_message') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('Packagetype_error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('Packagetype_error_message') ?>
                </div>
            <?php endif ?>             
              <form method="post" id="PtypeAddform" role="form" action="<?php echo base_url();?>admin/packagetype/add_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Package*</label>
                      <input type="text" name="package_type_name" id="package_type_name" class="form-control"  value="<?php echo set_value('package_type_name');?>" required>
                    </div>
                </div>
               </div>
                 <div class="row">
                   <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                       <!--  <input type="button" value="Submit"/>  -->
                     </div>
                </div>
            
            </div>          
          </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->