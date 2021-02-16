<style>
   .superr{
     color:red;
     font-size:18px;
     top: -.1px;
   }
   .error{
     color: #FF0000;
     font-size:15px;
    
   }
   .toggle-password {
    position: absolute;
    right: 25px;
    top: 54px;
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Change Password</h1>
           <!--  <p align="right"><a href="<?php //echo base_url();?>admin/cafe" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">List</span></a></p> -->
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
              <form  action="<?php echo base_url(); ?>admin/user/update_password" method="post"  id="changePswdForm">
                <div class="row">
             
              
              
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label for="inputPassword" class="col-form-label">Current Password *</label>
                      <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="******"  required="required">
               <span toggle="#oldpassword" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
                    </div>
                </div>
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                       <label for="inputPassword" class="col-form-label">New Password *</label>
                     <input type="password" class="form-control" name="password" id="password"  placeholder="******" required="required">
                 <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
                    
                    </div>
                </div>
                
             
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label for="inputPassword" class="col-form-label">Confirm Password *</label>
                      <input type="password" class="form-control" name="confirm_password"  id="confirm_password" placeholder="******"  required="required">
              <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
              <?php echo form_error('confirm_password', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
               
                
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                     <button  type="submit" class="btn btn-primary btn-user btn-block">Save</button>
                     </div>
                </div>
            
            </div>          
          </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
     