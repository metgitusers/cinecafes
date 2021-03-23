<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
.pro_img {
    width: 120px;
    height: 120px;
    position: relative;
    display: inline-block;
    margin: 6px;
}

.delete_cafe_img {
    width: 27px;
    height: 27px;
    border: #f90000 1px solid;
    background-color: red;
    color: #fff;
    position: absolute;
    top: 7px;
    right: 6px;
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Cine Cafes</h1>
           <p align="right"><a href="<?php echo base_url();?>admin/cafe" class="btn btn-primary btn-icon-split">
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
              <form method="post" id="CafeEditform" role="form" action="<?php echo base_url();?>admin/cafe/update_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe Name*</label>
                      <input type="text" name="cafe_name" id="cafe_name" class="form-control"  value="<?php echo $row['cafe_name'];?>" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe Location*</label>
                      <input type="text" class="form-control"  name="cafe_place"  autocomplete="off" value="<?php echo $row['cafe_place'];?>"  required>
                    
                    </div>
                </div>
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe Address*</label>
                      <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control"  name="autocomplete"
                                     autocomplete="off" value="<?php echo $row['cafe_location'];?>" 
                                    required>
          
                    </div>
                    <?php //echo form_error('autocomplete','<span class="error">', '</span>'); ?>
                </div>
               <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Hourly Price*</label>
                       <input class="form-control" type="number" min="1" step=".1" name="price" id="price"  value="<?php echo $row['price'];?>"> 
                    </div>
                </div>
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Phone*</label>
                      <input type="text" name="phone" id="phone" class="form-control"  value="<?php echo $row['phone'];?>" required>
                    </div>
                </div>
                <!--  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Opening hours*</label>
                      <input type="text" name="opening_hours" id="opening_hours" class="form-control"  value="<?php //echo $row['opening_hours'];?>" required>
                    </div>
                </div> -->
                 <!--------------------------------------------------------->
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Start time*</label>
                      <input type="text" name="start_time" id="start_time1" class="form-control timepicker" value="<?php echo $row['start_time'];?>" required>
                    </div>
                </div>
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>End time*</label>
                      <input type="text" name="end_time" id="end_time1" class="form-control timepicker"  value="<?php echo $row['end_time'];?>" required>
                    </div>
                </div>
                   <!-- <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Closed On*</label>
                     <select class="form-control" id="open_days" name="open_days" >
                      <option selected disabled>Select Day</option>
                      <option value="all day open" <?php if($row['open_days']=='all day open'){ echo "selected";} ?>>All day open</option>
                      <option value="monday" <?php if($row['open_days']=='monday'){ echo "selected";} ?>>Monday</option>
                      <option value="tuseday" <?php if($row['open_days']=='tuseday'){ echo "selected";} ?>>Tuseday</option>
                      <option value="wednesday" <?php if($row['open_days']=='wednesday'){ echo "selected";} ?>>Wednesday</option>
                      <option value="thursday" <?php if($row['open_days']=='thursday'){ echo "selected";} ?>>Thursday</option>
                      <option value="friday" <?php if($row['open_days']=='friday'){ echo "selected";} ?>>Friday</option>
                      <option value="saturday" <?php if($row['open_days']=='saturday'){ echo "selected";} ?>>Saturday</option>
                      <option value="sunday" <?php if($row['open_days']=='sunday'){ echo "selected";} ?>>Sunday</option>
                    </select>
                    </div>
                </div>
 -->
                
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Image</label>
                      <!--  <input type="file"  id="file-input" name="images[]" multiple> -->
                       <input type="file" name="files[]" id="file-input" multiple accept="image/jpeg, image/png, image/gif,">
                       <!-- <span style="margin-top: 2px;"><img src="<?php echo base_url();?>public/assets/img/110x110.png" id="blah" style="heght:100px;width:100px;"></span>  -->
                    </div>
                </div>
                
                <?php if(!empty($img_list)){ ?>
                   <div class="col-md-12 col-sm-12 col-xs-12">
                   <!-- <img style="margin-top: 2px;height:120px;width:120px; display:none" id="blah" src=""> -->
                   <div class="product-media-img"> 
                   <?php foreach($img_list as $img){ ?>
                   <div class="pro_img">
                  <img style="margin-top: 2px;height:120px;width:120px;" id="blah_1" src="<?php echo base_url();?>public/upload_images/cafe_images/<?php echo $img['image'];?>" alt="Cafe Image" ><span> <a class="delete_cafe_img btn btn-danger btn-circle btn-sm" id="<?php echo $img['cafe_img_id']; ?>" href="javascriot:void(0);">
                        <i class="fas fa-trash"></i> </a></span>
                        <!-- <button  style="float:left"  class="btn pull-right btn-danger delete_pro_img" id="<?php echo $img['cafe_img_id']; ?>"><i class="fa fa-trash-o"></i></button> -->
                 <!--  <input type="hidden" name="cafe_img_name[]" id="cafe_img_name" value="<?php echo $img['image'];?>"> -->
           </div>
               <?php }?>
              <?php }else{?>
                      <!--  <span  style="text-decoration: none;"><img id="blah"></span> -->
                <?php } ?> 
             
               </div>
					</div>
                 <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Description</label>
                       <textarea id="cafe_description" name="cafe_description" class="form-control" ><?php echo $row['cafe_description'];?></textarea>
                    </div>
                </div> 
               
                 <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <!-- <input type="text" name="location_old" id="location_old" value="<?php echo  $row['cafe_location'];?>"> -->
                    <input type="hidden" name="cafe_id" id="cafe_id" value="<?php echo $row['cafe_id'];?>">
                     <button type="submit" class="btn btn-primary btn-user btn-block">Upadte</button>
                       
                     </div>
                </div> 
            
            </div>          
          </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBygzKjcQExaecyS1lz35vPwzLRhhqRBfk&libraries=geometry,places&ext=.js&callback=initAutocomplete" async defer></script>
    <!--  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBygzKjcQExaecyS1lz35vPwzLRhhqRBfk&libraries=places&callback=initAutocomplete" async defer></script>   -->

<script>
var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
       country: 'long_name',
        postal_code: 'short_name'
     };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
</script>