<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Media</h1>
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
              <form method="post" id="MediaEditform" role="form" action="<?php echo base_url();?>admin/media/update_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                  
                  <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>Cafe*</label>
                      <select class="form-control" name="cafe_id"  id="cafe_id" required>
                        <option selected disabled>Please select</option>
                        <option value="0" <?php if($row['cafe_id']==0){ echo "selected"; }?>>All</option>
                        <?php foreach($this->CI->getCafeList() as $row1){?>
                          <option value="<?php echo $row1['cafe_id'];?>" <?php if($row1['cafe_id']==$row['cafe_id']){ echo "selected"; }?>><?php echo $row1['cafe_name']."-".$row1['cafe_place'];?></option>
                        <?php } ?>
                      </select>
                      <?php echo form_error('cafe_id', '<div class="error">', '</div>'); ?>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Media Name *</label>
                        <input type="text" name="media_name" id="media_name" class="form-control" value="<?php echo $row['media_name'];?>" required>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Media Order *</label>
                        <input type="text" name="media_order" id="media_order" class="form-control" value="<?php echo $row['media_order'];?>" required>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>Image *</label>
                      <input type="file"  id="file-input" name="imgInp">
                    </div>
                  </div>
                 
					<div class="col-md-12">
						<span class="smaillimgupload" style="margin-top: 2px; display: inline-block; margin-bottom: 15px;">
                   <!--  <img src="<?php echo base_url();?>public/assets/img/110x110.png" id="blah2" style="height:100px;width:100px;"> -->
                   <?php if(!empty($row['media_image'])){?>
                        <img src="<?php echo base_url();?>public/upload_images/media/<?php echo $row['media_image'];?>" id="blah" style="height:100px;width:100px;">
                        <?php }else{?>
                       <span  style="text-decoration: none;"><img id="blah"></span>

                      <?php } ?>
                     
                   </span>
					</div>
                 
                  
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <input type="hidden" name="old_image" value="<?php echo $row['media_image'];?>">
                    <input type="hidden" name="id" value="<?php echo $row['media_id'];?>">
                     <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
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