<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Room Type</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/roomtype" class="btn btn-primary btn-icon-split">
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
              <form method="post" id="RoomtypeEditform" role="form" action="<?php echo base_url();?>admin/roomtype/update_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
             
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Room Type*</label>
                      <input type="text" name="room_type_name" id="room_type_name" class="form-control"  value="<?php echo $row['room_type_name'];?>" required>
                      
                    </div>
                </div>
                <!--  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Subcategory</label>
                      <input type="text" name="subcategory_id" id="subcategory_id" class="form-control"  value="<?php echo set_value('subcategory_id');?>" required>
                    </div>
                </div> -->
                </div>  
                 <div class="row">
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <input type="hidden" name="room_type_id" value="<?php echo $row['room_type_id'];?>">
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