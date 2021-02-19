<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Cine Cafes</h1>
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
              <form method="post" id="CafeAddform" role="form" action="<?php echo base_url();?>admin/cafe/add_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
             
              
              
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe Name*</label>
                      <input type="text" name="cafe_name" id="cafe_name" class="form-control"  value="Cine Cafes" readonly="readonly">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe Location*</label>
                      <input type="text" class="form-control"  name="cafe_place"  autocomplete="off" value="<?php //echo set_value('autocomplete');?>"  required>
                    
                    </div>
                </div>
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe Address*</label>
                      <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control"  name="autocomplete"  autocomplete="off" value="<?php //echo set_value('autocomplete');?>"  required>
                    
                    </div>
                </div>
                
              <!--  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Price*</label>
                       <input class="form-control" type="number" min="1" name="price" id="price"  value="<?php echo set_value('price');?>"> 
                    </div>
                </div> -->
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Phone*</label>
                      <input type="text" name="phone" id="phone" class="form-control"  value="<?php echo set_value('phone');?>" required>
                    </div>
                </div>
               <!--   <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Opening hours*</label>
                      <input type="text" name="opening_hours" id="opening_hours" class="form-control"  value="<?php //echo set_value('opening_hours');?>" required>
                    </div>
                </div> -->
                <!--------------------------------------------------------->
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Start time*</label>
                      <input type="text" name="start_time" id="start_time" class="form-control timepicker"  value="<?php echo set_value('start_time');?>" required>
                    </div>
                </div>
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>End time*</label>
                      <input type="text" name="end_time" id="end_time" class="form-control timepicker"  value="<?php echo set_value('end_time');?>" required>
                    </div>
                </div>
                <!-- <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Closed On*</label>
                     <select class="form-control" id="open_days" name="open_days" >
                      <option selected disabled>Select Day</option>
                      <option value="all day open" selected="selected">All day open</option>
                      <option value="monday">Monday</option>
                      <option value="tuseday">Tuseday</option>
                      <option value="wednesday">Wednesday</option>
                      <option value="thursday">Thursday</option>
                      <option value="friday">Friday</option>
                      <option value="saturday">Saturday</option>
                      <option value="sunday">Sunday</option>
                    </select>
                    </div>
                </div> -->

                <!---------------------------------------------------------->
                  

                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Image</label>
                    
                      
                      <input type="file" name="files[]" id="file-input" multiple accept="image/jpeg, image/png, image/gif,"> 
                       
                    </div>
                </div>
                 <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Description</label>
                       <textarea id="cafe_description" name="cafe_description" class="form-control" ><?php echo set_value('cafe_description');?></textarea>
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
