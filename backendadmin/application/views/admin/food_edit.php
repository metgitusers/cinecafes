<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Food</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/food" class="btn btn-primary btn-icon-split">
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
              <form method="post" id="FoodEditform" role="form" action="<?php echo base_url();?>admin/food/update_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
              <?php //if(!empty($cafe_list)){ ?>
              <!--   <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe*</label>
                        <select class="form-control" name="cafe_id"  id="cafe_id" required>
                           <option selected disabled>Please select</option> 
                           <?php foreach($cafe_list as $row1){?>
                            <option value="<?php echo $row1['cafe_id'];?>" <?php if($row1['cafe_id']==$row['cafe_id']){ echo "selected"; }?>><?php //echo $row1['cafe_id'];?><?php echo $row1['cafe_name'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div> -->
              <?php //} ?>
               <?php if(!empty($cat_list)){ ?>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Food Category*</label>
                        <select class="form-control" name="category_id"  id="category_id" required>
                           <option selected disabled>Please select</option> 
                           <?php foreach($cat_list as $row2){?>
                            <option value="<?php echo $row2['category_id'];?>" <?php if($row2['category_id']==$row['category_id']){ echo "selected"; }?>><?php //echo $row2['category_id'];?><?php echo $row2['category_name'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div>
              <?php } ?>
                <?php //if(!empty($food_variant_list)){ ?>
              <!--   <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Food Variant*</label>
                        <select class="form-control" name="food_variant_name"  id="food_variant_name" required>
                           <option selected disabled>Please select</option> 
                           <?php foreach($food_variant_list as $row2){?>
                            <option value="<?php echo $row2['name'];?>" <?php //if($row2['name']==$row['food_variant_name']){ echo "selected"; }?>><?php //echo $row2['id'];?><?php echo $row2['name'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div>  -->
              <?php // } ?>
              <!--  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Food Variant Price*</label>
                       <input class="form-control" type="number" min="1" name="food_variant_price" id="food_variant_price"  value="<?php echo $row['food_variant_price'];?>"> 
                    </div>
                </div> -->
               <?php //if(!empty($list)){ ?>
              <!--    <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Subcategory</label>
                       <select class="form-control" id="subcategory_id" name="subcategory_id" >
                  <option value="">Select subcategory</option>
                <?php foreach($sub_list as $val){?> 
                 <option value="<?php echo $val['category_id'];?>" <?php if($val['category_id']==$row['subcategory_id']){ echo "selected"; }?> ><?php echo $val['category_name'];?></option> 
                <?php }?>
              </select>
              <p style="font-size: 12px;color: red;margin: 0;">Please select category first and then select subcategory.</p>
                    </div>
                </div>  -->
              <?php //} ?>
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Item Name*</label>
                      <input type="text" name="name" id="name" class="form-control"   value="<?php echo $row['name'];?>" required>
                    </div>
                </div>
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Food Type*</label>
                      <input type="radio" id="veg_nonveg" name="veg_nonveg"  value="veg" <?php if($row['veg_nonveg']=='veg'){ echo "checked"; }?>> Veg
                      <input type="radio" id="veg_nonveg" name="veg_nonveg"  value="nonveg" <?php if($row['veg_nonveg']=='nonveg'){ echo "checked"; }?>> Non-veg
                    </div>
                </div>
                
               <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Price*</label>
                       <input class="form-control" type="number" min="1" name="price" id="price"  value="<?php echo $row['price'];?>" > 
                    </div>
                </div>

                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Image</label>
                       <input type="file"  id="file-input" name="image" >
                      
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                
                 <span class="smaillimgupload" style="margin-top: 2px; display: inline-block; margin-bottom: 15px;">
                        <?php if(!empty($row['image'])){?>
                        <img src="<?php echo base_url();?>public/upload_images/food_images/<?php echo $row['image'];?>" id="blah" style="height:100px;width:100px;">
                        <?php }else{?>
                            <span  style="text-decoration: none;"><img id="blah"></span>
                        <!-- <img style="text-decoration: none;margin-top: 2px;" id="blah" src=""> -->

                      <?php } ?>
                     </span> 
					
					</div>
                   <!--<div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Image*</label>
                       <input type="file" id="file-input" name="image" class="form-control">
                       <img  style="display:none;" src="<?php echo base_url();?>public/assets/img/110x110.png" id="blah" alt="User Image">
                </div> -->
                
                <!-- <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Phone No*</label>
                        <input type="tel" placeholder="9125365874"/>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Location*</label>
                        <input type="text" placeholder="Kolkata"/>
                    </div>
                </div> -->
                
                 <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Description</label>
                       <textarea id="description" name="description" class="form-control" ><?php echo $row['description'];?></textarea>
                    </div>
                </div> 
                
                
                
               <!--  <div class="col-md-12 col-xs-12 col-xs-12">
                  <div class="form-group">
                     <input type="hidden" name="old_image" value="<?php echo $row['image'];?>">
                    <input type="hidden" name="food_id" value="<?php echo $row['food_id'];?>">
                     <button type="submit" class="btn btn-light px-5">Update</button>
                        
                     </div>
                </div> -->

                 <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                   <input type="hidden" name="old_image" value="<?php echo $row['image'];?>">
                    <input type="hidden" name="food_id" value="<?php echo $row['food_id'];?>">
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