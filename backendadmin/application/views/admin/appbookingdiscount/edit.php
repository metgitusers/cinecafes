<style>
  .error{
   color: #FF0000;
   font-size: 15px;    
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Update App Booking Discount</h1>
  <p align="right"><a href="<?php echo base_url();?>admin/appbookingdiscount" class="btn btn-primary btn-icon-split">
      <span class="icon text-white-50">
        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
      </span>
      <span class="text">List</span></a></p>
  <div class="form_panel"> 
    <?php if ($this->session->flashdata('success_msg')) : ?>
        <div class="alert alert-success" role="alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
          <?php echo $this->session->flashdata('success_msg') ?>
        </div>
    <?php endif ?>
    <?php if ($this->session->flashdata('error_msg')) : ?>
        <div class="alert alert-danger" role="alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
          <?php echo $this->session->flashdata('error_msg') ?>
        </div>
    <?php endif ?>             
      <form method="post" role="form" action="<?php echo base_url();?>admin/appbookingdiscount/update_content" autocomplete="off" >
        <div class="row">                 
          
          <div class="col-md-4 col-xs-4 col-xs-4">
            <div class="form-group">
              <label>Discount Percentage (%)</label>
              <input type="text" name="percentage" value="<?php echo $row['percentage'];?>">
              <input type="hidden" name="id" value="<?php echo $row['id'];?>">
              <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>                      
            </div>
          </div>

        </div>                    
      </form>
  </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->