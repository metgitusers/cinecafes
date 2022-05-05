<!--Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Reservation</h1>

 <p align="right"><a href="<?php echo base_url();?>admin/reservation/add" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span></a></p>

<p><span class="text"></span></a></p>
          	<div class="clearfix"></div>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listing</h6>
            </div>
            <div class="card-body table_panel">
               <?php if ($this->session->flashdata('success_message')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('success_message') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('error_message') ?>
                </div>
            <?php endif ?>
              <!--search-->
                <form action="" method="post" autocomplete="off">   
                 <div class="row">
                   <div class="col-sm-3">
                    <div class="form-group reserform_panel">
                      <label>From Date</label>
                      <div class="input-group">
                          <input id="start_date" name="start_date" type="text" class="form-control" value="<?php if(!empty($start_date)): echo $start_date;endif;?>"  placeholder="YYYY/MM/DD" />
                          <div class="input-group-append">
                          <span class="input-group-text">
                            <span class="fa fa-calendar-o"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="col-sm-3">
                    <div class="form-group reserform_panel">
                      <label>To Date</label>
                      <div class="input-group">
                          <input id="end_date" name="end_date" type="text" class="form-control" value="<?php if(!empty($end_date)): echo $end_date;endif;?>" placeholder="YYYY/MM/DD" />
                          <div class="input-group-append">
                          <span class="input-group-text">
                            <span class="fa fa-calendar-o"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php if(!empty($cafe_list)){ ?>
                  <div class="col-sm-3">
                    <div class="form-group reserform_panel">
                      <label>Cafe</label>
                      <div class="input-group">
                        <select name="cafe_id" id="cafe_id" class="form-control">
                          <option value="">Select Cafe</option>
                             <?php foreach($cafe_list as $row1){?>
                                <option value="<?php echo $row1['cafe_id'];?>" <?php if($row1['cafe_id']==$cafe_id) { echo "selected"; } ?>><?php echo $row1['cafe_name']."-".$row1['cafe_place'];?></option>
                             <?php } ?>
                        </select>
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                    	 <p style="text-align: left; margin-top: 30px;">                 
						   <button style="display: inline-block; width: auto; vertical-align: top;margin-right: 10px;" type="submit"  class="btn btn-primary btn-user btn-block" id="search_btn">
								<i class="fa fa-search" aria-hidden="true"></i> Search
						   </button>
						   <button style="display: inline-block; width: auto; vertical-align: top;margin-right: 10px;" type="button" onclick="location.href='<?php echo base_url('admin/reservation');?>';" class="btn btn-primary btn-user ">Reset</button>
						  </p>
					 </div>
                    
                  </div>
                <?php } ?>
                <div class="row">
<!--
              <div class='col-sm-2'>
                  <div class="form-group">
                   
                     <p style="text-align: right; margin-top: 2px;">
                 
                   <button type="submit"  class="btn btn-primary btn-user btn-block" id="search_btn">
                        <i class="fa fa-search" aria-hidden="true"></i> Search
                   </button>
                  </p>
                  </div>
                </div> 
                <div class='col-sm-2'>
                        <div class="form-group">                       
                         <p style="text-align: left; margin-top: 2px;">
                          <button type="button" onclick="location.href='<?php echo base_url('admin/reservation');?>';" class="btn btn-primary btn-user btn-block">Reset</button></p>
                        </div>
                      </div>
-->
					<div class="clearfix"></div>
					</div>
             <div class="table-responsive">
                <table class="table table-bordered" id="myReservation" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>Booking No</th>
                      <th>Customer Details</th>
                      
                      <th>Reservation date</th>
                      <th>Cafe</th>
                     
                      <th>Room</th>
                     
                      <th>No of guests</th>
                      <th>Total price</th>
                      
                      <th>Item price</th>
                      <th>GST</th>

                      <!-- <th>Discount</th> -->
                      <th>Payment Method</th>
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th> 
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sl No.</th>
                      <th>Booking No</th>
                      <th>Customer Details</th>
                      
                      <th>Reservation date</th>
                      <th>Cafe</th>
                     
                      <th>Room</th>
                     
                      <th>No of guests</th>
                      <th>Total price</th>

                      <th>Item price</th>
                      <th>GST</th>
                      <!-- <th>Discount</th> -->
                      <th>Payment Method</th>
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ ?>
                      <tr>
                      <td><?php echo $i;?></td>
                      <!-- <td><?php echo $row['reservation_no'];?></td> -->
                      <td><?=(!empty($row['reservation_no'])?$row['reservation_no']:$row['reservation_id']);?></td>
                      <td><?php echo $row['name'];?>
                      <br><a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a>
                      <br><?php echo $row['mobile'];?>
                      </td>
                     
                      <td><?php echo date('d-m-Y', strtotime($row['reservation_date']));?>    <?php echo date('g:i a', strtotime($row['reservation_time']))." to ".date('g:i a', strtotime($row['reservation_end_time']));?></td>
                      <td><?php echo $row['cafe_name'];?></td>
                     <!--  <td><?php //echo $row['movie_name'];?></td> -->
                      <td>
                        <?php
                            if(empty($row['room_no']) || $row['room_no'] == null){
                              echo '<button type="button" class="btn btn-primary assigned-room" data-id="'.$row['reservation_id'].'" data-parent="'. $row['cafe_id'] .'">Add room</button>';
                            }else{ 
                              echo $row['room_no'];
                            }
                        ?>
                      </td>
                     <!--  <td><?php //echo "Rs.".' '.$row['hourly_price'];?></td> -->
                      <td><?php echo $row['no_of_guests'];?></td>
                      <td><?php echo "Rs.".' '.$row['total_price'];?></td>

                      <td><?php 
                      
                        //gst calculation                          
                        $item_price = round($row['total_price']*100/(100+18));
                        echo "Rs. ".$item_price;                        
                      
                      ?></td>

                      <td><?php 
                      
                        //gst calculation                          
                        $gst = $row['total_price'] - $item_price;
                        echo "Rs. ".$gst;                        
                      
                      ?></td>

                      <!-- <td><?php echo "Rs.".' '.($row['total_price']-$row['payable_amount']);?></td> -->
                      <td><?php 
                      if($row['payment_mode']=="")
                      {
                        echo "Backend Transaction";
                      }
                      else
                      {
                        echo $row['payment_mode'];
                      }
                      ?></td>
                      
                     <!-- <td><?php //echo date('d-m-Y', strtotime($row['created_on']));?></td>  -->
                      <td>
                        

                         <?php if($row['status']==2){ echo "<p style='color:red;font-size: 15px;''>Cancelled</p>"; } else if($row['status']==1){  echo "<p style='color:green;font-size: 15px;''>Reserved</p>"; }  ?>
                      </td>
                      <!-- <td><?php //echo date('d-m-Y', strtotime($row['created_ts']));?></td> -->
                      <td>
                        <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/reservation/detail/<?php echo $row['reservation_id'];?>">
                        <i class="fa fa-eye" aria-hidden="true"></i></a>
                        <br>
                        <?php if($row['status']==1) {?>
                          <a class="btn btn-danger btn-circle btn-sm" href="javascript:void(0);" title="Cancel Reservation" onclick="return confirm('Do You Want To Cancel The Reservation ?');" data-toggle="modal" data-target="#cancelModal-<?=$row['reservation_id']?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                        <?php }?>                        
                      </td>
                    </tr>
                   
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="13">No Reservation Found</td>                          
                      </tr>
                      <?php } ?>
                   
                  </tbody>
                </table>
              </div>
              </div>
            </form>
        <!--search-->              
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content-->
</div>
<!-- room list modal -->
<div class="modal" id="modal-roomlist" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="h3 mb-2 text-gray-800">Assign reservation room</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group">
            <select name="room" id="room" class="form-control">
              <option value="">Select Cafe</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary mr-2" id="update-reservation-room">Assign</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php if(!empty($list)){ $i=1; foreach($list as $row){ ?>
<!-- Modal -->
<div class="modal fade" id="cancelModal-<?=$row['reservation_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="post" action="<?php echo base_url();?>admin/reservation/cancel_reservation/">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: #000;border: 1px solid #FFF;">
        <div class="modal-header" style="height: 50px;">
          <h5 class="modal-title" id="exampleModalLabel">Cancel Reservation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding: 0rem 0rem;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="reservation_id" value="<?=$row['reservation_id']?>">
          <textarea name="cancellation_reason" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Cancel</button>
        </div>
      </div>
    </div>
  </form>
</div>
<?php } }?>
<script>
  $(document).ready(function(){
    var reservation_id = '';
    $('.assigned-room').on('click', function(){
      let cafe_id = $(this).data('parent');
      reservation_id = $(this).data('id');
      $.ajax({
        type: "POST",
        url: "<?=base_url('api/getRoomList')?>",
        data: {
          id: reservation_id,
          cafe_id: cafe_id
        },
        dataType: "JSON",
        success: function(response){
          $('#room').html('');
          $('#room').append('<option value="">--Select Room--</option>');
          if(response.status.error_code == 0){
            if(data = response.result.data){
              data.forEach(f => {
                $('#room').append('<option value="'+ f.room_id +'">'+ f.room_no +'</option>');
              })
            }
            $('#modal-roomlist').modal('show');
          }else{
            alert('Sorry no room available');
          }
        },
        error: function(err){
          console.log(err);
        }
      })
    })

    $('#update-reservation-room').on('click', function(){
      let room_id = $('#room').val();
      if(room_id == ""){
        alert('Please select room before update');
        return false;
      }
      if(confirm('Are you sure to assign this room !!')){
        $.ajax({
          type: "POST",
          url: "<?=base_url('api/updateReservation')?>",
          data: {
            id: reservation_id,
            room_id: room_id
          },
          dataType: "JSON",
          success: function(response){
            $('#room').html('');
            $('#room').append('<option value="">--Select Room--</option>');
            if(response.status.error_code == 0){
              alert('Room has been assigned successfully');
              location.reload();
            }else{
              alert('Sorry!! no room available');
            }
          },
          error: function(err){
            console.log(err);
          }
        })
      }
    })
  })
</script>

