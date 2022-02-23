<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Membership Benefit Management</h1>
            <p align="right"><a href="<?= base_url();?>admin/PackageBenefit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">Benefit List</span></a></p>
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
            <?php
                 if(empty($pck_benefit_data))
                   {
             ?>          
              <form class="form custom_form_style" method="post" action="<?= base_url();?>admin/PackageBenefit/save">
                <div class="row">
             
              
              
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label> Name<sup>*</sup></label>
                    <input onkeypress="nospaces(this)" type="text" class="form-control" name="benefit_name" required="required">
                    <?php echo form_error('benefit_name', '<div class="error">', '</div>'); ?>
                </div>
                </div>
              </div>
                 <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="form-group">
                    <label>Description<sup>*</sup></label>
                    <textarea  id="cms_description" name="benefit_description" required="required" rows="10" cols="80"></textarea>
                </div>
                <?php echo form_error('benefit_description', '<div class="error">', '</div>'); ?>
                </div>
                
              </div>
              
                 <div class="row">
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <!--  <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button> -->
                    <a class="btn btn-primary btn-user btn-block" href="<?php echo base_url().'admin/PackageBenefit'; ?>">
                                                  <i class="fa fa-times" aria-hidden="true"></i> Cancel
                                                </a>
                                               
                                                
                      
                     </div>
                </div>
                 <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <!--  <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button> -->
                   
                                               
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                     Submit
                                                </button>
                      
                     </div>
                </div>
            
            </div>          
         
        </form>
         <?php } else { ?>
                                        
                                        <form class="form custom_form_style" method="post" action="<?= base_url();?>admin/PackageBenefit/UpdateBenefit/<?=$pck_benefit_data['package_benefit_id']?>">

 <div class="row">
             
              
              
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                 <div class="form-group">
                                                            <label>Membership Name<sup>*</sup></label>
                                                            <input onkeyup=="nospaces(this)" onkeypress="nospaces(this)" type="text" class="form-control" name="benefit_name" required="required" value="<?=$pck_benefit_data['benefit_name']?>">
                                                        </div>
                </div>
              </div>
                 <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="form-group">
                                                            <label>Membership Description<sup>*</sup></label>
                                                            <textarea  onkeypress="nospaces(this)" onkeyup=="nospaces(this)" id="cms_description" name="benefit_description" required="required" rows="10" cols="80"><?=$pck_benefit_data['benefit_description']?></textarea>
                                                       </div>
                                                       <?php echo form_error('benefit_description', '<div class="error">', '</div>'); ?>
                </div>
                
              </div>
              <!-- 
                 <div class="row">
                <div class="col-md-4 col-xs-2 col-xs-2">
                  <div class="form-group">
                   
                    <a class="btn btn-danger mr-1" href="<?php //echo base_url().'admin/PackageBenefit'; ?>">
                                                  <i class="fa fa-times" aria-hidden="true"></i> Cancel
                                                </a>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Update
                                                </button>
                      
                     </div>
                </div>
            
            </div>  -->
              <div class="row">
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <!--  <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button> -->
                    <a class="btn btn-primary btn-user btn-block" href="<?php echo base_url().'admin/PackageBenefit'; ?>">
                                                  <i class="fa fa-times" aria-hidden="true"></i> Cancel
                                                </a>
                                               
                                                
                      
                     </div>
                </div>
                 <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <!--  <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button> -->
                   
                                               
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                     Update
                                                </button>
                      
                     </div>
                </div>
            
            </div>       



                                          </form>
                                        <?php
                                            }
                                        ?>



 </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
       <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
function nospaces(t){
    if(t.value.match(/\s/g) && t.value.length == 1){
        alert('Sorry, you are not allowed to enter any spaces in the starting.');
        t.value=t.value.replace(/\s/g,'');
    }

}
 CKEDITOR.replace('cms_description');
 CKEDITOR.config.basicEntities = false;
 $("form").submit( function(e) {
    var total_length    = CKEDITOR.instances['cms_description'].getData().replace(/<[^>]*>/gi, '').length;
    if(!total_length) {
        //$(".error").html('Please enter a description' );
        $.alert({
           type: 'red',
           title: 'Alert!',
           content: 'Please enter a description',
        });
        e.preventDefault();
    }
    else{
          ALERT("SDFSA"); 
          e.preventDefault(); 
    }
});     
</script>


     