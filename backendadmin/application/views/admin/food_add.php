<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Food</h1>
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
              <form method="post" id="FoodAddform" role="form" action="<?php echo base_url();?>admin/food/add_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
              <?php // if(!empty($cafe_list)){ ?>
               <!--  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe*</label>
                        <select class="form-control" name="cafe_id"  id="cafe_id" required>
                           <option selected disabled>Please select</option> 
                           <?php //foreach($cafe_list as $row1){?>
                            <option value="<?php //echo $row1['cafe_id'];?>" <?php //if($row1['id']==$row['cafe_id']){ echo "selected"; }?>><?php //echo $row1['cafe_id'];?><?php //echo $row1['cafe_name'];?></option>
                             <?php //} ?>
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
                            <option value="<?php echo $row2['category_id'];?>" <?php //if($row2['category_id']==$row['category_id']){ echo "selected"; }?>><?php //echo $row2['category_id'];?><?php echo $row2['category_name'];?></option>
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
                            <option value="<?php echo $row2['name'];?>" <?php //if($row2['id']==$row['id']){ echo "selected"; }?>><?php //echo $row2['id'];?><?php echo $row2['name'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div> --> 
              <?php //} ?>
               <!-- <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Food Variant Price*</label>
                       <input class="form-control" type="number" min="1" name="food_variant_price" id="food_variant_price"  value="<?php echo set_value('food_variant_price');?>"> 
                    </div>
                </div> -->
               <?php //if(!empty($list)){ ?>
                <!--  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Subcategory</label>
                       <select class="form-control" id="subcategory_id" name="subcategory_id" >
                  <option value="">Select subcategory</option>
                <?php //foreach($sub_list as $val){?> 
                <!-- <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option> -->
                <?php //}?>
             <!--  </select> -->
             <!--  <p style="font-size: 12px;color: red;margin: 0;">Please select category first and then select subcategory.</p> -->
                    <!--</div>
                </div>  -->
              <?php //} ?>
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Item Name*</label>
                      <input type="text" name="name" id="name" class="form-control"  value="<?php echo set_value('name');?>" required>
                    </div>
                </div> 
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Food Type*</label>
                      <input type="radio" id="veg_nonveg" name="veg_nonveg"  value="veg" checked> Veg
                      <input type="radio" id="veg_nonveg" name="veg_nonveg"  value="nonveg"> Non-veg
                    </div>
                </div>
                
               <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Price*</label>
                       <input class="form-control" type="number" min="1" name="price" id="price"  value="<?php echo set_value('price');?>"> 
                    </div>
                </div>
                

                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Image</label>
                       <input type="file"  id="file-input" name="image" >
                       

                        <!-- <img style="text-decoration: none;margin-top: 2px;" id="blah" src=""> -->
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                <span class="movieuuploadimg"  style="text-decoration: none;">
                  <img id="blah"></span>
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
                       <textarea id="description" name="description" class="form-control" ><?php echo set_value('description');?></textarea>
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