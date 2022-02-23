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
                  <h4 class="card-title"><?=isset($details)?'Edit':'Add'?> Food items</h4>
                  <a class="title_btn t_btn_list" href="<?= base_url('admin/food/items'); ?>">
                  <span><i class="fa fa-list-ul" aria-hidden="true"></i></span> Item List</a>
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
                    <form class="form custom_form_style" method="Post" action="<?= base_url(); ?>admin/food/items/store" enctype="multipart/form-data">
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
                              </select>
                            </div>
                            </div>
                            <!--  -->
                            <div class="col-md-6">
                            <div class="form-group">
                              <label>Item Name <sup>*</sup></label>
                              <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required=""  name="item_name" value="<?=isset($details)?$details['item_name']:''?>">
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
                                            <input type="text" name="change_on[]" value="" placeholder="12.30 pm" class="form-control timepicker day-time-<?=$day?>">
                                            </div>
                                            <div class="col-md-3">
                                             <label>Change Price</label>
                                             <input type="number" step="1" class="form-control day-price-<?=$day?>"  name="change_price[]">
                                            </div>
                                            <div class="col-md-2">
                                            <label>Show/Hide</label>
                                            <input type="checkbox" name="change_visibility[]" value="<?=$day?>" class="form-control day-available">
                                            </div>
                                      </div>
                                      </div>
                                    <?php
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
  $.ajax({
        type: "POST",
        url: "<?=base_url('api/get-categories')?>",
        data: JSON.stringify(dataJson),
        datType: 'JOSN',
        success: function(res) {
            if (res.status.error_code == 0) {                
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

$(document).ready(function() {
  //time picker
  $('.timepicker').pickatime();

  $('.day-available').on('click', function(){
    if($(this).prop('checked')){
      let v = $(this).val();
      if($('.day-time-'+v).val()=="" || $('.day-price-'+v).val()==""){
        swalAlert("Please select Change on time & updated price", "warning");
        $(this).prop('checked', false);
      }
    }
  })

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

</script>