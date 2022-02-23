<div class="row">
  <div class="col-sm-10 offset-1">
    <div class="staff_tab_area">                                                        
      <div class="tab-content">
        <div id="" class="tab-pane active"><br>
          <div class="table-responsive custom_table_area">
            <table class="table table-striped table-bordered c_table_style export_btn_dt reservation_commission_list_table">
              <thead>
                  <tr>
                      <th>Sl No.</th>
                      <th>Date</th>
                      <th>No. of Bookings</th>
                  </tr>
              </thead>
              <tbody>                                                                                
                  <?php if (!empty($reservation_commission_list)) {
                    $c= 1;
                    ?>
                  <?php foreach ($reservation_commission_list as $key => $list) { 
                    $slug = base64_encode($key);
                    ?>
                          <tr>
                            <td><?= $c ?></td>
                            <td><?= date('d/M/Y', strtotime($key)) ?></td>                                                                                 
                            <td>
                              <!-- viewReservationDetails -->
                              <a title="View" 
                                style="width:auto; height:auto;text-decoration: underline;" 
                                href="<?=base_url('commission/ReservationCommission/viewReservationDetails/'.$cafe_id.'/'.$slug)?>" 
                                class="btn_action edit_icon"
                              >
                                <strong><?= count($list); ?></strong>
                              </a>
                            </td>
                          </tr>
                  <?php 
                  $c++;
                  } 
                  } else { ?>
                      <tr>
                          <td colspan="3" style="text-align:center;">No Data Available</td>
                      </tr>
                <?php  } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
