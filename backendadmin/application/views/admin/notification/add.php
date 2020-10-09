<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Push Notification</h1>
            <!-- <p align="right"><a href="<?php echo base_url();?>admin/notification" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">List</span></a></p> -->
          <div class="form_panel"> 
            <?php if ($this->session->flashdata('Movie_success_message')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('Movie_success_message') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('Movie_error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('Movie_error_message') ?>
                </div>
            <?php endif ?>
                         
              <form method="post" id="NotificationAddform" role="form" action="<?php echo base_url();?>admin/notification/add_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Message*</label>
                      <!-- <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name');?>" 
                      required> -->
                      <textarea required="required" name="offer_text" id="offer_text" class="form-control"></textarea>
                       
                    </div>
                </div>
             
               <?php if(!empty($user_list)){ ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Select All <input type="checkbox" id="selectAll"></label>
                      <div class="row">
                       <?php foreach($user_list as $row1){?>
                       <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-check">
                          <input class="form-check-input move_cafe_checkbox" type="checkbox" value="<?php echo $row1['user_id'];?>" name="user_id[]" >
                          <label class="form-check-label" for="<?php echo $row1['name'];?>">
                            <?php echo $row1['name'];?>
                          </label>
                        </div>
                        </div>
                         <?php } ?>
                         </div>
                        
                    </div>
                </div>
              <?php } ?>
              
              
               
               <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary btn-user btn-block">Send </button>
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
      <script type="text/javascript">
        $("#selectAll").click(function(){
          if($(this).prop("checked")) {
                //$(".checkBox").prop("checked", true);
                $("input[type=checkbox]").prop('checked', true);
            } else {
                //$(".checkBox").prop("checked", false);
                $("input[type=checkbox]").prop('checked', false);
            }  
        

        });
      </script>