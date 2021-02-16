   <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="float:none;">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
             <a href="<?php echo base_url(); ?>admin/member/index/App" style="text-decoration: none;">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">App Registered Users
</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $app_users; ?></div>
                    </div>
                    <div class="col-auto">
<!--                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>-->
                      <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
             <a href="<?php echo base_url(); ?>admin/membership" style="text-decoration: none;">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Members
</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $club_members; ?></div>
                    </div>
                    <div class="col-auto">
<!--                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>--> 
                      <i class="fa fa-user-circle fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
				</a>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
             <a href="<?php echo base_url(); ?>admin/member" style="text-decoration: none;">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $all_users; ?></div>
                        </div>
                        <!-- <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div> -->
                      </div>
						</a>
                    </div>
                    <div class="col-auto">
<!--                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>-->
                      <i class="fa fa-user fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->

          <div class="row">
             <div class="col-md-12">
               <form action="" method="post" autocomplete="off">   
                 <div class="row">
                   <div class="col-sm-3">
                    <div class="form-group reserform_panel">
                      <label>From Date</label>
                      <div class="input-group">
                          <input id="start_date" name="start_date" type="text" class="form-control" value="<?php if(!empty($start_date)): echo $start_date; endif;?>"  placeholder="YYYY/MM/DD" />
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
                <?php } ?>
                <div class="col-sm-3">
                  <div class="form-group">
                     <p style="text-align: left; margin-top: 30px;">
                   <button style="display: inline-block; width: auto; vertical-align: top;margin-right: 10px;" type="submit"  class="btn btn-primary btn-user" id="search_btn">
                        <i class="fa fa-search" aria-hidden="true"></i> Search
                   </button>
                   <button style="display: inline-block; width: auto; vertical-align: top;margin-right: 10px;" type="button" onclick="location.href='<?php echo base_url('admin/dashboard');?>';" class="btn btn-primary btn-user">Reset</button>
                  </p>
                  </div>
                  <!--  -->

                  </div>
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
                          <button type="button" onclick="location.href='<?php echo base_url('admin/dashboard');?>';" class="btn btn-primary btn-user btn-block">Reset</button></p>
                        </div>
                      </div>
-->
				   </div>
              </div>
            </form>
            <h1 class="h3 mb-0 text-gray-800">Today's Request For Reservation</h1>
            <a href="<?php echo base_url(); ?>admin/reservation"  style="display: inline-block; width: auto;" class="btn btn-primary btn-user btn-block pull-right"> View All Reservation</a>
             <div class="clearfix"></div>
              <div class="table-responsive dashboard_table" style="margin-top: 20px; margin-bottom: 20px;">
                <table class="table table-bordered" id="myReservation" width="100%" cellspacing="0">
                  <thead>
                   <tr>
                      <th>Sl No.</th>
                      <th>Customer Details</th>
                      
                      <th>Reservation date</th>
                      <th>Cafe</th>
                     
                      <th>Room</th>
                     
                      <th>No of guests</th>
                      <th>Total price</th>
                      <!-- <th>Discount</th> -->
                      <th>Payment Method</th>
                      <th class="no-sort">Status</th>
                      <th class="no-sort">Action</th> 
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sl No.</th>
                      <th>Customer Details</th>
                      
                      <th>Reservation date</th>
                      <th>Cafe</th>
                     
                      <th>Room</th>
                     
                      <th>No of guests</th>
                      <th>Total price</th>
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
                      <td><?php echo $row['name'];?>
                      <br><a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a>
                      <br><?php echo $row['mobile'];?>
                      </td>
                     
                      <td><?php echo date('d-m-Y', strtotime($row['reservation_date']));?>    <?php echo date('g:i a', strtotime($row['reservation_time']))." to ".date('g:i a', strtotime($row['reservation_end_time']));?></td>
                      <td><?php echo $row['cafe_name'];?></td>
                     <!--  <td><?php //echo $row['movie_name'];?></td> -->
                      <td><?php echo $row['room_no'];?></td>
                     <!--  <td><?php //echo "Rs.".' '.$row['hourly_price'];?></td> -->
                      <td><?php echo $row['no_of_guests'];?></td>
                      <td><?php echo "Rs.".' '.$row['total_price'];?></td>
                      <!-- <td><?php echo "Rs.".' '.($row['total_price']-$row['payable_amount']);?></td> -->
                      <td><?php echo !empty($row['payment_mode'])?$row['payment_mode']:'Backend Transaction';?></'td>
                      <td>
                        

                         <?php if($row['status']==2){ echo "<p style='color:red;font-size: 15px;''>Cancelled</p>"; } else if($row['status']==1){  echo "<p style='color:green;font-size: 15px;''>Reserved</p>"; }  ?>
                      </td>
                      <!-- <td><?php //echo date('d-m-Y', strtotime($row['created_ts']));?></td> -->
                     <td>
                        <a class="btn btn-success btn-circle btn-sm" href="<?php echo base_url();?>admin/reservation/detail/<?php echo $row['reservation_id'];?>">
                        <i class="fa fa-eye" aria-hidden="true"></i> </a> 
                       </td>
                    </tr>
                   
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="11">No Reservation Found</td>
                          
                      </tr>
                      <?php } ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Content Row -->
         

        </div>
        <!-- /.container-fluid -->