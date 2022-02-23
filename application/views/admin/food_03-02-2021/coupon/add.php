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
                  <h4 class="card-title"><?=isset($details)?'Edit':'Add'?> Coupon</h4>
                  <a class="title_btn t_btn_list" href="<?= base_url('admin/food/coupon'); ?>">
                  <span><i class="fa fa-list-ul" aria-hidden="true"></i></span> Coupon List</a>
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
                    <form class="form custom_form_style" method="Post" action="<?= base_url(); ?>admin/food/coupon/store" enctype="multipart/form-data">
                    <input type="hidden" name="food_coupon_id" value="<?=isset($details)?$details['food_coupon_id']:''?>">
                      <div class="form-body">
                        <div class="row">	                        	
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Coupon Code <sup>*</sup></label>
                              <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required  name="coupon_code" value="<?=isset($details)?$details['coupon_code']:''?>">
                            </div>
                            <?php echo form_error('coupon_code', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Start Date <sup>*</sup></label>
                              <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control start-date" required  name="start_date" value="<?=isset($details)?date('d-m-Y', strtotime($details['start_date'])):''?>">
                            </div>
                            <?php echo form_error('start_date', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>End Date <sup>*</sup></label>
                              <input type="text" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control end-date" required  name="end_date" value="<?=isset($details)?date('d-m-Y', strtotime($details['end_date'])):''?>">
                            </div>
                            <?php echo form_error('end_date', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Minimum Purchase Amount <sup>*</sup></label>
                              <input type="number" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required  name="min_purchase_amount" value="<?=isset($details)?$details['min_purchase_amount']:''?>">
                            </div>
                            <?php echo form_error('min_purchase_amount', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>DISCOUNT AMOUNT/DISCOUNT PERCENTAGE <sup>*</sup></label>
                              <input type="number" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required  name="discount_amount" value="<?=isset($details)?$details['discount_amount']:''?>">
                            </div>
                            <?php echo form_error('discount_amount', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Maximum Uses Limit <sup>*</sup></label>
                              <input type="number" onkeypress="nospaces(this)" onkeyup="nospaces(this)" class="form-control" required  name="max_uses" value="<?=isset($details)?$details['max_uses']:''?>">
                            </div>
                            <?php echo form_error('max_uses', '<div class="error">', '</div>'); ?>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                            
                              <label>Coupon type <sup>*</sup></label>
                              <input type="radio" name="coupon_type" value="1" <?=isset($details)?$details['coupon_type']==1?'checked':'':'checked'?>> Flat
                              <input type="radio" name="coupon_type" value="2" <?=isset($details)?$details['coupon_type']==2?'checked':'':''?>> Percentage
                            <?php echo form_error('max_uses', '<div class="error">', '</div>'); ?>
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
                          
                            <div class="form-actions">
                              <a class="btn btn-danger mr-1" href="<?php echo base_url().'admin/food/coupon'; ?>"><i class="fa fa-times" aria-hidden="true"></i> Cancel</a>
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
$(document).ready(function() {
  $('.start-date').datepicker({
    format: 'dd-mm-yyyy',
    minDate: new Date(),
    //selectYears: true,
    selectMonths: true,
    onClose: function (date) {
      $( ".end-date" ).datepicker( "destroy" );
      var selectedDate = new Date(date);
      $('.end-date').datepicker({
        format: 'dd-mm-yyyy',
        minDate: selectedDate,
        //selectYears: true,
        selectMonths: true
      });
      }
  });
});

</script>