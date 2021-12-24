<!--Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Role Wise Permission List</h1>
   <!--<p align="right">
      <a href="<?php echo base_url();?>admin/subadmin/add" class="btn btn-primary btn-icon-split">
      <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
      </span>
      <span class="text">Add</span>
      </a>
   </p>-->
   <div class="clearfix"></div>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Listing</h6>
      </div>
      <div class="card-body table_panel">
         <?php if ($this->session->flashdata('sub_success_message')) : ?>
         <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <?php echo $this->session->flashdata('sub_success_message') ?>
         </div>
         <?php endif ?>
         <?php if ($this->session->flashdata('sub_error_message')) : ?>
         <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <?php echo $this->session->flashdata('sub_error_message') ?>
         </div>
         <?php endif ?>
         <div class="table-responsive">
            <h1 class="h3 mb-2 text-gray-800">Owner permission list</h1>
            <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>SL No.</th>
                        <th>Management Name</th>
                        <th>List</th>
                        <th>Add</th>
                        <th>Edit</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th>Sl No.</th>
                        <th>Management Name</th>
                        <th>List</th>
                        <th>Add</th>
                        <th>Edit</th>
                     </tr>
                  </tfoot>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                     </tr>
                  </tbody>
            </table>
            <h1 class="h3 mb-2 text-gray-800">Frontend manager permission list</h1>
            <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>SL No.</th>
                        <th>Management Name</th>
                        <th>List</th>
                        <th>Add</th>
                        <th>Edit</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th>Sl No.</th>
                        <th>Management Name</th>
                        <th>List</th>
                        <th>Add</th>
                        <th>Edit</th>
                     </tr>
                  </tfoot>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                     </tr>
                     <tr>
                        <td>2</td>
                        <td><a href="<?php echo base_url('admin/cafe'); ?>">Cine Cafes</td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-times" aria-hidden="true"></i></td>
                     </tr>
                     <tr>
                        <td>3</td>
                        <td><a href="<?php echo base_url('admin/room'); ?>">Room</td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     </tr>
                     <tr>
                        <td>4</td>
                        <td><a href="<?php echo base_url('admin/coupon'); ?>">Coupon</td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     </tr>
                     <tr>
                        <td>5</td>
                        <td><a href="<?php echo base_url('admin/media'); ?>">Entertainment Media</td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     </tr>
                     <tr>
                        <td>6</td>
                        <td><a href="<?php echo base_url('admin/reservation'); ?>">Reservation</td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                     </tr>
                     <tr>
                        <td>7</td>
                        <td><a href="<?php echo base_url('admin/review'); ?>">Review</td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                     </tr>
                     <tr>
                        <td>8</td>
                        <td><a href="<?php echo base_url('admin/membership'); ?>">Membership Package</td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     </tr>
                     <tr>
                        <td>9</td>
                        <td><a href="<?php echo base_url('admin/member'); ?>">User</td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     </tr>
                  </tbody>
            </table>
            <h1 class="h3 mb-2 text-gray-800">General manager permission list</h1>
            <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>SL No.</th>
                        <th>Management Name</th>
                        <th>List</th>
                        <th>Add</th>
                        <th>Edit</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th>Sl No.</th>
                        <th>Management Name</th>
                        <th>List</th>
                        <th>Add</th>
                        <th>Edit</th>
                     </tr>
                  </tfoot>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                     </tr>
                  </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content-->