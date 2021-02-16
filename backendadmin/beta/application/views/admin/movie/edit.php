<style>
  .error{
   color: #FF0000;
   font-size: 15px;
    
}
</style>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Movie</h1>
            <p align="right"><a href="<?php echo base_url();?>admin/movie" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">List</span></a></p>
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
              <form method="post" id="MovieEditform" role="form" action="<?php echo base_url();?>admin/movie/update_content" autocomplete="off"  enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Movie Name*</label>
                      <input type="text" name="name" id="name" class="form-control"  value="<?php echo $row['name'];?>" required>
                    </div>
                </div>
              <?php //if(!empty($cafe_list)){ ?>
                <!-- <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Cafe*</label>
                        <select class="form-control" name="cafe_id"  id="cafe_id" required>
                           <option selected disabled>Please select</option> 
                           <?php foreach($cafe_list as $row1){?>
                            <option value="<?php echo $row1['cafe_id'];?>" <?php //if($row1['id']==$row['cafe_id']){ echo "selected"; }?>><?php //echo $row1['cafe_id'];?><?php echo $row1['cafe_name'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div> -->
              <?php //} ?>
               <?php if(!empty($cat_list)){ ?>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Movie Category*</label>
                        <select class="form-control" name="category_id"  id="category_id" required>
                           <option selected disabled>Please select</option> 
                           <?php foreach($cat_list as $row2){?>
                            <option value="<?php echo $row2['category_id'];?>" <?php if($row2['category_id']==$row['category_id']){ echo "selected"; }?>><?php //echo $row2['category_id'];?><?php echo $row2['category_name'];?></option>
                             <?php } ?>
                             </select>
                    </div>
                </div>
              <?php } ?>
              
               
               <!--   <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Duration*</label>
                       <input class="form-control" type="text" name="duration" id="duration"  value="<?php echo $row['duration'];?>"> 
                    </div>
                </div> -->
                   <?php  $str=$row['duration'];
                         $hours_min=explode('.',$str);
                         //print_r($hours_min) ;die;
                         //echo $hours_min[0];die;
                         //echo $hours_min[1];die;
                   ?>
                  <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Duration*</label>
                    <select class="form-control" id="duration" name="duration" >
                      <option selected disabled>Select Hours</option>
                     
                     <!--  <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option> -->
                     <?php for($i = 1; $i<=4; $i++) {
                        ?>
                          <option value="<?php echo $i;?>"<?php if($hours_min[0]==$i){ echo "selected";}?>><?php echo $i;?></option>
                        <?php } ?>
                      
                    </select>
                  </div>
                 
                     <div class="form-group">
                    <select class="form-control" id="minute" name="minute" >
                      <option selected disabled>Select Minutes</option>
                     
                        <?php for($i = 0; $i<=60; $i++) {
                        ?>
                          <option value="<?php echo $i;?>"<?php if(!empty($hours_min[1])){ if($hours_min[1]==$i){ echo "selected"; } }?>><?php echo $i;?></option>
                        <?php } ?>
                      
                    </select>
                    </div>
                </div>
                
                 <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Poster</label>
                       <input type="file"  id="file-input" name="image" >
                        
                    </div>
                    <div class="col-md-12">
						    <span class="smaillimgupload" style="margin-top: 2px; display: inline-block; margin-bottom: 15px;">
                   <!--  <img src="<?php echo base_url();?>public/assets/img/110x110.png" id="blah2" style="height:100px;width:100px;"> -->
                   <?php if(!empty($row['image'])){?>
                        <img src="<?php echo base_url();?>public/upload_images/movie_images/<?php echo $row['image'];?>" id="blah" style="height:100px;width:100px;">
                        <?php }else{?>
                       <span  style="text-decoration: none;"><img id="blah"></span>

                      <?php } ?>
                     
                   </span>
					     </div>
                </div>
                 
					   
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>More Poster</label>
                    
                      
                      <input type="file" name="files[]" id="file-input1" multiple accept="image/jpeg, image/png, image/gif,"> 
                       
                    </div>
                </div>
                
                
                 <?php if(!empty($cafe_list)){ ?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Choose Cafe</label>
                      <div class="row">
                       <?php foreach($cafe_list as $row1){?>
                       <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-check">
                          <input class="form-check-input move_cafe_checkbox" type="checkbox" value="<?php echo $row1['cafe_id'];?>" name="cafe_movie[]" <?php if (in_array($row1['cafe_id'], $movie_cafe_arr)) { ?>checked="checked" <?php } ?>>
                          <label class="form-check-label" for="<?php echo $row1['cafe_name'];?>">
                            <?php echo $row1['cafe_name']."-".$row1['cafe_place'];?>
                          </label>
                        </div>
                        </div>
                         <?php } ?>
                         </div>
                        
                    </div>
                </div>
              <?php } ?>
                
                
                
               <?php if(!empty($img_list)){ ?>
                   <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="product-media-img"> 
                   <div class="row">
                   <?php foreach($img_list as $img){ ?>
                   <div class="col-md-3 col-sm-12 col-xs-12">
                   <div class="pro_img">
                  <img style="margin-top: 2px;height:120px;width:120px;" id="blah" src="<?php echo base_url();?>public/upload_images/movie_images/<?php echo $img['image'];?>" alt="Movie Image" ><span> <a class="delete_movie_img btn btn-danger btn-circle btn-sm" id="<?php echo $img['movie_img_id']; ?>" href="javascriot:void(0);">
                        <i class="fas fa-trash"></i> </a></span>
                        <!-- <button  style="float:left"  class="btn pull-right btn-danger delete_pro_img" id="<?php echo $img['cafe_img_id']; ?>"><i class="fa fa-trash-o"></i></button> -->
                 <!--  <input type="hidden" name="cafe_img_name[]" id="cafe_img_name" value="<?php echo $img['image'];?>"> -->
           </div>
              </div>
               <?php }?>
               </div>
              <?php }?>
                 
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label>Description</label>
                       <textarea id="description" name="description" class="form-control" ><?php echo $row['description'];?></textarea>
                        <?php echo form_error('description','<span class="error">', '</span>'); ?>
                         <?php if ($this->session->flashdata('description_error_message')) : ?>
                           <span class="error"> <?php echo $this->session->flashdata('description_error_message') ?></span>
                      <?php endif ?>
                    </div>
                </div> 
                <div class="col-md-2 col-xs-2 col-xs-2">
                  <div class="form-group">
                    <input type="hidden" name="old_image" value="<?php echo $row['image'];?>">
                    <input type="hidden" name="movie_id" value="<?php echo $row['movie_id'];?>">
                     <button type="submit" class="btn btn-primary btn-user btn-block">Upadte</button>
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
        
        $('.move_cafe_checkbox').change(function() {
          var status=0;
          if($(this).is(':checked'))
          {
            var status=1;
          }
           var movie_id = '<?php echo $movie_id; ?>';
           var cafe_id = $(this).val();
           //alert(movie_id);
           //alert(cafe_id);
           $.ajax({
              type: "POST",
              url: '<?php echo base_url('admin/movie/changecafemovie')?>',
              data:{movie_id:movie_id,cafe_id:cafe_id,status:status},
              dataType:'html',
              success: function(response){
                //alert(response);
                 //window.location.reload();
                if(response ==1 ){
                  if(status==1)
                  {
                    //alert('Movie mapped with cafe successfully');
                  }
                  else
                  {
                    //alert('Movie removed from cafe successfully');
                  }
                  
                   
                }
                else{
                  //alert('Please try again to change cafe movie mapping');
                }
              },
              error:function(response){
               //error msg
              }
          }); 
          
          
        });
      </script>