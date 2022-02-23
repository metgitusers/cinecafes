<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Food subcategory</h1>
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
              <form method="post" id="FoodSubAddform" role="form" action="<?php echo base_url();?>admin/foodcategory/addsub_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
             
               <?php if(!empty($cat_list)){ ?>
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Food Category*</label>
                        <select class="form-control" name="category_id"  id="category_id" required >
                           <option selected disabled>Please select</option> 
                           <?php foreach($cat_list as $row2){?>
                            <option value="<?php echo $row2['category_id'];?>" <?php if($row2['category_id']==$category_id){ echo "selected"; }?>><?php //echo $row2['category_id'];?><?php echo $row2['category_name'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div>
              <?php } ?>
               
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Subcategory</label>
                      <input type="text" name="subcategory_id" id="subcategory_id" class="form-control"  value="<?php echo set_value('subcategory_id');?>" required>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-xs-12">
                  <div class="form-group">
                     <button type="submit" class="btn btn-light px-5">Submit</button>
                       <!--  <input type="button" value="Submit"/>  -->
                     </div>
                </div>
            
            </div>          
          </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->