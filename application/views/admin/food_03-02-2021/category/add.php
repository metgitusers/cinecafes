<div class="main-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Basic form layout section start -->
      <section id="basic-form-layouts">
        <!--<div class="row">
          <div class="col-sm-12">
            <h2 class="content-header">Driver Master</h2>
          </div>
        </div>-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="page-title-wrap">
                  <h4 class="card-title"><?=isset($details)?'Edit':'Add'?> Category</h4>
                  <a class="title_btn t_btn_list" href="<?= base_url('admin/food/category'); ?>">
                  <span><i class="fa fa-list-ul" aria-hidden="true"></i></span> Category List</a>
                </div>


                <!--<p class="mb-0">This is the most basic and cost estimation form is the default position.</p>-->
              </div>
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
                    <form class="form custom_form_style" method="Post" action="<?= base_url(); ?>admin/food/category/store" enctype="multipart/form-data">
                    <input type="hidden" name="food_category_id" value="<?=isset($details)?$details['food_category_id']:''?>">  
                      
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>Parent Category</label>
                              <select name="parent_category" class="form-control">
                              <option value="">--Select Parent-</option>
                              <?php
                                if($categories){
                                  foreach ($categories as $key => $cat) {
                                    ?>
                                      <option value="<?=$cat->food_category_id?>" <?=isset($details)?$details['parent_category']==$cat->food_category_id?'selected':'':''?>><?=$cat->category_name?></option>
                                    <?php
                                  }
                                }
                              ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Category Name <sup>*</sup></label>
                              <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required=""  name="category" value="<?=isset($details)?$details['category_name']:''?>">
                            </div>
                            <?php if(isset($details)) {?>
                            <div class="form-group">
                              <label>Status <sup>*</sup></label>
                              <select name="status" class="form-control">
                                <option value="1" <?=$details['status']==1?'selected':''?>> Active</option>
                                <option value="0" <?=$details['status']==0?'selected':''?>> Inactive</option>
                              </select>
                            </div>
                            <?php } ?>
                            <div class="form-actions">
                              <a class="btn btn-danger mr-1" href="<?php echo base_url().'admin/food/category'; ?>"><i class="fa fa-times" aria-hidden="true"></i> Cancel</a>
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
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('cms_description');
CKEDITOR.config.basicEntities = false;
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