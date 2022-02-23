

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Page</h1>
		  <form class="form custom_form_style" id="add_user" method="Post" action="<?= base_url(); ?>add/add_user" enctype="multipart/form-data">
          <div class="form_panel">          		
            <div class="row">
            	<div class="col-md-4 col-sm-12 col-xs-12">
                	<div class="form-group">
                    	<label>Cafe Name*</label>
                        <input type="text" name="cafe_name" placeholder="name" required/>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                	<div class="form-group">
                    	<label>Cafe Image*</label>
                        <input type="file" name="profile_image" placeholder="image" multiple required/>
                    </div>
                </div>
                                
                 <div class="col-md-4 col-sm-12 col-xs-12">
                	<div class="form-group">
                    	<label>Cafe Address*</label>
                        <input type="text" name="address" placeholder="address" required/>
                    </div>
                </div>
                
                 <div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="form-group">
                    	<label>Description*</label>
                        <textarea name="description" required></textarea>
                    </div>
                </div>
                
                
                
                <div class="col-md-12 col-xs-12 col-xs-12">
                	<div class="form-group">
                         <input type="submit" name="add_sub" value="Submit"/>
                     </div>
                </div>
            
            </div>          
          </div>
		  </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



