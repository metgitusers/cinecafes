<style>
  .error {
    color: #FF0000;
    font-size: 15px;
  }
  .delete_img{
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
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Add Movie</h1>
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

    <form method="post" id="MovieAddform" role="form" action="<?php echo base_url();?>admin/movie/add_content"
      autocomplete="off" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="form-group">
            <label>Movie Name*</label>
            <!-- <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name');?>" 
                      required> -->
            <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name');?>"
              required>
          </div>
        </div>

        <?php if(!empty($cat_list)){ ?>
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="form-group">
            <label>Movie Category*</label>
            <select class="form-control" name="category_id" id="category_id" required>
              <option selected disabled>Please select</option>
              <?php foreach($cat_list as $row2){?>
              <option value="<?php echo $row2['category_id'];?>">
                <?php //echo $row2['category_id'];?><?php echo $row2['category_name'];?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <?php } ?>
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="form-group">
            <label>Duration*</label>
            <select class="form-control" id="duration" name="duration">
              <option selected disabled>Select Hours</option>
              <?php for($i = 1; $i<=4; $i++) {
                        ?>
              <option value="<?php echo $i;?>"><?php echo $i;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" id="minute" name="minute">
              <option selected disabled>Select Minutes</option>
              <?php for($i = 0; $i<=60; $i++) {
                        ?>
              <option value="<?php echo $i;?>"><?php echo $i;?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <!-- <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="form-group">
            <label>Default Poster</label>
            <input type="file" id="file-input" name="image">
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
                <!-- populate -->
          </div>
        </div>
        <!-- end poster images -->
        <?php if(!empty($cafe_list)){ ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="form-group">
            <label>Choose Cafe</label>
            <div class="row">
              <?php foreach($cafe_list as $row1){?>
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="<?php echo $row1['cafe_id'];?>"
                    name="cafe_movie[]" checked="checked">
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

        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <span style="margin-top: 2px;" class="movieuuploadimg">
            <img id="blah"></span>
        </div> -->
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="form-group">
            <label>Description</label>
            <textarea id="description" name="description"
              class="form-control"><?php echo set_value('description');?></textarea>
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
  })
</script>