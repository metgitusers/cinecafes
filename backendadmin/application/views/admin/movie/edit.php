<style>
  .error{
   color: #FF0000;
   font-size: 15px;
}
.delete_img{
    position: absolute;
    top: 1px;
    right: 16px;
    cursor: pointer;
  }
.delete_img_1{
    position: absolute;
    top: 1px;
    right: 16px;
    cursor: pointer;
  }
  .default_image{
    position: absolute;
    top: -15px;
    cursor: pointer;
    right: -4px;
    display: none;
  }
  .uploadimgbox{
    margin-top: 15px;
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
                
                <!-- <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                     <label>Poster</label>
                       <input type="file"  id="file-input" name="image" >
                        
                    </div>
                    <div class="col-md-12">
						      <span class="smaillimgupload" style="margin-top: 2px; display: inline-block; margin-bottom: 15px;">
                   <?php if(!empty($row['image'])){?>
                        <img src="<?php echo base_url();?>public/upload_images/movie_images/<?php echo $row['image'];?>" id="blah" style="height:100px;width:100px;">
                        <?php }else{?>
                       <span  style="text-decoration: none;"><img id="blah"></span>
                      <?php } ?>
                   </span>
					        </div>
                </div> -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <label>Movie Poster</label>
                    <input type="file" name="files[]" id="images" multiple accept="image/jpeg, image/png, image/gif,">
                  </div>
                </div>
                <!-- end poster images -->
                <div class="col-md-12">
                  <div class="row image-section">
                  <?php
                    if(isset($img_list)){
                        foreach($img_list as $img){
                          ?>
                            <div class="col-md-2 uploadimgbox">
                              <div class="delete_img_1">
                                <i class="fa fa-trash text-danger remove-image" data-table="movie_images" data-key="movie_img_id" data-id="<?=$img['movie_img_id']?>"></i>
                              </div>
                              <img src="<?=base_url('public/upload_images/movie_images/'.$img['image'])?>" alt="movie_image" style="height:100%;width: 100%;" />
                            </div>
                          <?php
                        }
                    }
                  ?>
                  </div>
                </div>
                <!-- end poster images -->                
                 <?php if(!empty($cafe_list)){ ?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      <label class="mt-2">Choose Cafe</label>
                      <div class="row">
                       <?php foreach($cafe_list as $row1){?>
                       <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-check">
                          <input class="form-check-input move_cafe_checkbox" type="checkbox" value="<?php echo $row1['cafe_id'];?>" name="cafe_movie[]" <?php if (in_array($row1['cafe_id'], $movie_cafe_arr)) { ?>checked="checked" <?php } ?> style="padding: 0; margin-top: 6px !important; display: inline-block;">
                          <label class="form-check-label" for="<?php echo $row1['cafe_name'];?>" style="padding: 0; margin: 0 0 0 15px; display: inline-block;">
                            <?php echo $row1['cafe_name']."-".$row1['cafe_place'];?>
                          </label>
                        </div>
                        </div>
                         <?php } ?>
                         </div>
                        
                    </div>
                </div>
              <?php } ?>
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
<script>
  $(document).ready(function(){
    function readURL(input, previewElement) {
      for(var i=0; i<input.files.length; i++ ){
        if(input.files[i]['type']== 'image/jpg' || input.files[i]['type']== 'image/jpeg' || input.files[i]['type']== 'image/gif' || input.files[i]['type'] == 'image/png'){
          
          if (input.files && input.files[i]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('.image-section').show();
              /*$('.image-section').append('<div class="col-md-2 uploadimgbox"><div class="delete_img" data-val="'+e.target.result+'"  ><i class="fas fa-times-circle" ></i></div><img src="'+e.target.result+'" alt="product" style="height:100%;width: 100%;" /></div>'); */
              $('.image-section').append('<div class="col-md-2 uploadimgbox"><div class="delete_img"><i class="fa fa-trash text-danger"></i></div><input type="hidden" name="movie_images[]" value="'+e.target.result+'"><img src="'+e.target.result+'" alt="product" style="height:100%;width: 100%;" /><div class="default_image"><input type="radio" class="" value="'+(i+1)+'" name="default_image"></div></div>');
            }
            reader.readAsDataURL(input.files[i]); // convert to base64 string
          }
        }
      }
    }

    $("#images").change(function () {
      readURL(this, '#preview-image');
    });

    $(document).on('click', '.delete_img', function(){
       $(this).parent(".uploadimgbox").remove();
    })

    /**---------------- delete moview images from server------ */
    $('.fa-trash.text-danger.image-list').on('click', function(){
      $.ajax({
              type: "POST",
              url: '<?php echo base_url('admin/movie/changecafemovie')?>',
              data:{
                movie_id:movie_id,
                },
              success: function(response){
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
    })
  })
</script>