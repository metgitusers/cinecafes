<!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo ORGANIZATION_NAME.' '. date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure you want to Logout?</div>
        <div class="modal-footer" style="justify-content: flex-start;">
          <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin:0 10px 0 0 !important; color:#000;">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('admin/logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  
  <script src="<?php echo base_url() ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>public/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>public/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>public/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url() ?>public/js/demo/chart-pie-demo.js"></script>
  <!-- Page level plugins -->
 
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script> -->
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script> -->
  

<!-- <script src="<?php echo base_url() ?>public/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
 
  <script src="<?php echo base_url() ?>public/js/demo/datatables-demo.js"></script> -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js
"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> 
<!-- https://code.jquery.com/jquery-3.5.1.js
https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js
https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js
https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js
https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js
https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js
https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js
https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js -->
</body>

</html>
<!--------------added by soma on 24/07/20------------------------------->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript">
// CKEDITOR.config.basicEntities = false;
// CKEDITOR.replace('cms_description');

</script>
<script>
	$('#reservation-food ').slimscroll({
		size: '5px',
		width: '100%',
		height: 'auto',
		height: '400px',
    color:'#F68310'
	});
</script>
<script>
  //common function to remove preview image
  $('.remove-image').on('click', function(){
    if(confirm("Are you sure you want to delete this ?")){
    var id = $(this).data('id');
    var table = $(this).data('table');
    var key = $(this).data('key');
    $.ajax({
       type: "POST",
       url: '<?php echo base_url('admin/dashboard/deleteImage')?>',
       data:{
         id: id,
         table: table,
         key: key
         },
       dataType:'JSON',
       success: function(response){
         console.log(response);
         if(response.status == 1){
           alert('Image deleted successfully');
            window.location.href = window.location.href;
         }
         else{
          alert('Unable to delete image');
           //nothing to do 
         }
       },
       error:function(response){
       
       }
   }); 
 }
  })
////////delete food image//////////////////
$(document).on('click','.delete_img',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var food_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/food/delete_img')?>',
          data:{food_id:food_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
          
          }
      }); 
    }
    return false;
});
</script>
<script>
  ////////delete movie  and  image//////////////////
$(document).on('click','.delete_movie',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var movie_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/movie/delete_img')?>',
          data:{movie_id:movie_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
          
          }
      }); 
    }
    return false;
});
  </script>
  <script>
  ////////delete room and room image//////////////////
$(document).on('click','.delete_room',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var room_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/room/delete_img')?>',
          data:{room_id:room_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
          
          }
      }); 
    }
    return false;
});
  </script>
  <script>
  ////////delete room type  //////////////////
$(document).on('click','.delete_roomtype',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var category_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/roomtype/delete')?>',
          data:{category_id:category_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});
</script>
  <script>
  ////////delete coupon //////////////////
$(document).on('click','.delete_coupon',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var coupon_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/coupon/delete')?>',
          data:{coupon_id:coupon_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});
</script>
<script>
/*$(document).on('click','.delete_img',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var food_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php //echo base_url('admin/food/delete_img')?>',
          data:{food_id:food_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
            $.alert({
               type: 'red',
               title: 'Alert!',
               content: 'Error',
            });
          }
      }); 
    }
    return false;
});*/
</script>
<script>
  ////////delete cafe image//////////////////
$(document).on('click','.delete_cafe_img',function(){
    if(confirm("Are you sure you want to delete this ?")){
      // $(this).parent().parent().remove();
       var cafe_img_id = $(this).attr('id');
       //alert(cafe_img_id);
      
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/cafe/delete_img')?>',
          data:{cafe_img_id:cafe_img_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
                 $.alert({
                     type: 'green',
                     title: 'Alert!',
                     content: 'Successfully deleted.',
                  });
                 
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
            $.alert({
               type: 'red',
               title: 'Alert!',
               content: 'Error',
            });
          }
      }); 
    }
    return false;
});

////////delete movie image//////////////////
$(document).on('click','.delete_movie_img',function(){
    if(confirm("Are you sure you want to delete this ?")){
      // $(this).parent().parent().remove();
       var movie_img_id = $(this).attr('id');
       //alert(cafe_img_id);
      
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/movie/delete_more_img')?>',
          data:{movie_img_id:movie_img_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
                 $.alert({
                     type: 'green',
                     title: 'Alert!',
                     content: 'Successfully deleted.',
                  });
                 
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
            $.alert({
               type: 'red',
               title: 'Alert!',
               content: 'Error',
            });
          }
      }); 
    }
    return false;
});
</script>
<script>
  ////////delete food category //////////////////
$(document).on('click','.delete_cat',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var category_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/foodcategory/delete')?>',
          data:{category_id:category_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});
</script>
<script>
  ////////delete movie category //////////////////
$(document).on('click','.delete_mcat',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var category_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/moviecategory/delete')?>',
          data:{category_id:category_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});
</script>
<script>
$(document).on('click','.delete_rtype',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var room_type_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/roomtype/delete')?>',
          data:{room_type_id:room_type_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});
////////delete cafe//////////////////
$(document).on('click','.delete_cafe',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var cafe_id = $(this).attr('id');
      // alert(cafe_id);
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/cafe/delete')?>',
          data:{cafe_id:cafe_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});
</script>
  <script>
  ////////delete food variant type  //////////////////
$(document).on('click','.delete_foodvariant',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var food_variant_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/food/delete_variant')?>',
          data:{food_variant_id:food_variant_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});
</script>
 <script>
  ////////delete food addon   //////////////////
