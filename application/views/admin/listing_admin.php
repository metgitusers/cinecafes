

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php //require_once(base_url()."listing/list_user"); ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Listing</h1>
		  
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body table_panel">
              <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Image</th>
                      <th>Name</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
				  <?php //$this->load->helper(base_url().'listing/list_user'); ?>
                  <tbody>
				  <?php
				  foreach($users as $user){ ?>
                    <tr>
					   <td></td>
                       <td><?php echo $user['cafe_name']; ?></td>
                       <td><?php echo $user['cafe_location']; ?></td>	
                       <td class="action_td text-center">
							<a title="Inactive" href="<?= base_url().'add-page-edit/'.$user['cafe_id'] ?>" class="btn_action btn-warning active_btn make_inactive"><i class="fa fa-times" aria-hidden="true"></i></a>
							<a title="Delete" href="<?= base_url().'cdelete/list_user_del/'.$user['cafe_id'] ?>" class="delete_bttn btn_action btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
					   </td>				   
					</tr>
				  <?php } ?>
                  </tbody>
                </table>
				
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



