<style>
  .toggle-password {
    position: absolute;
    right: 25px;
    top: 51px;
}

  .error{
   color: #FF0000;
   font-size: 15px;
    
}

</style>

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Subadmin</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/subadmin" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">Subadmin List</span></a></p>

          
             <?php if ($this->session->flashdata('sub_success_message')) : ?>
                        <div class="alert alert-success">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                          <?php echo $this->session->flashdata('sub_success_message') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('sub_error_message')) : ?>
                        <div class="alert alert-danger">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                          <?php echo $this->session->flashdata('sub_error_message') ?>
                        </div>
                    <?php endif ?>
                <div class="form_panel">            
               <form id="subadminAdd" method="Post" action="<?= base_url(); ?>admin/subadmin/add_content" enctype="multipart/form-data">
                <div class="row">
             
              
              
                
                <div class="col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                                <label>Select Role <sup>*</sup></label>
                               
                                  <select id="role_id" class="form-control" name="role_id" >
                                    <option selected disabled>Please select</option>
                                    <?php if(!empty($role_list)): ?>
                                    <?php   foreach($role_list as $rlist): ?>
                                              <option value="<?php echo $rlist['role_id'];?>" <?php if(set_value('role_id') ==$rlist['role_id']){ echo 'selected'; } ?>><?php echo $rlist['role_name'];?></option>
                                    <?php   endforeach; ?>
                                    <?php endif; ?>
                                  </select>
                                
                               
                              </div>
                </div>
            
              
             
              
              
                
                 <div class="col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                             
                                <label>Name <sup>*</sup></label>
                                <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required="" value="<?php echo set_value('name');?>" name="name">
                              </div>
                              <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                </div>
             

                
             
               
             
              
              
                
                 <div class="col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                             
                                <label>Email ID<sup>*</sup></label>
                                     <input type="email" onkeypress="nospaces(this)" onkeyup="nospaces(this)" name="email" class="form-control" value="<?php echo set_value('email');?>">
                                    </div>
                                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                                    <span class="error"> <?php echo $this->session->flashdata('email_error_msg') ?></span>
                </div>
                 <div class="col-md-6 col-sm-12 col-xs-12">
                   <div class="form-group">
                                      <label>Mobile <sup>*</sup></label>
                                      <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" name="mobile" class="form-control mobileNO" value="<?php echo set_value('mobile');?>" required="">
                                      <span></span>
                                    </div>
                                    <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                </div>
              


             
             
              
              
                
                 <div class="col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                             
                                 <label>Password <sup>*</sup></label>
                                      <input type="password" name="password" id="password" class="form-control"  value="<?php echo set_value('password');?>" required>
            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            <?php echo form_error('password','<span class="error">', '</span>'); ?>
                </div>
              </div>
                 <div class="col-md-6 col-sm-12 col-xs-12">
                   <div class="form-group">
                                       <label>Confirm Password<sup>*</sup></label>
                                         <input id="confirm_password" type="password" class="form-control" name="confirm_password" value=""  value="<?php echo set_value('confirm_password');?>" required>
           <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            <?php echo form_error('confirm_password','<span class="error">', '</span>'); ?>
          </div>
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