$(document).on('click','.delete_foodaddon',function(){
    if(confirm("Are you sure you want to delete this ?")){
    
       var addon_id = $(this).attr('id');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/food/delete_addon')?>',
          data:{addon_id:addon_id},
          dataType:'html',
          success: function(response){
            //alert(response);
              window.location.href = window.location.href;
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});
</script>

<script>
  /////////////cafe image/////////////////////////
/*function readURLCafe(input) {

var FileUploadPath = input.value;
if (FileUploadPath == '') {
            alert("Please upload an Image");
} else {
    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
//The file uploaded is an pdf
if (Extension == "gif" || Extension == "png" || Extension == "bmp"|| Extension == "jpeg" || Extension == "jpg") {
   //if (Extension == "pdf") {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#blah1').attr('src', e.target.result);
            $('#blah1').show();
        }
        reader.readAsDataURL(input.files[0]);
     }
  }
  else
  {
     alert("Accept file extention - .gif,.jpg,.png,.jpeg. Please upload vaild file.");
    $("#file-input1").val('');
  }
}
}
$("#file-input1").change(function(){
   readURLCafe(this);
});*/
</script>
<script>
  //////////////movie poster/////////////////////////////////////
/*function readURLMovie(input) {

var FileUploadPath = input.value;
if (FileUploadPath == '') {
            alert("Please upload an Image");
} else {
    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
//The file uploaded is an pdf
if (Extension == "gif" || Extension == "png" || Extension == "bmp"|| Extension == "jpeg" || Extension == "jpg") {
   //if (Extension == "pdf") {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#blah2').attr('src', e.target.result);
            $('#blah2').show();
        }
        reader.readAsDataURL(input.files[0]);
     }
  }
  else
  {
     alert("Accept file extention - .gif,.jpg,.png,.jpeg. Please upload vaild file.");
    $("#file-input2").val('');
  }
}
}
$("#file-input2").change(function(){
   readURLMovie(this);
});*/
</script>
<script>
  //////////////room image/////////////////////////////////////
function readURLRoom(input) {

var FileUploadPath = input.value;
if (FileUploadPath == '') {
            alert("Please upload an Image");
} else {
    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
//The file uploaded is an pdf
if (Extension == "gif" || Extension == "png" || Extension == "bmp"|| Extension == "jpeg" || Extension == "jpg") {
   //if (Extension == "pdf") {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#blah3').attr('src', e.target.result);
            $('#blah3').show();
        }
        reader.readAsDataURL(input.files[0]);
     }
  }
  else
  {
     alert("Accept file extention - .gif,.jpg,.png,.jpeg. Please upload vaild file.");
    $("#file-input3").val('');
  }
}
}
$("#file-input3").change(function(){
   readURLRoom(this);
});
</script>
<script>
  ///////////food status change////////////////////////////////////////
  function activeInactive(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/food/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
 <script>
  ///////////food category status change////////////////////////////////////////
  function activeInactive1(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/foodcategory/approval_status');?>",
          {key:"activeInactive1",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  ///////////cafe status change////////////////////////////////////////
   function activeInactiveCafe(recordId,status) {
     
   // var message = ((status == 0?" Disapproved ":" Approved "));
   // if (confirm("Are you sure to"+ message+ "this Product")){
        $.post("<?php echo base_url('admin/cafe/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("Product is"+ message +"now");
                location.reload();
            }
        });
    //}
}
</script>
 <script>
  ///////////moviecategory status change////////////////////////////////////////
  function activeInactiveMoviecat(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/moviecategory/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  ///////////movie status change////////////////////////////////////////
  function activeInactiveMovie(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/movie/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  ///////////movie status change////////////////////////////////////////
  function activeInactiveRating(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/Review/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  /*function activeInactive6(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/room/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}*/
</script>
<script>
  ///////////roomtype status change////////////////////////////////////////
  function activeInactive7(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/roomtype/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  ///////////room status change////////////////////////////////////////
  function activeInactiveRoom(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/room/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  ///////////reservation status change////////////////////////////////////////
  function activeInactiveReservation(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/reservation/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  ///////////food variant status change////////////////////////////////////////
  function activeInactiveVariant(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/food/variant_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  ///////////food addon status change////////////////////////////////////////
  function activeInactiveAddon(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/food/addon_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>
<script>
  ///////////coupon status change////////////////////////////////////////
  function activeInactiveCoupon(recordId,status) {
  // var message = ((status == 0?" Disapproved ":" Approved "));
    //if (confirm("Are you sure to"+ message+ "this")){
        $.post("<?php echo base_url('admin/coupon/approval_status');?>",
          {key:"activeInactive",status:status,recordId:recordId},
          function (response) {
            if (response == "success"){
                if (status == 0){
                    $('#activeBtn'+recordId).show();
                    $('#inactiveBtn'+recordId).hide();
                }else if (status == 1){
                    $('#inactiveBtn'+recordId).show();
                    $('#activeBtn'+recordId).hide();
                }
                //alert("this is "+ message +"now");
                location.reload();
            }
        });
    }
//}
</script>

<script>
  ///////////change password form validation///////////////////////////////
$("#changePswdForm" ).validate({
          rules: {
            
    oldpassword: {
          required: true,
          minlength: 6,
         
        }, 
    password: {
              required: true,
              minlength: 6,
             // password_check: true
          
        },
    confirm_password: {
          required: true,
        //  minlength: 6,
          equalTo: "#password"
        }, 
          
            
            },
          messages: {
           
            oldpassword: {
            required: "Current Password is required",
            minlength: "At least 6 characters required!"
            },
            password: {
            required: "New Password is required",
            minlength: "At least 6 characters required!"
            },

            confirm_password:"Please enter the same value",
          },
          errorElement: "em",
        
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
  ////////////////////////////////Food Add form validation////////////////////////////////////////////
$( "#FoodAddform" ).validate({
          rules: {
          
            name: "required",
            veg_nonveg: "required",
            //cafe_id: "required",
            category_id: "required",
            //subcategory_id: "required",
            price: "required",
            //description: "required",
           
                                      
          },
          messages: {
          
            name: "Item Name is required",
            veg_nonveg: "Please select type",
            //cafe_id: "Please select cafe",
            category_id: "Category is required",
            //subcategory_id: "Subcategory is required",
            price: "Price is required",
            //description: "description is required",
            
           
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
  
            
 ////////////////////////////////Food edit form validation////////////////////////////////////////////
$( "#FoodEditform" ).validate({
          rules: {
          
            name: "required",
            veg_nonveg: "required",
           // cafe_id: "required",
            category_id: "required",
            //subcategory_id: "required",
            price: "required",
            //description: "required",
           
                                      
          },
          messages: {
          
            name: "Item Name is required",
            veg_nonveg: "Please select type",
           // cafe_id: "Please select cafe",
            category_id: "Category is required",
            //subcategory_id: "Subcategory is required",
            price: "Price is required",
           // description: "description is required",
            
           
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });

////////////////////////////////Food Category Add form validation////////////////////////////////////////////
$( "#FoodCatAddform" ).validate({
          rules: {
            category_id: "required",
          },
          messages: {
            category_id: "Category is required",   
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////Food category edit form validation////////////////////////////////////////////
 $( "#FoodCatEditform" ).validate({
          rules: {
            category_name: "required",
          },
          messages: {
            category_name: "Category is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////Food subcategory Add form validation////////////////////////////////////////////
$( "#FoodSubAddform" ).validate({
          rules: {
            category_id: "required",
            subcategory_id: "required",
         },
          messages: {
            category_id: "Category is required",
            subcategory_id: "Subcategory is required",
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////Food subcategory edit form validation////////////////////////////////////////////
 $( "#FoodSubEditform" ).validate({
          rules: {
            parent_id: "required",
            subcategory_id: "required",
          },
          messages: {
            parent_id: "Category is required",
            subcategory_id: "Subcategory is required",
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });

////////////////////////////////Movie Category Add form validation////////////////////////////////////////////
$( "#MovieCatAddform" ).validate({
          rules: {
            category_id: "required",
          },
          messages: {
            category_id: "Category is required",   
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////Movie category edit form validation////////////////////////////////////////////
 $( "#MovieCatEditform" ).validate({
          rules: {
            category_name: "required",
          },
          messages: {
            category_name: "Category is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////Movie Category Add form validation////////////////////////////////////////////
$( "#RoomtypeAddform" ).validate({
          rules: {
            room_type_id: "required",
          },
          messages: {
            room_type_id: "Room Type is required",   
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////Movie category edit form validation////////////////////////////////////////////
 $( "#RoomtypeEditform" ).validate({
          rules: {
            room_type_name: "required",
          },
          messages: {
            room_type_name: "Room Type is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
////////////////////////////////Movie Add form validation////////////////////////////////////////////
$( "#MovieAddform" ).validate({
          rules: {
          
            name: "required",
            category_id: "required",
            price: "required",
            /* price: {
              required: true,
              digits: true,
              minlength: 1,
              //maxlength: 15
              },*/
            duration: "required",
            //description: "required",
           
                                      
          },
          messages: {
          
            name: "Movie Name is required",
            category_id: "Category is required",
            price: "Price is required",
           /* price: {
            required: "price is required",
            digits: "Enter valid number",
            minlength: "valid number required!",
           // maxlength: "valid phone no required!"
                } ,*/
            duration: "Duration is required",
           // description: "description is required",
            
           
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
////////////////////////////////Movie edit form validation////////////////////////////////////////////
$( "#MovieEditform" ).validate({
          rules: {
          
            name: "required",
            category_id: "required",
            price: "required",
            /* price: {
              required: true,
              digits: true,
              minlength: 1,
              //maxlength: 15
              },*/
            duration: "required",
           // description: "required",
           
                                      
          },
          messages: {
          
            name: "Movie Name is required",
            category_id: "Category is required",
            price: "Price is required",
             /*price: {
            required: "price is required",
            digits: "Enter valid number",
            minlength: "valid number required!",
           // maxlength: "valid phone no required!"
                } ,*/
            duration: "Duration is required",
            //description: "description is required",
            
           
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
////////////////////////////////room Add form validation////////////////////////////////////////////
$( "#RoomAddform" ).validate({
          rules: {
          
            room_no: "required",
            room_type_id: "required",
            cafe_id: "required",
            //no_of_people: "required",
             no_of_people: {
              required: true,
              digits: true,
              minlength: 1,
              //maxlength: 15
              },
            /*  price: {
              required: true,
              digits: true,
              minlength: 1,
              //maxlength: 15
              },*/
            price: "required",
           // description: "required",
           
                                      
          },
          messages: {
          
            room_no: "Room no is required",
            room_type_id: "Room Type is required",
            cafe_id: "Cafe is required",
           // no_of_people: "No of people is required",
            no_of_people: {
            required: "no of people required",
            digits: "Enter valid number",
            minlength: "valid number required!",
           // maxlength: "valid phone no required!"
                } ,
           /* price: {
            required: "price is required",
            digits: "Enter valid number",
            minlength: "valid number required!",
           // maxlength: "valid phone no required!"
                } ,*/
            price: "Price is required",
           // description: "description is required",
            
           
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
////////////////////////////////room edit form validation////////////////////////////////////////////
$( "#RoomEditform" ).validate({
          rules: {
          
            room_no: "required",
            room_type_id: "required",
            cafe_id: "required",
            //no_of_people: "required",
            no_of_people: {
              required: true,
              digits: true,
              minlength: 1,
              //maxlength: 15
              },
            price: "required",
           /* price: {
              required: true,
              digits: true,
              minlength: 1,
              //maxlength: 15
              },*/
           // description: "required",

           
                                      
          },
          messages: {
          
            room_no: "Room no is required",
            room_type_id: "Room Type is required",
            cafe_id: "Cafe is required",
           //no_of_people: "No of people is required",
            no_of_people: {
            required: "no of people required",
            digits: "Enter valid number",
            minlength: "valid number required!",
          },
           /*price: {
            required: "price is required",
            digits: "Enter valid number",
            minlength: "valid number required!",
           // maxlength: "valid phone no required!"
                } ,*/
            price: "Price is required",
            //description: "description is required",
            
           
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
/////cafe add validation form/////////////////////////////////////////////////////
 $( "#CafeAddform" ).validate({
          rules: {
          
            cafe_name: "required",
            //cafe_location: "required",
            autocomplete: "required",
            //price: "required",
            phone: {
              required: true,
              digits: true,
              minlength: 10
              },
            //opening_hours: "required",
            start_time: "required",
            end_time: "required",
            open_days: "required",
            seating_capacity: "required",
            screen_size: "required",
           // cafe_description: "required",
                                       
          },
          messages: {
          
            cafe_name: "Cafe Name is required",
           // cafe_location: "Location is required",
            autocomplete: "Location is required",
            //price: "Price is required",
            phone: {
              required: "Phone no required",
              digits: "Enter valid phone no",
              minlength: "valid phone no required!"
                  },
            //opening_hours: "Opening hours is required",
            start_time: "Start time is required",
            end_time: "End time is required",
           // open_days: "Open days is required",
            //seating_capacity: "seating capacity is required",
            //screen_size: "screen size  is required",
           // cafe_description: "description is required",
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 /////////////////////cafe edit validation form/////////////////////////////////////////////////////
 $( "#CafeEditform" ).validate({
          rules: {
          
            cafe_name: "required",
            //cafe_location: "required",
            autocomplete: "required",
            //price: "required",
            phone: {
              required: true,
              digits: true,
              minlength: 10
              },
            //opening_hours: "required",
            start_time: "required",
            end_time: "required",
            open_days: "required",
            seating_capacity: "required",
            screen_size: "required",
           // cafe_description: "required",
                                       
          },
          messages: {
          
            cafe_name: "Cafe Name is required",
            //cafe_location: "Location is required",
            autocomplete: "Location is required",
           // price: "Price is required",
            phone: {
              required: "Phone no required",
              digits: "Enter valid phone no",
              minlength: "valid phone no required!"
                  },
           //opening_hours: "Opening hours is required",
            start_time: "Start time is required",
            end_time: "End time is required",
            open_days: "Open days is required",
            seating_capacity: "seating capacity is required",
            screen_size: "screen size  is required",
           // cafe_description: "description is required",
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
///////////////////////////////////////////////////////////// 
////////////////////////////////food addon add form validation////////////////////////////////////////////
 $( "#AddonAddform" ).validate({
          rules: {
            addon_text: "required",
            addon_price: "required",
          },
          messages: {
            addon_text: "Addon is required",
            addon_price: "Addon price is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
        ////////////////////////////////food addon  edit form validation////////////////////////////////////////////
 $( "#AddonEditform" ).validate({
          rules: {
            addon_text: "required",
            addon_price: "required",
          },
          messages: {
            addon_text: "Addon is required",
            addon_price: "Addon price is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////food variant add form validation////////////////////////////////////////////
 $( "#VariantAddform" ).validate({
          rules: {
            food_variant_name: "required",
            food_variant_price: "required",
          },
          messages: {
            food_variant_name: "Food Variant is required",
            food_variant_price: "Food Variant price is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
        ////////////////////////////////food variant  edit form validation////////////////////////////////////////////
 $( "#VariantEditform" ).validate({
          rules: {
            food_variant_name: "required",
            food_variant_price: "required",
          },
          messages: {
            food_variant_name: "Food Variant is required",
            food_variant_price: "Food Variant price is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////coupon add form validation////////////////////////////////////////////
 $( "#CouponAddform" ).validate({
          rules: {
            coupon_code: "required",
            start_on: "required",
            end_on: "required",
            coupon_type: "required",
            amount: "required",
           // min_price: "required",
          },
          messages: {
            coupon_code: "Coupon code is required",
            start_on: "Start date is required",
            end_on: "End date is required",
            coupon_type: "Please select Coupon type",
            amount: "Amount is required",
            //min_price: "Min. price is required",
         },
          errorElement: "div",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////coupon edit form validation////////////////////////////////////////////
 $( "#CouponEditform" ).validate({
          rules: {
            coupon_code: "required",
            start_on: "required",
            end_on: "required",
            coupon_type: "required",
            amount: "required",
            //min_price: "required",
          },
          messages: {
            coupon_code: "Coupon code is required",
            start_on: "Start date is required",
            end_on: "End date is required",
            coupon_type: "Please select Coupon type",
            amount: "Amount is required",
            //min_price: "Min. price is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////Food Category Add form validation////////////////////////////////////////////
$( "#CmsAddform" ).validate({
          rules: {
            page_name: "required",
            description: "required",
          },
          messages: {
            page_name: "Page name is required",
            description: "Description is required",   
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////Food category edit form validation////////////////////////////////////////////
 $( "#CmsEditform" ).validate({
          rules: {
            description: "required",
          },
          messages: {
            description: "Description is required",
         },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 /////////////////////////////////profile update form validation/////////////////////////////////////////////
 ////////////////////////////////subadmin Add form validation////////////////////////////////////////////
$( "#profileForm" ).validate({
          rules: {
           // role_id: "required",
            name: "required",
            email: {
                  required: true,
                  email: true
                },
            password: {
                 required: true,
                // minlength: 6
                } ,
            confirm_password: {
                required: true,
                equalTo: "#password"
                },
            mobile: {
              required: true,
              digits: true,
              minlength: 10,
              maxlength: 15
              }
          },
          messages: {
           // role_id: "Please select role id",
            name: "Name is required",
             email: {
                required: "Email address is required",
                email: "Your email address must be in the format of name@domain.com"
                  },
            password: {
               required: "Password is required",
               minlength: "At least 6 characters required!"
               },
            confirm_password: "Please enter the same value",
            mobile: {
              required: "Phone no required",
            digits: "Enter valid phone no",
            minlength: "valid phone no required!",
            maxlength: "valid phone no required!"
                }  
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////subadmin Add form validation////////////////////////////////////////////
$( "#subadminAdd" ).validate({
          rules: {
            role_id: "required",
            name: "required",
            email: {
                  required: true,
                  email: true
                },
            password: {
                 required: true,
                // minlength: 6
                } ,
            confirm_password: {
                required: true,
                equalTo: "#password"
                },
            mobile: {
              required: true,
              digits: true,
              minlength: 10,
              maxlength: 15
              }
          },
          messages: {
            role_id: "Please select role id",
            name: "Name is required",
             email: {
                required: "Email address is required",
                email: "Your email address must be in the format of name@domain.com"
                  },
            password: {
               required: "Password is required",
               minlength: "At least 6 characters required!"
               },
            confirm_password: "Please enter the same value",
            mobile: {
              required: "Phone no required",
            digits: "Enter valid phone no",
            minlength: "valid phone no required!",
            maxlength: "valid phone no required!"
                }  
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 ////////////////////////////////subadmin edit form validation////////////////////////////////////////////
$( "#subadminEdit" ).validate({
          rules: {
            role_id: "required",
            name: "required",
            email: {
                  required: true,
                  email: true
                },
            password: {
                 required: true,
                // minlength: 6
                } ,
            confirm_password: {
                required: true,
                equalTo: "#password"
                },
            mobile: {
              required: true,
              digits: true,
              minlength: 10,
              maxlength: 15
              }
          },
          messages: {
            role_id: "Please select role id",
            name: "Name is required",
             email: {
                required: "Email address is required",
                email: "Your email address must be in the format of name@domain.com"
                  },
            password: {
               required: "Password is required",
               minlength: "At least 6 characters required!"
               },
            confirm_password: "Please enter the same value",
            mobile: {
              required: "Phone no required",
            digits: "Enter valid phone no",
            minlength: "valid phone no required!",
            maxlength: "valid phone no required!"
                }  
          },
          errorElement: "em",
         
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-control" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-control" ).addClass( "has-success" ).removeClass( "has-error" );
          }
        });
 //////////////////////////////////////////////////////////////////////////

function readURL(input) {

var FileUploadPath = input.value;
if (FileUploadPath == '') {
            alert("Please upload an Image");
} else {
    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
//The file uploaded is an pdf
if (Extension == "gif" || Extension == "png" || Extension == "bmp"|| Extension == "jpeg" || Extension == "jpg") {
  
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            $('#blah').attr('src', e.target.result);
            $('#blah').show();
        }
        reader.readAsDataURL(input.files[0]);
     }
  }
  else
  {
    alert("Only .png,.jpeg,.jpg,.gif,.bmp file allows");
    $("#file-input").val('');
  }
}
}
$("#file-input").change(function(){
   readURL(this);
});
//////////////////////////////////
 $(document).ready(function(){
    $("#category_id").change(function(){
         var category_id=$(this).val();
         var content='<option value="">Select subcategory</option>';
      
        $.ajax({
            url: "<?= base_url();?>admin/food/subcat_list",
            type: "post",
            data: 'category_id='+category_id,
            dataType : 'json',
            success: function (response) {
            $.each(response.data, function( key, value ) {
            console.log(value); 
            content+='<option value="'+value.category_id+'">'+value.category_name+'</option>';
          });
          $('#subcategory_id').html(content);
         
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }); 
    });
////////////////////////////////

  $('#myCafe').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
   $('#myFood').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
    $('#myCategory').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
     $('#mySubcat').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
     $('#myMovieCategory').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
      $('#myMovie').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
       $('#myRoomtype').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
        $('#myRoom').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
         $('#myCoupon').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
          $('#myPackageType').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
         $('#myReservation').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
        
       ],
       "dom": 'Blfrtip',
       //"buttons": [ 'excel'],
       "buttons" : [{
            extend: 'excelHtml5',
            autoFilter: true,
            title: 'BookingReportCinecafe',
            exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8]
                        }
        }]

  });
          $('#myWallet').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
       "dom": 'Blfrtip',
       //"buttons": [ 'excel'],
       "buttons" : [{
            extend: 'excelHtml5',
            autoFilter: true,
            title: 'TransactionReportCinecafe',
        }]
  });
      $('#myTransactionhistory').DataTable({
      // "processing": true,
      // "paging": true,
      "language": {
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
      },
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
       "dom": 'Blfrtip',
       //"buttons": [ 'excel'],
       "buttons" : [{
            extend: 'excelHtml5',
            autoFilter: true,
            title: 'TransactionReportCinecafe',
        }]
  });
      $('#myCms').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
      $('#myRating').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
      $('#mysubadmin').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
      $('#myPackageBenefit').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
      $('#myMembershipPackage').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });
       $('#myMemberList').DataTable({
      // "processing": true,
      // "paging": true,
       "columnDefs": [
       { 
          "targets": 'no-sort',//last column
          "orderable": false, //set not orderable
        },
       ],
  });

</script>
 <script> 
  $(function () {

  $("#end_on").attr("disabled", "disable");
  
  /*var currDate = new Date();
  $('#end_on').datepicker({

    startDate : currDate,
    todayHighlight: true,
   
    //format: 'dd/mm/yyyy'
    format: 'yyyy-mm-dd',
     autoclose: true,
  });*/
  
});
/////////////////////////////

$(function () {
  
  var currDate = new Date();
  $('#start_on').datepicker({
    startDate : currDate,
    todayHighlight: true,
   
   //format: 'dd/mm/yyyy'
    format: 'yyyy-mm-dd',
     autoclose: true
  });



});

//$("#end_on").rules('add', { greaterThan: "#start_on" });


//$("#start_on, #end_on").datepicker();
$("#end_on").change(function () {

    var startDate = document.getElementById("start_on").value;

    var endDate = document.getElementById("end_on").value;

 

    if ((Date.parse(endDate) <= Date.parse(startDate))) {


        alert("End date should be greater than Start date");

        document.getElementById("end_on").value = "";

    }

});
$("#start_on").change(function () {

  var startDate = document.getElementById("start_on").value;
  if ((Date.parse(start_on)!='' )) {

  $("#end_on").removeAttr("disabled");
  var currDate = new Date();
  $('#end_on').datepicker({

  startDate : currDate,
  todayHighlight: true,
   
  //format: 'dd/mm/yyyy'
  format: 'yyyy-mm-dd',
  autoclose: true,
  });
    }

});



</script>

<script>
$(function () {
  $('#start_date').datepicker({
    todayHighlight: true,
    autoclose: true,
    //format: 'dd/mm/yyyy'
    format: 'yyyy-mm-dd'
  });
});
$(function () {
  $('#end_date').datepicker({
    todayHighlight: true,
    autoclose: true,
    //format: 'dd/mm/yyyy'
    format: 'yyyy-mm-dd'
  });
});
////////////////////////////////
</script>
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 4000);
  </script>
<script>
// $(function() {
//     $('#start_time').timepicker();
//       //minuteStep: 30
//       startTime: new Date(0,0,0,10,0,0) // 10:00:00 AM - noon
//       interval: 15
//   });
</script>
<script>
var total_amount = 0;
var user_id = "";
 
  $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
      input.attr("type", "text");
      } else {
      input.attr("type", "password");
      }
  });


////common fn for status update 
//$(document).on('click','.change-p-status',function(){
$(document).on('click','.change-p-status',function(){
    //if(confirm("Are you sure you want to delete this ?")){
       var selector = $(this);
       var status = $(this).attr("data-status");
       //alert(status);
       var column_name = $(this).attr('data-column_name');
       var id = $(this).attr('id');
       var table = $(this).attr('data-table');
       Swal.fire({
          title: "Are you sure want to update status ?",
          type: "warning",
          showCancelButton: true, // true or false  
          confirmButtonColor: "#dd6b55",
          cancelButtonColor: "#48cab2",
          confirmButtonText: "Yes !!!", 
      }).then((result) => {
          if (result.value) { 
          $.ajax({
            type: "POST",
            url: '<?php echo base_url('commoncontroller/changeStatus')?>',
            data:{status:status,column_name:column_name,id:id,table:table},
            dataType:'html',
            success: function(response){
              //alert(response);
              window.location.reload();
              if(response ==1 ){
                // do something 
                
              }
              else{
                //nothing to do 
              }
            },
            error:function(response){
            //error msg
            }
          }); 
        }
      })
   // }
    return false;
});

////common fn for delete
$(document).on('click','.change-p-delete',function(){
    if(confirm("Are you sure you want to delete this ?")){
       var selector = $(this);
      
       var column_name = $(this).attr('data-column_name');
       var id = $(this).attr('id');
       var table = $(this).attr('data-table');
       
       $.ajax({
          type: "POST",
          url: '<?php echo base_url('commoncontroller/changeStatusDelete')?>',
          data:{column_name:column_name,id:id,table:table},
          dataType:'html',
          success: function(response){
            //alert(response);
             window.location.reload();
            if(response ==1 ){
              // do something 
               
            }
            else{
              //nothing to do 
            }
          },
          error:function(response){
           //error msg
          }
      }); 
    }
    return false;
});

// time picker cafe add/edit

$('#start_time').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '12:00pm',
    maxTime: '11:59pm',
    defaultTime: '12',
    startTime: '12',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
$('#end_time').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '12:00pm',
    maxTime: '11:59pm',
    defaultTime: '10:00pm',
    startTime: '12',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});

$('#start_time1').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '12:00pm',
    maxTime: '11:59pm',
    //defaultTime: '12',
    startTime: '12',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
$('#end_time1').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '12:00pm',
    maxTime: '11:59pm',
    //defaultTime: '10:00pm',
    startTime: '12',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});


//add reservation date time validation
var reservation_min_time="12:00pm";

 
var currDate = new Date();
  $('#reservation_date').datepicker({
    startDate : currDate,
    todayHighlight: true,
    minDate: 0,
    maxDate: '+30D',
   //format: 'dd/mm/yyyy'
   dateFormat: 'dd/mm/yy',
    autoclose: true,
    onSelect: function(dateText) {
      
        //reset cafe list
        $('#cafe_id').val('');
        var today = new Date();
        var selectedDate = $('#reservation_date').datepicker('getDate');
        today.setHours(0);
        today.setMinutes(0);
        today.setSeconds(0);

      //alert(Date.parse(selectedDate));
      //alert(Date.parse(today));
      var p_time = '';
      if (Date.parse(today) < Date.parse(selectedDate)) {
        p_time = "12:00pm";
        //p_time = "00:00am";
        //alert(p_time);
      }else{
        p_time = "<?=date('H:i A')?>";
        //alert(p_time);
      }
      //$('#reservation_time').timepicker('setTime', null);
      $('#reservation_time').timepicker({
        'timeFormat': 'h:mm p',
        'disableTextInput': true,
        'interval': 30,
        'minTime': p_time,
        'maxTime': '09:00pm',
        //'maxTime': '11:00pm',
        //defaultTime: '12',
        //startTime: '12',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        change: function(time) {
          //reset cafe list
          $('#cafe_id').val('');
          var today = new Date();
          var selectedDate = $('#reservation_date').datepicker('getDate');
          today.setHours(0);
          today.setMinutes(0);
          today.setSeconds(0);
          console.log(selectedDate);
          console.log(today);
          if (Date.parse(today) == Date.parse(selectedDate)) {
            if (new Date().getHours() > $(this).timepicker('getTime').getHours()) {
              alert('Please select time in future not past time');
              $(this).val('');
            }
          }
          else
            {
              var html_dropdown="";
              var max=24;
              var dropdown_max=12;
              var dropdown_max=parseInt(max)-parseInt($(this).timepicker('getTime').getHours());
              for(i=1;i<=dropdown_max;i++)
              {
                var html_dropdown=html_dropdown+'<option value="'+i+'">'+i+'</option>';
              }
            }
          }
      });
    }
  });
  // .on('changeDate', function() {
  //   console.log('do');
  //      var today = new Date();
  //     var selectedDate = $('#reservation_date').datepicker('getDate');
  //     today.setHours(0);
  //     today.setMinutes(0);
  //     today.setSeconds(0);
  //     //alert(selectedDate);
  //      //alert(today);
  //     if (Date.parse(today) == Date.parse(selectedDate)) {
  //      // alert('today');
  //      // alert(new Date().getHours());
  //      var present_hr=new Date().getHours();
  //      console.log(present_hr);
  //      if(present_hr>12)
  //      {
  //       var reservation_min_time=(present_hr-12)+':00pm';
  //        $("#reservation_time").timepicker('option',{'minTime': reservation_min_time});
  //      }

       
  //     }else{
  //       console.log('check');
  //     }
      
  //          $('.r_time').show();
  // });

 ///start time
// var p_time = "<?=date('H:i A')?>";
//  alert(p_time);
//  $('#reservation_time').timepicker({
//    timeFormat: 'h:mm p',
//    interval: 30,
//    minTime: p_time,
//    maxTime: '11:00pm',
//    //defaultTime: '12',
//    startTime: '12',
//    dynamic: false,
//    dropdown: true,
//    scrollbar: true,
//    change: function(time) {
//       //reset cafe list
//       $('#cafe_id').val('');
//
//      var today = new Date();
//
//       var selectedDate = $('#reservation_date').datepicker('getDate');
//      today.setHours(0);
//      today.setMinutes(0);
//      today.setSeconds(0);
//      //alert(selectedDate);
//       //alert(today);
//      if (Date.parse(today) == Date.parse(selectedDate)) {
//        
//        ////alert($(this).timepicker('getTime').getHours());
//        if (new Date().getHours() > $(this).timepicker('getTime').getHours()) {
//          alert('Please select time in future not past time');
//          $(this).val('');
//        }
//      }
//      else
//        {
//          var html_dropdown="";
//          var max=24;
//          var dropdown_max=12;
//          var dropdown_max=parseInt(max)-parseInt($(this).timepicker('getTime').getHours());
//          //alert($(this).timepicker('getTime').getHours());
//          //alert(dropdown_max);
//          for(i=1;i<=dropdown_max;i++)
//          {
//            var html_dropdown=html_dropdown+'<option value="'+i+'">'+i+'</option>';
//          }
//          //$('#duration').html(html_dropdown);
//          //$('.r_duration').show();
//        }
//
//        //$('.r_duration').show();
//      } 
//      // var element = $(this), text;
//      //       // get access to this Timepicker instance
//      //       var timepicker = element.timepicker();
//      //       text = 'Selected time is: ' + timepicker.format(time);
//      //       alert(time);
//      //       alert(text);
//        
//   
//});

/**Populate reservation data */
function member_data(userId)
{
  user_id = userId;
  let u = $('#user_id :selected');
  $('#name').val(u.text());
  $('#email').val(u.data('email'));
  $('#mobile').val(u.data('mobile'));

  //
  chkSubscriptionDiscount();  //API call to check membership discount
  // $.ajax({
  //         type: "POST",
  //         url: '<?php echo base_url('admin/reservation/get_member_data')?>',
  //         data:{user_id:user_id},
  //         dataType:'json',
  //         success: function(response){
  //           $('#name').val(response.name);
  //           $('#email').val(response.email);
  //           $('#mobile').val(response.mobile);
  //         },
  //         error:function(response){
          
  //         }
  //     }); 
  
}
//function to display memeberr data in add reservation
function reservation_type_change(selected_val)
{
  if(selected_val=="1")
  {
    $('.member_dd').show();
    $('.member_dd').attr("required",true);
  }
  else
  {
    $('.member_dd').attr("required",false);
    $('#name').val('');
    $('#email').val('');
    $('#mobile').val('');
    $('.member_dd').val('');
    $('.member_dd').hide();
    $('#membership-discount').hide();
  }
}

//populate room as per availability
function populate_room(cafe_id)
{
  /**
   * calculate room price
  */
  //calculateReservationCharge();
  let jsonObj = {
        no_of_guests: $('#no_of_guests').val(),
        reservation_date: $('#reservation_date').val(),
        reservation_time: $('#reservation_time').val(),
        duration: $('#duration').val(),
        cafe_id: cafe_id,
      }
  $.ajax({
          type: "POST",
          url: '<?php echo base_url('api/v1/availablility_chk')?>',
          data: JSON.stringify(jsonObj),
          dataType:'json',
          success: function(response){
            if(response.status.error_code==1)
            {
              $('#ReservationAddform #cafe_id').val('');
              alert(response.status.message);
            }
            else
            {
              $('#ReservationAddform #room_id').html('');
              $('#ReservationAddform #room_id').append('<option value=""> -- Select Room --</option>');
              response.result.rooms.forEach(f=>{
                $('#ReservationAddform #room_id').append('<option value="'+f.room_id+'">'+f.room_no+'</option>');
              })
            }
          },
          error:function(response){
            alert("Sorry!! something wrong");
          }
      }); 
}

//apply promo coupon
$('#apply-reservation-coupon').on('click', function(){
  if($('#coupon').val().trim() == ""){
    alert('Cupon code is required');
    return false;
  }
  if(total_amount == 0){
    alert('Please select all the required fields to apply promo');
    return false;
  }
  //check membership amount
  // if($('#membership_discount_amount').val())
  // {
  //   total_amount= total_amount-parseInt($('#membership_discount_amount').val());
  // }

  let jsonObj = {
    coupon_code: $('#coupon').val().trim(),
    total_amount: total_amount
      }
  $.ajax({
          type: "POST",
          url: '<?php echo base_url('api/apply_promo')?>',
          data: JSON.stringify(jsonObj),
          dataType:'json',
          success: function(response){
            if(response.status.error_code==1)
            {
              alert(response.status.message);
              $('#discount_amount').val('');
              $('promo-discount strong').text('');
              $('#promo-discount').hide();
              $('#remove-reservation-coupon').hide();
            }
            else
            {
              $('#promo-discount strong').text(response.result.discount_amount);
              $('#discount_amount').val(response.result.discount_amount);
              $('#remove-reservation-coupon').show();
              $('#promo-discount').show();
              calPayableAmount();
            }
          },
          error:function(response){
            alert("Sorry!! something wrong");
          }
  });
})

//remove promo
$('#remove-reservation-coupon').on('click', function(){
  if(confirm('Are you sure to remove applied coupon?')){
    $('#promo-discount strong').text('');
    $('#discount_amount').val('');
    $('#promo-discount').hide();
    $('#coupon').val('');
    calPayableAmount(coupon = false);
    $(this).hide();
  }
})

//get user details based on mobile number
$('#mobile').on('focusout', function(){
  let mobile = $(this).val().trim();
  console.log(userData)
  console.log(mobile)
  if(mobile.length >= 10){
    userData.forEach(f=>{
      if(f.mobile == mobile){
        $('#name').val(f.name);
        $('#email').val(f.email);
        $('#mobile').val(f.mobile);
      }
    })
  }
})


$('.check-price').on('change', function(){
  calculateReservationCharge();
  
  chkSubscriptionDiscount();
})
function calculateReservationCharge(){
  let price = parseInt($('#cafe_id :selected').data('info'));
  let guests = parseInt($('#no_of_guests').val());
  let duration = parseInt($('#duration').val());
  if(!isNaN(price) && !isNaN(guests) && !isNaN(duration)){
    total_amount = price*guests*duration;
    $('#reservation_charge').val(total_amount);

    //calculate payable amount
    calPayableAmount();
  }else{
    $('#reservation_charge').val('Reservation charge');
  }
}

//calculate payable amount for each scenarion
function calPayableAmount(coupon = true){
  let amt = total_amount;
  if($('#membership_discount_amount').val())
  {
    amt= amt-parseInt($('#membership_discount_amount').val());
  }
  if($('#discount_amount').val())
  {
    amt= amt-parseInt($('#discount_amount').val());
  }
  $('#payable-amount strong').text(amt);
}


function chkSubscriptionDiscount(){
  if(user_id =="" || total_amount==0){
    return false;
  }
  let jsonObj = {
    user_id: user_id,
    total_amount: total_amount
      }
  $.ajax({
          type: "POST",
          url: '<?php echo base_url('api/chkSubscriptionDiscount')?>',
          data: JSON.stringify(jsonObj),
          dataType:'json',
          success: function(response){
            console.log(response);
            if(response.status.error_code==1)
            {
              alert(response.status.message);
              $('#membership_discount_amount').val('');
              $('#membership_discount_percent').val('');
              $('#membership-discount strong').text('');
              $('#membership-discount').hide();
            }
            else
            {
              $('#membership-discount strong').text(response.result.membership_discount_amount);
              $('#membership_discount_amount').val(response.result.membership_discount_amount);
              $('#membership_discount_percent').val(response.result.membership_discount_percent);

              $('#membership-discount').show();

              calPayableAmount();
            }
          },
          error:function(response){
            alert("Sorry!! something wrong");
          }
  });
}
</script>


<!-- By Chayan  -->
<script src="<?=base_url('public/admin_assets/sweetalert2.all.min.js')?>"></script>
<script src="<?=base_url('public/admin_assets/common-function.js')?>"></script>
<script>
$(document)  .ready(function(){
    $(document).on("click", "#food_dataTable .change-p-status", function(e) {
    e.preventDefault();
    var status = $(this).attr("data-status");
    let msg = '';
    if(status == 3){
      msg = "delete";
    }else if(status == 1){
      msg = "active";
    }else{
      msg = "inactive";
    }
    Swal.fire({
        title: "Are you sure want to "+msg+" this ?",
        type: "warning",
        showCancelButton: true, // true or false  
        confirmButtonColor: "#dd6b55",
        cancelButtonColor: "#48cab2",
        confirmButtonText: "Yes !!!", 
    }).then((result) => {
        if (result.value) { 
            let id = $(this).attr("data-id");
            let indexKey = $(this).attr("data-key-id");
            let table = $(this).attr("data-table");
            let dataJson = {
                id: id,
                indexKey: indexKey,
                table: table,
                status: status,
            };
            if (id && table) {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('food/api/')?>" + "changeStatus",
                    data: JSON.stringify(dataJson),
                    success: function(res) {
                        if (res.status.error_code == 0) {
                            if (status == 3) {
                                swalAlert("Data deleted successfully", "success");
                                setTimeout(function(){
                                  location.reload();
                                  //drawTable();
                                }, 2000);
                            } else { 
                                if (status == 0) {
                                    $("#" + id).attr("data-status", "1"); 
                                    $("#" + id).removeClass("text-success");
                                    $("#" + id).addClass("text-danger");
                                    $("#" + id).html("Inactive");
                                } else {
                                    $("#" + id).attr("data-status", "0");
                                    $("#" + id).removeClass("text-danger");
                                    $("#" + id).addClass("text-success");
                                    $("#" + id).html("Active");
                                }
                                swalAlert(res.status.message, "success");
                            }
                        } else {
                            swalAlert(res.status.message, "warning");
                        }
                    },
                });
            }
          }
      });
  });
})
</script>
<script>
  $(document).ready(function(){
    $('.timepicker').timepicker({});
  })
</script>
