<div class="main-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Basic form layout section start -->
      <section id="basic-form-layouts">
        <h1 class="h3 mb-2 text-gray-800"><?=isset($details)?'Edit':'Add'?> Food Category</h1>
            <p align="right">
                <a href="<?php echo base_url('admin/food/category');?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Food Category List</span>
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
                    <form class="form custom_form_style" method="Post" action="<?= base_url(); ?>admin/food/category/store" enctype="multipart/form-data">
                    <input type="hidden" name="food_category_id" value="<?=isset($details)?$details['food_category_id']:''?>">  
                      
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>Parent Category</label>
                              <select name="parent_category" class="form-control" 
                                            <?=isset($details)? empty($is_parent)?'disabled': '':''?>>
                              <option value="">--Select Parent-</option>
                              <?php
                                if($categories){
                                  foreach ($categories as $key => $cat) {
                                    ?>
                                      <option value="<?=$cat->food_category_id?>" 
                                            <?=isset($details)?$details['parent_category']==$cat->food_category_id?'selected':'':''?>
                                            ><?=$cat->category_name?></option>
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
