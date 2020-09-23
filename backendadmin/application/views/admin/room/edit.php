<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Room</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/room" class="btn btn-primary btn-icon-split">
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
              <form method="post" id="RoomEditform" role="form" action="<?php echo base_url();?>admin/room/update_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                  
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Room No*</label>
                      <input type="text" name="room_no" id="room_no" class="form-control"  value="<?php echo $row['room_no'];?>" required>
                    </div>
                </div>
                  <?php if(!empty($roomtype_list)){ ?>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Type*</label>
                        <select class="form-control" name="room_type_id"  id="room_type_id" required>
                           <option selected disabled>Please select</option> 
                           <?php foreach($roomtype_list as $row2){?>
                            <option value="<?php echo $row2['room_type_id'];?>" <?php if($row2['room_type_id']==$row['room_type_id']){ echo "selected"; }?>><?php //echo $row2['room_type_id'];?><?php echo $row2['room_type_name'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div>
              <?php } ?>
              <?php if(!empty($cafe_list)){ ?>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe*</label>
                        <select class="form-control" name="cafe_id"  id="cafe_id" required>
                           <option selected disabled>Please select</option> 
                           <?php foreach($cafe_list as $row1){?>
                            <option value="<?php echo $row1['cafe_id'];?>" <?php if($row1['cafe_id']==$row['cafe_id']){ echo "selected"; }?>><?php //echo $row1['cafe_id'];?><?php echo $row1['cafe_name']."-".$row1['cafe_place'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div>
              <?php } ?>
             
              <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Max Capacity*</label>
                       <input class="form-control" type="number" min="1"   name="no_of_people" id="no_of_people"  value="<?php echo $row['no_of_people'];?>"> 
                    </div>
                </div>
               <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Screen*</label>
                       <input class="form-control" type="number" min="1" step="0.01" name="screen_size" id="screen_size"  value="<?php echo $row['screen_size'];?>"> 
                    </div>
                </div>
               

                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Image</label>
                        <input type="file"  id="file-input" name="image" >
                       
                    </div>
                </div>
                 
                  <div class="col-md-4 col-sm-12 col-xs-12">
                 <span class="smaillimgupload" style="margin-top: 2px; display: inline-block; margin-bottom: 15px;">
                   <!--  <img src="<?php echo base_url();?>public/assets/img/110x110.png" id="blah2" style="height:100px;width:100px;"> -->
                   <?php if(!empty($row['image'])){?>
                        <img src="<?php echo base_url();?>public/upload_images/room_images/<?php echo $row['image'];?>" id="blah" style="height:100px;width:100px;">
                        <?php }else{?>
                         <span  style="text-decoration: none;"><img id="blah"></span>

                      <?php } ?>
                     
                   </span> 
					</div>
                 
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Description</label>
                       <textarea id="description" name="description" class="form-control" ><?php echo $row['description'];?></textarea>
                    </div>
                </div> 
               <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <input type="hidden" name="old_image" value="<?php echo $row['image'];?>">
                    <input type="hidden" name="room_id" value="<?php echo $row['room_id'];?>">
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