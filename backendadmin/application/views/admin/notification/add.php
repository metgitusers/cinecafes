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
                <div class="clr"></div>    
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
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group emoji">
                      <label>Title*</label>
                      <input type="text" maxlength="150" name="message_title" id="message_title" class="form-control emoji_text" value="<?php echo set_value('message_title');?>" required>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>Image <small>(Accept format image only)</small></label>
                      <input type="file" name="file" id="file" class="form-control">
                    </div>
                  </div> 
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group emoji">
                      <label>Ticker</label>
                      <input type="text" maxlength="150" name="ticker" id="ticker" class="form-control" value="<?php echo set_value('ticker');?>" >
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Message*</label>
                      <!-- <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name');?>" 
                      required> -->
                      <textarea required maxlength="250" name="offer_text" id="offer_text" class="form-control emoji_text"></textarea>
                       
                    </div>
                </div>
             
               <?php if(!empty($user_list)){ ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Select All <input type="checkbox" id="selectAll"></label>
                      <div class="row">
                       <?php foreach($user_list as $row1){?>
                       <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-check addlabelcheck">
                          <div class="addlabelcheck_box">
                          <input class="move_cafe_checkbox" type="checkbox" value="<?php echo $row1['user_id'];?>" name="user_id[]" >
                          &nbsp; <label class="form-check-label" for="<?php echo $row1['name'].' '.$row1['last_name'];?>">
                            <?php echo $row1['name'].' '.$row1['last_name'];?>
                          </label>
                          </div>
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
      <style>
          .emoji div{
            z-index: 99;
          }
      </style>
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
<script src="<?=base_url('public/js/inputEmoji.js')?>"></script>
      <!-- End of Main Content -->
      <script type="text/javascript">
        $(document).ready(function() {
          $("#file").change(function () {
              var validExtensions = ["jpg","jpeg","png","gif"];
              var file = $(this).val().split('.').pop();
              if (validExtensions.indexOf(file) == -1) {
                  $("#file").val(null);
                  alert("Only formats are allowed : "+validExtensions.join(', '));
              }
              //restected for 
              if (this.files[0].size >= 550000) {
                  $("#file").val(null);
                  alert("File size is to large. Accepted size below 500k: ");
              }
              });
          //emoji
          $('.emoji_text').emoji({place: 'after'});
        })
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