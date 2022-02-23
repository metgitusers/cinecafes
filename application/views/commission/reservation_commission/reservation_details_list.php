<?php
$resv_from_date=$this->session->userdata('from_dt');
$resv_to_date=$this->session->userdata('to_dt');
?>
<div>
    <div>
        <div class="container-fluid">            
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="page-title-wrap">
                                    <h4 class="card-title">Detail List</h4>
                                    <a class="title_btn t_btn_list" href="<?= base_url('commission/ReservationCommission/viewReservation/'.$cafe_id); ?>"><span><i class="fa fa-arrow-left" aria-hidden="true"></i></span> Back</a>    
                                </div>
                            </div>
                            <div class="card-body">
                              <div class="px-3">
                                <div class="form-body">
                                    <form id="reservation_filter_form" action="<?php //echo base_url().'admin/reservation/filterSearch';?>" method="Post" class="form custom_form_style">
                                        <div class="form-body">
                                            <div class="user_permission_top">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                      <div class="form-group">
                                                        <label>Room</label>
                                                        <div class="settlement_inline">
                                                          <select id="room_id" class="js-select2" name="room_id" data-show-subtext="true" data-live-search="true">
                                                            <option value="">Select</option>
                                                            <option value="" selected>All</option>
                                                            <?php if(!empty($room_list)): ?>
                                                            <?php   foreach($room_list as $list): ?>
                                                              <option value="<?php echo $list->room_id;?>" <?php if(!empty($room_id) && $room_id == $list->room_id): echo 'selected';endif;?>>
                                                              <?php echo $list->room_no.'('.$list->room_type_name.')';?></option>
                                                            <?php   endforeach; ?>
                                                            <?php endif; ?>
                                                          </select>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group" style="margin-bottom: 0;">
                                                            <label>Status</label>
                                                            <div class="settlement_inline">
                                                              <select id="status_id" class="js-select2" name="status_id" data-show-subtext="true" data-live-search="true">
                                                                <option value="">Select</option>
                                                                <option value="" selected>All</option>
                                                                <option value="1" <?php if(!empty($status_id) && $status_id == '1'): echo 'selected';endif;?>>Pending</option>
                                                                <option value="2" <?php if(!empty($status_id) && $status_id == '2'): echo 'selected';endif;?>>Confirm</option>
                                                                <option value="0" <?php if(!empty($status_id) && $status_id == '0'): echo 'selected';endif;?>>Cancelled</option>
                                                                <option value="3" <?php if(!empty($status_id) && $status_id == '3'): echo 'selected';endif;?>>No-show</option>
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>                                                                                                                                                
                                                    <div class="col-md-1" >
                                                      <div class="form-group" style="margin-top:-3px">
                                                       <label>&nbsp;</label>
                                                       <input type="hidden" name="cafe_id" id="cafe_id" value="<?php echo $cafe_id; ?>">
                                                       <button type="submit" style="padding-left:25px;padding-right:25px" class="btn btn-success pull-right" id="search_btn">
                                                          <i class="fa fa-search" aria-hidden="true"></i> Go
                                                        </button>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-1" >
                                                      <div class="form-group" style="margin-right:15px;margin-top:-3px">
                                                        <label>&nbsp;</label>
                                                        <button class="btn btn-danger pull-right" id="clear_btn">
                                                          <i class="fa fa-refresh" aria-hidden="true"></i> Clear
                                                        </button>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="reservation_details" class="row">
                                        
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    populateData();
    
    // var from_dt     = $('#from_dt').pickadate({format:'dd/mm/yyyy',autoclose:true}),
    // from_dt_picker  = from_dt.pickadate('picker');

    // var to_dt     = $('#to_dt').pickadate({format:'dd/mm/yyyy',autoclose:true}),
    // to_dt_picker  = to_dt.pickadate('picker');
    // from_dt_picker.on('set', function(event) {

    //     if ( event.select ) {
    //         to_dt_picker.set('min', from_dt_picker.get('select'));    
    //     }
    //     else if ( 'clear' in event ) {
    //         to_dt_picker.set('min', false);
    //     }
    // })

  });
    // $(document).on('change','#from_dt',function(event){
    //   $('#to_dt').val('');
    // });

$(document).on('click','#search_btn',function(event){
    event.preventDefault();
    populateData();
    
});

  function populateData(){
    var status_id           = $("#status_id").val();
    var cafe_id             = $("#cafe_id").val();
    var room_id             = $("#room_id").val();
    //var reservation_date    = $("#reservation_date").val();
    var cnt   = 0;    
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('commission/ReservationCommission/filterSearchResvDetails')?>",
        data:{
          date: "<?= $request_date ?>",
          status_id:status_id,
          cafe_id:cafe_id,
          room_id: room_id
        },
        dataType:'json',
        success: function(response){  
         //alert(response);          
          $("#reservation_details").html(response['html']);          
          var now = new Date();
          var date = now.getFullYear() + "-" + now.getMonth() + "-" + now.getDate();  
          $('.reservation_details_table').DataTable({
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',        
                text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export',
                tag:  'span',
                filename: 'reservation_details_report_' + date,
                exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                },
                footer: true                 
              }
              //'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          });  
        },
        error:function(response){
          $.alert({
           type: 'red',
           title: 'Alert!',
           content: 'error',
          });
        }
    });
}

$('#clear_btn').click(function(){
  $("#from_dt").val('');
  $("#to_dt").val('');
  <?php
  //$this->session->set_userdata('from_dt', "");
  //$this->session->set_userdata('to_dt', ""); 
  ?>
  window.location.reload();
})
</script>