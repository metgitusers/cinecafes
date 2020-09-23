<!--Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Transaction History</h1>

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
                  <input id="start_date" name="start_date" type="text" class="form-control"  value="<?php if(!empty($start_date)): echo $start_date;endif;?>"  placeholder="YYYY/MM/DD" />
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
                  <input id="end_date" name="end_date" type="text" class="form-control"  value="<?php if(!empty($end_date)): echo $end_date;endif;?>" placeholder="YYYY/MM/DD" />
                  <div class="input-group-append">
                  <span class="input-group-text">
                    <span class="fa fa-calendar-o"></span>
                  </span>
                </div>
              </div>
            </div>
          </div> 
          <?php if(!empty($user_list)){ ?>
                  <div class="col-sm-3">
                    <div class="form-group reserform_panel">
                      <label>User</label>
                      <div class="input-group">
                        <select name="user_id" id="user_id" class="form-control">
                          <option value="">Select User</option>
                             <?php foreach($user_list as $row1){?>
                                <option value="<?php echo $row1['user_id'];?>" <?php if($row1['user_id']==$user_id) { echo "selected"; } ?>><?php echo $row1['name'];?></option>
                             <?php } ?>
                        </select>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <div class="row">
      <div class='col-sm-2'>
          <div class="form-group">
           <label>&nbsp;</label>
             <p style="text-align: right; margin-top: 2px;">
         
           <button type="submit"  class="btn btn-primary btn-user btn-block" id="search_btn">
                <i class="fa fa-search" aria-hidden="true"></i> Search
           </button>
          </p>
          </div>
        </div>  
        <div class='col-sm-2'>
                <div class="form-group">
                <label>&nbsp;</label>
                 <p style="text-align: left; margin-top: 2px;">
                  <button type="button" onclick="location.href='<?php  echo base_url('admin/transactionhistory');?>';" class="btn btn-primary btn-user btn-block">Reset</button></p>
                </div>
              </div> 
		   </div>
		   <div class="table-responsive">
                <table class="table table-bordered" id="myTransactionhistory" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>Transaction ID</th>
                      <th>Transaction date</th>
                      <th>Transaction Details</th>
                      <th>Customer Details</th>
                      
                      <th>Amount</th>
                      <th>Payment Mode</th>
                      <th class="no-sort">Status</th>
                      <!-- <th class="no-sort">Action</th>  -->
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sl No.</th>
                      <th>Transaction ID</th>
                      <th>Transaction date</th>
                      <th>Transaction Details</th>
                      <th>Customer Details</th>
                      
                      <th>Amount</th>
                      <th>Payment Mode</th>
                      <th class="no-sort">Status</th>
                      <!-- <th class="no-sort">Action</th>  -->
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ 
                      $arrow="";
                      $color="";
                      if($row['add_wallet']==1)
                      {
                        $arrow='<i class="fa fa-arrow-up" style="color:green"></i>';
                        $color="green";
                      }
                      else
                      {
                        $arrow='<i class="fa fa-arrow-down" style="color:red"></i>';
                        $color="red";
                      }
                      ?>
                      <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['transaction_id'];?></td>
                      <td><?php echo date('d-m-Y H:i', strtotime($row['transaction_date']));?></td>
                      <td>
                        <?php 
                        echo $row['transaction_type'];
                        $content="";
                        if($row['transaction_type']=='Reservation')////reservation content
                        {
                          if($row['cafe_name']!='')
                          {
                            $content.= $row['cafe_name'];
                          }
                          if($row['reservation_date']!=''&& $row['reservation_time']!='')
                          {
                            $content.= " at ".$row['reservation_date']." ".$row['reservation_time'];
                          }
                        }

                        if($row['transaction_type']=='Reservation')////Package content
                        {
                          if($row['package_name']!='')
                          {
                            $content.= $row['package_name'];
                          }
                          
                        }
                        echo "<br>".$content;
                        ?>
                          
                        </td>
                      
                      <td><?php echo $row['name'];?>
                      <br><a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a>
                      <br><?php echo $row['mobile'];?></td>                  
                      <td style="color:<?php echo $color; ?>"><?php echo $arrow." Rs.".' '.$row['amount']; ?> </td>
                      <td><?php echo $row['payment_mode'];?></td>
                      <td>
                         <?php if($row['payment_status']==2){ echo "<p style='color:red;font-size: 15px;''>Failure</p>"; } else if($row['payment_status']==1){  echo "<p style='color:green;font-size: 15px;''>Success</p>"; } else if($row['payment_status']==0){  echo "<p style='color:red;font-size: 15px;''>Pending</p>"; }  ?>
                      </td>
                    
                     
                    </tr>
                   
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="12">No Transaction Found</td>
                          
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
      </div>
      <!-- End of Main Content-->

