<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Food Addon</h1>
           <p align="right"><a href="<?php echo base_url();?>admin/food/addon/<?php echo $food_id;?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">List</span></a></p>

          <br>
           <h1 class="h3 mb-4 text-gray-800">Food Item :   <?php echo $food_name;?></h1>
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
              <form method="post" id="AddonEditform" role="form" action="<?php echo base_url();?>admin/food/update_addon_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Food Addon*</label>
                       <input class="form-control" type="text" name="addon_text" id="addon_text"  value="<?php echo $row['addon_text'];?>"> 
                    </div>
                </div> 
             
               <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Food Addon Price*</label>
                       <input class="form-control" type="number" min="1" name="addon_price" id="addon_price"  value="<?php echo $row['addon_price'];?>"> 
                    </div>
                </div> 
              
                </div>  
                 <div class="row">
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                     <?php //$food_id=$this->uri->segment(4);?>
                       <input type="hidden" name="food_id" value="<?php echo $food_id;?>">
                      <input type="hidden" name="addon_id" value="<?php echo $row['addon_id'];?>">
                     <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                        <!--  <input type="button" value="Submit"/> -->
                     </div>
                </div>
            
            </div>          
          </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
               
              
             