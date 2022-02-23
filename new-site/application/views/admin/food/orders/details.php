<div class="main-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('success_msg')) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <?php echo $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <?php echo $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>
            <h1 class="h3 mb-2 text-gray-800">Food Items Order</h1>
            <p align="right">
                <a href="<?php echo base_url('admin/food/orders');?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Food Order List</span>
                </a>
            </p>
            <p><span class="text"></span></a></p>
            <div class="clearfix"></div>
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="page-title-wrap card-header">
                                    <h6 class="card-title">Food Order Details</h6>
                                </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <form class="form">
                                        <div class="form-body">
                                            <!--<h4 class="form-section">
                                                <i class="icon-user"></i> Personal Details</h4>-->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="staff_tab_area order-info">
                                                    <?php
                                                        if(!empty($order_address)){
                                                            $address = $order_address[0];
                                                            ?>
                                                                <p class="pull-right"><b>Order No :</b> #<?=$food_order_id?> </p>
                                                                <p><b>Name :</b> <?=$address->name?>. </p>
                                                                <p><b>Delivery To :</b></p>
                                                                    <?=$address->address?>                                                                
                                                                    <?=!empty($address->locality)?', '.$address->locality:''?>
                                                                    <?=!empty($address->district)?', '.$address->district:''?>
                                                                    <?=!empty($address->pincode)?', '.$address->pincode:''?>
                                                                    <?=!empty($address->state)?'( '.$address->state.' )':''?>                                                                
                                                                <p><b>Phone :</b> <?=$address->phone?> </p>
                                                            <?php
                                                        }else{
                                                            echo '<p>Address not added yet</p>';
                                                        }
                                                    ?>
                                                        
                                                        <div id="active_user" class="tab-pane active"><br>                                                            
                                                        <?php
                                                            $total_apyable = 0;
                                                            if($details){
                                                                foreach ($details as $key => $order) {
                                                                    $total_apyable = $total_apyable+($order->quantity*$order->ordered_price);
                                                                ?>
                                                            <div class="col-md-12">
                                                                <div class="invoice_details">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="propduct_name_invoice">
                                                                                <span><?=$order->item_name?></span>
                                                                                <p><?=$order->description?></p>
                                                                                <b><?=$order->quantity?> X <?=$order->ordered_price?></b>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
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
                                                                                    <div class="col-md-6">
                                                                                        <div class="propduct_name_invoice">
                                                                                            <span><?=$addons->addon_name?></span>
                                                                                            <b><?=$addons->quantity?> X <?=$addons->price?></b>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
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
                                                            <div class="invoice_total">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="totalamount">Total Order Amount</div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="totalamount_price"><i class="fa fa-inr" aria-hidden="true"></i> <?=$total_apyable?></div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                    if(!empty($order_coupon)){
                                                                        $coupon = $order_coupon[0];
                                                                        $total_apyable = $total_apyable-round($coupon->discount_amount, 0);
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                                            <div class="totalamount">Used coupon (<?=$coupon->coupon_code?>)</div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="totalamount_price">- <i class="fa fa-inr" aria-hidden="true"></i><?=round($coupon->discount_amount,0)?></div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="totalamount">Total Payable Amount</div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="totalamount_price"><i class="fa fa-inr" aria-hidden="true"></i> <?=$total_apyable?></div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                               </div>
                                          </div>
                                    </form>
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
<script>
$(document).ready(function(){
    
})
</script>