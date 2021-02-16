<div class="main-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Basic form layout section start -->
      <section id="basic-form-layouts">
      <h1 class="h3 mb-2 text-gray-800"><?=isset($details)?'Edit':'Add'?> Food items</h1>
            <p align="right">
                <a href="<?php echo base_url('admin/food/items');?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Food Item List</span>
                </a>
            </p>
            <p><span class="text"></span></a></p>
            <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="px-3">
                    <?php if ($this->session->flashdata('success_msg')) : ?>
                        <div class="alert alert-success">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                          <?php echo $this->session->flashdata('success_msg') ?>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('error_msg')) : ?>
                        <div class="alert alert-danger">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                          <?php echo $this->session->flashdata('error_msg') ?>
                        </div>
                    <?php endif ?>
                    <form class="form custom_form_style" method="Post" action="<?= base_url('admin/food/items/update/'.$details['food_item_id']); ?>" enctype="multipart/form-data">
                      <input type="hidden" name="food_item_id" value="<?=isset($details)?$details['food_item_id']:''?>">
                      <div class="form-body">
                        <div class="row"> 
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Food Category <sup>*</sup></label>
                              <select name="parent_category" id="parent_category" class="form-control">
                              <option value="">--Select Parent-</option>
                              <?php
                                if($categories){
                                  foreach ($categories as $key => $cat) {
                                    ?>
                                      <option value="<?=$cat->food_category_id?>" <?= isset($details)?$details['category_id'] == $cat->food_category_id?'selected':'':''?>><?=$cat->category_name?></option>
                                    <?php
                                  }
                                }
                              ?>
                              </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <!-- subcategory -->
                            <div class="form-group">
                              <label>Sub Category <sup>*</sup></label>
                              <select name="sub_category" id="sub_category" class="form-control">
                                <option value="">-- Select --</option>
                                <?php
                                  if(isset($details)){
                                    if($sub_categories){
                                      foreach ($sub_categories as $key => $cat) {
                                        ?>
                                          <option value="<?=$cat->food_category_id?>" <?= isset($details)?$details['sub_category_id'] == $cat->food_category_id?'selected':'':''?>><?=$cat->category_name?></option>
                                        <?php
                                      }
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                            </div>
                            <!--  -->
                            <div class="col-md-6">
                            <div class="form-group">
                              <label>Item Name <sup>*</sup></label>
                              <input type="text" maxlength="150" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required=""  name="item_name" value="<?=isset($details)?$details['item_name']:''?>">
                            </div>
                            </div>
                            <!-- <div class="col-md-6">
                            <div class="form-group">
                              <label>Item Price <sup>*</sup></label>
                              <input type="number" min="1" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required=""  name="price" value="<?=isset($details)?$details['price']:''?>">
                            </div>
                            </div> -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Item Description <sup>*</sup></label>
                                <textarea cols="4" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required=""  name="description"><?=isset($details)?$details['description']:''?></textarea>
                              </div>
                            </div>
                            <div class="col-md-12 item-available">
                              <div class="form-group">
                                <label>Select Day time <sup>*</sup></label>
                                <?php
                                  $day_array = $this->mcommon->select('food_item_available_days', ['food_item_id'=> $details['food_item_id'], 'status'=> 1], '*', 'food_item_available_day_id', 'ASC');
                                  if(!empty($day_array)){
                                  foreach ($day_array as $key => $day) {
                                    $this->db->where('food_item_available_day_id', $day->food_item_available_day_id);
                                    $row = $this->db->get('food_item_available_day_times')->row();
                                    
                                    ?>
                                      <h3><?=ucwords($day->day)?></h3>
                                      <div class="day_time_item">
                                      <div class="row">
                                        <input type="hidden" name="days[]" value="<?=$day->day?>">
                                            <div class="col-md-3">
                                              <label>Initial Price</label>
                                              <input type="number" step="0.001" class="form-control" required  name="price[]" value="<?=$day->price?>">
                                            </div>
                                            <div class="col-md-2">
                                            <label>Show/Hide</label>
                                            <div align="left"><input type="checkbox" value="<?=$day->day?>" name="visibility[]" class="form-control" <?=$day->is_seen==1?'checked':''?>></div>
                                            </div>
                                            <div class="col-md-2">
                                             <label>Change on</label>
                                            <input type="text" name="change_on[]" value="<?=!empty($row)?$row->time:''?>" placeholder="12.30 pm" class="form-control timepicker">
                                            </div>
                                            <div class="col-md-3">
                                             <label>Change Price</label>
                                             <input type="text" class="form-control" value="<?=!empty($row)?$row->price:''?>"  name="change_price[]">
                                            </div>
                                            <div class="col-md-2">
                                            <label>Show/Hide</label>
                                            <input type="checkbox" name="change_visibility[]" value="<?=$day->day?>" class="form-control" <?=!empty($row)?$row->is_seen==1?'checked':'':''?>>
                                            </div>
                                      </div>
                                      </div>
                                    <?php
                                  }
                                }else{
                                  $day_array = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                                  foreach ($day_array as $key => $day) {
                                    ?>
                                      <h3><?=ucwords($day)?></h3>
                                      <div class="day_time_item">
                                      <div class="row">
                                        <input type="hidden" name="days[]" value="<?=$day?>">
                                            <div class="col-md-3">
                                              <label>Initial Price</label>
                                              <input type="number" step="1" class="form-control" required  name="price[]">
                                            </div>
                                            <div class="col-md-2">
                                            <label>Show/Hide</label>
                                            <div align="left"><input type="checkbox" value="<?=$day?>" name="visibility[]" class="form-control" checked></div>
                                            </div>
                                            <div class="col-md-2">
                                             <label>Change on</label>
                                            <input type="text" name="change_on[]" value="" placeholder="12.30 pm" class="form-control timepicker">
                                            </div>
                                            <div class="col-md-3">
                                             <label>Change Price</label>
                                             <input type="number" step="1" class="form-control"  name="change_price[]">
                                            </div>
                                            <div class="col-md-2">
                                            <label>Show/Hide</label>
                                            <input type="checkbox" name="change_visibility[]" value="<?=$day?>" class="form-control">
                                            </div>
                                      </div>
                                      </div>
                                    <?php
                                  }
                                }
                                ?>
                              </div>
                            </div>
                            <?php if(isset($details)) {?>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label>Status <sup>*</sup></label>
                              <select name="status" class="form-control">
                                <option value="1" <?=$details['status']==1?'selected':''?>> Active</option>
                                <option value="0" <?=$details['status']==0?'selected':''?>> Inactive</option>
                              </select>
                            </div>
                            </div>
                            <?php } ?>
                            <div class="col-md-12">
                            <div class="form-actions">
                              <a class="btn btn-danger mr-1" href="<?php echo base_url('admin/food/items'); ?>"><i class="fa fa-times" aria-hidden="true"></i> Cancel</a>
                              <button type="submit" class="btn btn-success">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>


        </div>
      </section>
      <!-- // Basic form layout section end -->
    </div>
  </div>
</div>
<script type="text/javascript">

//onchange get subcatefory
$('#parent_category').on('change', function(){
  let dataJson = {
        source: 'MOB',
        parent_category: $(this).val()
    };
    $('#sub_category').html('');
  $.ajax({
        type: "POST",
        url: "<?=base_url('api/get-categories')?>",
        data: JSON.stringify(dataJson),
        datType: 'JOSN',
        success: function(res) {
            if (res.status.error_code == 0) {
                $('#sub_category').append('<option value="">-- Select --</option>');                
                let d= res.response.data;
                if(d.length > 0){
                  $.each(d, function(k, v){
                    $('#sub_category').append('<option value="'+v.food_category_id+'">'+v.category_name+'</option>');
                  })
                  $('#sub_category').focus();
                }
            } else {
                console.log(res.message);
            }
        },
    });
})
$("form").submit( function(e) {   
    var total_length    = CKEDITOR.instances['cms_description'].getData().replace(/<[^>]*>/gi, '').length;
    if(!total_length) {
      //alert(data_val);
        //$(".error").html('Please enter a description' );
        $.alert({
           type: 'red',
           title: 'Alert!',
           content: 'Please enter a zone description',
        });
        e.preventDefault();
    }
    else{
              
    }
});
$(document).ready(function() {
  //time picker
  $('.timepicker').pickatime();

  var dob_max_date = new Date();
  var doc_max_date = new Date();
  dob_max_date.setFullYear(dob_max_date.getFullYear() - 18);

  $('#dob').pickadate({
    format: 'dd-mm-yyyy',
    max: dob_max_date,
    selectYears: true,
    selectMonths: true,
    selectYears: 80
  });
  $('#doc').pickadate({
    format: 'dd-mm-yyyy',
    max: doc_max_date,
    selectYears: true,
    selectMonths: true,
    selectYears: 80
  });
});
function capacity_cking(){
  var min_capacity = $('.min_capacity').val();
  var max_capacity = $('.max_capacity').val();
  //alert(min_capacity+"%%%"+max_capacity);
  if(min_capacity !='' && max_capacity !=''){
    if(parseInt(min_capacity) > parseInt(max_capacity)){
      //alert(min_capacity+"%%%"+max_capacity);
      $.alert({
           type: 'red',
           title: 'Alert!',
           content: 'Max capacity should not be less than min capacity.',
      });
    }
  }
}

function readURL(input) {
  if (input.files && input.files[0]) {    
    var reader = new FileReader();    
    reader.onload = function(e) {
      $('#zone_image').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);    
    $("#zone_img_div").show();
  }
}

$("#zone_img").change(function() {
  var ext = $('#zone_img').val().split('.').pop().toLowerCase();
  if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
      alert('Accept file extention - .gif,.jpg,.png,.jpeg. Please upload vaild file');
  }
  else{
    readURL(this);
  }  
});
function validateNumber(mobnumber) {
    var filter = /^(\d{3})(\d{3})(\d{4})$/;
    if (filter.test(mobnumber)) {
      return true;
    } else {
      return false;
    }
}
$(document).on('keyup','.mobileNO',function(){
  var mobile_no = $(this).val();
  if(!validateNumber(mobile_no)){
    $(this).next('span').html('Please enter a valid mobile no.');
    $(this).next('span').css({'color':'red','font-size':'12px'});
  }
  else{
    $(this).next('span').html('');
  }
});
</script>