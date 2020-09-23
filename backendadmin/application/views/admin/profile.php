<style>
  .toggle-password {
    position: absolute;
    right: 25px;
    top: 40px;
}

  .error{
   color: #FF0000;
   font-size: 15px;
    
}

</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Profile</h1>
                 
                <div class="form_panel"> 


                    <?php if ($this->session->flashdata('profile_success_message')) : ?>
                        <div class="alert alert-success">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                          <?php echo $this->session->flashdata('profile_success_message') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('profile_error_message')) : ?>
                        <div class="alert alert-danger">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                          <?php echo $this->session->flashdata('profile_error_message') ?>
                        </div>
                    <?php endif ?>
               
                 
                    <form id="profileForm" method="Post" action="<?= base_url(); ?>admin/user/update_content" enctype="multipart/form-data">
                         <div class="row">
             
              
              
                
                <div class="col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                                <label>Name <sup>*</sup></label>
                                <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required="required" value="<?php echo $row['name'];?>" name="name" >
                              </div>
                            </div>
                              <div class="col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                                      <label>Mobile <sup>*</sup></label>
                                      <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" name="mobile" class="form-control" value="<?php echo $row['mobile'];?>" required="required">
                                      <span></span>
                                    </div>
                                    <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                                  </div>
                               
                            
                             <div class="col-md-6 col-sm-12 col-xs-12">
                  <div class="form-group">
                                        <label>Email ID<sup>*</sup></label>
                                        <input type="email" onkeypress="nospaces(this)" onkeyup="nospaces(this)" name="email" class="form-control" value="<?php echo $row['email'];?>" required="required">
                                    </div>
                                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                                    <span class="error"> <?php echo $this->session->flashdata('email_error_msg') ?></span>
                                  </div>
                               
                      <!--   <div class="col-md-12 form-actions">
                          <div class="col-md-2">
                            <input type="hidden"  name="user_id" class="form-control" value="<?php echo $row['user_id'];?>">
                            
                          <button type="submit" id="up_btn" class="btn btn-primary btn-user btn-block" >
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Update
                          </button>
                          </div>
                        </div> -->
                      </div>
                      <div class="row">
                   <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                     <input type="hidden"  name="user_id" class="form-control" value="<?php echo $row['user_id'];?>">
                            
                          <button type="submit" id="up_btn" class="btn btn-primary btn-user btn-block" >
                            <!-- <i class="fa fa-floppy-o" aria-hidden="true"></i> --> Update
                          </button>
                     </div>
                </div>
              </div>

            
          </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<script>
function nospaces(t){
    if(t.value.match(/\s/g) && t.value.length == 1){
        alert('Sorry, you are not allowed to enter any spaces in the starting.');

        t.value=t.value.replace(/\s/g,'');
    }
}
</script>
