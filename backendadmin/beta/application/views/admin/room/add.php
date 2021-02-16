<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Room</h1>
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
              <form method="post" id="RoomAddform" role="form" action="<?php echo base_url();?>admin/room/add_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Room No*</label>
                      <input type="text" name="room_no" id="room_no" class="form-control"  value="<?php echo set_value('room_no');?>" required>
                      <?php echo form_error('room_no', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
               
               <?php if(!empty($roomtype_list)){ ?>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Room type*</label>
                        <select class="form-control" name="room_type_id"  id="room_type_id" required>
                           <option selected disabled>Please select</option> 
                           <?php foreach($roomtype_list as $row2){?>
                            <option value="<?php echo $row2['room_type_id'];?>" <?php //if($row2['category_id']==$row['category_id']){ echo "selected"; }?>><?php //echo $row2['category_id'];?><?php echo $row2['room_type_name'];?></option>
                             <?php } ?>
                             </select>
                             <?php echo form_error('room_type_id', '<div class="error">', '</div>'); ?>
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
                            <option value="<?php echo $row1['cafe_id'];?>" <?php //if($row1['id']==$row['cafe_id']){ echo "selected"; }?>><?php //echo $row1['cafe_id'];?><?php echo $row1['cafe_name']."-".$row1['cafe_place'];?></option>
                             <?php } ?>
                             </select>
                             <?php echo form_error('cafe_id', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
               <?php } ?>
               <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Max Capacity*</label>
                       <input class="form-control" type="number" min="1"   name="no_of_people" id="no_of_people"  value="<?php echo set_value('no_of_people');?>"> 
                       <?php echo form_error('no_of_people', '<div class="error">', '</div>'); ?>
                    </div>
                </div>

               <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Screen*</label>
                       <input class="form-control" type="number" min="1" name="screen_size" id="screen_size"  value="<?php echo set_value('screen_size');?>"> 
                       <?php echo form_error('screen_size', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Image</label>
                       <input type="file" id="file-input-m" name="image[]" multiple>
                    </div>
                </div>
					  <div class="col-md-4 col-sm-12 col-xs-12">
						 <span style="margin-top: 2px;">
                <span  style="text-decoration: none; display: inline-flex;" class="image-preview">
                  <img width="100%" style="margin-bottom: 30px;" id="blah">
                 </span>
              </span> 
					  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Description</label>
                       <textarea id="description" name="description" class="form-control" ><?php echo set_value('description');?></textarea>
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
      <script>
  //////////////room image/////////////////////////////////////
function _readURL(input) {
var FileUploadPath = input.files;
if (FileUploadPath.length <= 0) {
    alert("Please upload an Image");
} else {
  var i = 0;
   for(i = 0; i< FileUploadPath.length; i++ ){
     //console.log(FileUploadPath[i]);
    var validExtensions = ["jpg","jpeg","png","gif"];
    var f = FileUploadPath[i].name.split('.').pop();
    //console.log(f);
    console.log(validExtensions.indexOf(f));
    if (validExtensions.indexOf(f) == 0) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $($.parseHTML('<img style="width:200px; height: 200px; margin: 7px;">')).attr('src', event.target.result).appendTo('.image-preview');
        }
        reader.readAsDataURL(input.files[i]);
    }
   }
  }
}
$("#file-input-m").change(function(){
  _readURL(this);
});
</script>