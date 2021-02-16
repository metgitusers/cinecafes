<!--Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">Reservation details</h1>
 <p align="right"><a href="<?php echo base_url();?>admin/reservation" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">List</span></a></p>
	<div class="clearfix"></div>
    <div class="form_panel">          		
         <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">

                <div class="form-group reservation_details">
                      <h5>Customer Details</h5>
                      <div class="row">
                       <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Name :</span> <?php echo $row['name'];?></p>
						</div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Email :</span> <?php echo $row['email'];?></p>
					</div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Phone :</span> <?php echo $row['mobile'];?></p>
					</div>
					</div>
                    </div>
                </div>
                 <div class="col-md-12 col-sm-12 col-xs-12">
                	 <div class="form-group reservation_details">
                    	<h5>Booking Details</h5>
                      <div class="row">
                       <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Date: </span><?php echo date('d-m-Y', strtotime($row['reservation_date']));?></p>
						 </div>
                       <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Time: </span><?php echo date('g:i a', strtotime($row['reservation_time']))." to ".date('g:i a', strtotime($row['reservation_end_time']));?> </p>
						 </div>
                       <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>No of guests:</span> <?php echo $row['no_of_guests'];?> </p>
						 </div>
						<div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Cafe Name :</span><?php echo $row['cafe_name'];?></p> 
						 </div>
                       <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Room No :</span><?php echo $row['room_no'];?></p> 
						 </div>
                        <?php if(!empty($row['media_type'])){?>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                        <p><span>Entertainment Media: </span> <?php echo $row['media_type']; ?>
						 
                          <b style="display: inline-block; padding-left: 10px;"><?php if(!empty($movie_list)){ echo $movie_list['name']; } }?></b>
                          </div>
						 </div>
                     <?php if(!empty($details)){ ?>
                      <h5><u>Ordered Food</u></h5>
                     <div class="row" id="reservation-food">
                        <?php
                          $total_apyable = 0;
                          if($details){
                              foreach ($details as $key => $order) {
                                  $total_apyable = $total_apyable+($order->quantity*$order->ordered_price);
                              ?>
                          <div class="col-md-12">
                              <div class="invoice_details">
                                  <div class="row">
                                      <div class="col-md-8">
                                          <div class="propduct_name_invoice">
                                              <span><?=$order->item_name?></span>
                                              <p><?=$order->description?></p><br>
                                              <b><?=$order->quantity?> X <?=$order->ordered_price?></b>
                                          </div>
                                      </div>
                                      <div class="col-md-1">
                                          <div class="propduct_Quentity_invoice">
                                          
                                          </div>
                                      </div>
                                      
                                      <div class="col-md-3">
                                          <div class="propduct_total_invoice">
                                              <b><i class="fa fa-inr" aria-hidden="true"></i>
                                              <?=$order->quantity*$order->ordered_price?>
                                              </b>
                                          </div>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  <?php
                                  if($order->addons){
                                      foreach ($order->addons as $k => $addons) {
                                          $total_apyable = $total_apyable+($addons->quantity*$addons->price);
                                          ?>
                                  <div class="row addon">
                                      <div class="col-md-12">
                                          <div class="invoice_details invoice_detailsaddon">
                                              <div class="row">
                                                  <div class="col-md-8">
                                                      <div class="propduct_name_invoice">
                                                          <span><?=$addons->addon_name?></span><br>
                                                          <b><?=$addons->quantity?> X <?=$addons->price?></b>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-1">
                                                      <div class="propduct_Quentity_invoice">
                                                      
                                                      </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                      <div class="propduct_total_invoice">
                                                          <b><i class="fa fa-inr" aria-hidden="true"></i>
                                                          <?=$addons->quantity * $addons->price?>
                                                          </b>
                                                      </div>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <?php
                                      }
                                  }
                                  ?>
                              </div>
                          </div>
                          <?php
                              }
                          }
                          ?>
                    </div>
                   <?php
                     }
                   ?>
                </div>
                
                
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="form-group reservation_details">
                      <h5>Payment Details</h5>
                      <div class="row">
					   <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Payment Mode: </span>
                          <?php
                          if($row['payment_mode']=="")
                      {
                        echo "Backend Transaction";
                      }
                      else
                      {
                        echo $row['payment_mode'];
                      }
                      ?></p>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                        <p><span>Total Amount: </span>Rs. <?php echo $row['total_price'];?></p>
					   </div>
                        <?php if(!empty($row['coupon_code']) && $row['discount_amount']>0){?> 
                         <div class="col-md-3 col-sm-12 col-xs-12">
                          <p><span>Coupon Code : </span><?php echo $row['coupon_code']; ?></p>
					   </div>
                         <div class="col-md-3 col-sm-12 col-xs-12">
                          <p><span>Coupon Discount: </span> Rs. <?php echo $row['discount_amount'];?></p>
					   </div>
                        <?php } ?>
                        <?php if($row['membership_discount_amount']>0){?> 
                          <div class="col-md-3 col-sm-12 col-xs-12">
                          <p><span>Membership Discount: </span> Rs. <?php echo $row['membership_discount_amount'];?></p>
					   </div>
                        <?php } ?>
                        <?php if($row['payable_amount']!=$row['total_price']){?> 
                          <div class="col-md-3 col-sm-12 col-xs-12">
                          <p><span>Payable Amount: </span> Rs. <?php echo $row['payable_amount'];?></p>
					   </div>
                        <?php } ?>
					   </div>
                    </div>
                  </div>
                  
            
            </div>          
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content