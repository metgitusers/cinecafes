<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add New Reservation</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/reservation" class="btn btn-primary btn-icon-split">
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
              <form method="post" id="CafeAddform" role="form" action="<?php echo base_url();?>admin/reservation/add_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
             
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Reservation Date*</label>
                      <input type="text" name="reservation_date" id="reservation_date" class="form-control"  value="<?php echo set_value('reservation_date');?>" required>
                    </div>
                </div>
               
                 <div class="col-md-4 col-sm-12 col-xs-12 r_time" style="display:none;">
                  <div class="form-group">
                      <label>Start time*</label>
                      <input type="text" name="reservation_time" id="reservation_time" class="form-control timepicker"  value="<?php echo set_value('reservation_time');?>" required >
                    </div>
                </div>
                 
               <div class="col-md-4 col-sm-12 col-xs-12 r_duration" style="display:none;">
                  <div class="form-group">
                    <label>Duration*</label>
                     <select class="form-control" id="duration" name="duration" required="required" > 
                      
                      
                    </select>
                    </div>
                </div> 

                <!-- <div class="col-md-4 col-sm-12 col-xs-12 r_end" style="display:none;">
                  <div class="form-group">
                      <label>End time*</label>
                      <input type="text" name="reservation_end_time" id="reservation_end_time" class="form-control"  value="<?php echo set_value('reservation_end_time');?>" readonly>
                    </div>
                </div> -->

                <div class="col-md-4 col-sm-12 col-xs-12 " >
                  <div class="form-group">
                    <label>No of Guests*</label>
                     <select class="form-control" id="no_of_guests" name="no_of_guests" required="required" >
                      <?php for($i=1; $i<=8;$i++)
                      {
                        echo "<option value='".$i."'>".$i."</option>";
                      }
                      ?>
                      
                    </select>
                    </div>
                </div> 

                <div class="col-md-4 col-sm-12 col-xs-12 " >
                  <div class="form-group">
                    <label>Cafe*</label>
                     <select class="form-control" id="cafe_id" name="cafe_id" required="required" onchange="populate_room(this.value);">
                      <option value=""> Select cafe</option>
                     <?php foreach($cafe_list as $row1){?>
                            <option value="<?php echo $row1['cafe_id'];?>" <?php //if($row1['id']==$row['cafe_id']){ echo "selected"; }?>><?php //echo $row1['cafe_id'];?><?php echo $row1['cafe_name']."-".$row1['cafe_place'];?></option>
                             <?php } ?>
                             </select>
                      
                    </select>
                    </div>
                </div> 
                <div class="col-md-4 col-sm-12 col-xs-12 " >
                  <div class="form-group">
                    <label>Room*</label>
                     <select class="form-control" id="room_id" name="room_id" required="required" >

                     </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 ">
                  <div class="form-group">
                    <label>Reservation Type*</label>
                     <select class="form-control" id="reservation_type" name="reservation_type" required="required" >
                        <option value="Online">Online</option>
                        <option value="Walkin">Walk-in</option>
                        <option value="Phone">Phone</option>
                      </select>
                      
                    </select>
                    </div>
                </div> 

                
                <div class="col-md-4 col-sm-12 col-xs-12 " >
                  <div class="form-group">
                    <label>Entertainment Media*</label>
                    <select class="form-control" id="media_type" name="media_type" required="required" >
                     <?php foreach($media_list as $row1){?>
                            <option value="<?php echo $row1['media_name'];?>" <?php //if($row1['id']==$row['cafe_id']){ echo "selected"; }?>><?php //echo $row1['cafe_id'];?><?php echo $row1['media_name'];?></option>
                             <?php } ?>
                      
                    </select>
                    </div>
                </div> 
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Reservation for*</label>
                      
                       <select class="form-control" id="reservation_for" name="reservation_for" required="required" onchange="reservation_type_change(this.value);" >
                        <option value="">Select</option>
                        <option value="1">Member</option>
                        <option value="2">Guest</option>
                       
                      </select>
                      
                    </select>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 member_dd" style="display: none;">
                  <div class="form-group">
                      <label>Member</label>
                      
                       <select class="form-control" id="user_id" name="user_id" onchange="member_data(this.value)">
                        <option value="">Select</option>
                        <?php foreach($member_list as $row1){?>
                            <option value="<?php echo $row1['user_id'];?>"><?php echo $row1['name'];?></option>
                             <?php } ?>
                       
                      </select>
                      
                    </select>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Mobile*</label>
                      <input type="text" name="mobile" id="mobile" class="form-control"  value="<?php echo set_value('mobile');?>" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Email Id</label>
                      <input type="text" name="email" id="email" class="form-control"  value="<?php echo set_value('email');?>" >
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Name*</label>
                      <input type="text" name="name" id="name" class="form-control"  value="<?php echo set_value('name');?>" required>
                    </div>
                </div>
                 
                 <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Message</label>
                       <textarea id="message" name="message" class="form-control" ><?php echo set_value('message');?></textarea>
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
