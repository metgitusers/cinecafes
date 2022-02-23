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
                                                    <div class="staff_tab_area">
                                                    <?php
                                                        if(!empty($order_address)){
                                                            $address = $order_address[0];
                                                            ?>
                                                                <p><b>Order No :</b>#<?=$food_order_id?>. </p>
                                                                <p><b>Name:</b> <?=$address->name?>. </p>
                                                                <p><b>Address:</b> <?=$address->address?>, <b>Locality</b>:<?=$address->locality?>. </p>
                                                                <p><b>District:</b> <?=$address->district?>. </p>
                                                                <p><b>Phone:</b> <?=$address->phone?> </p>
                                                                <p><b>PIN:</b> <?=$address->pincode?> (<?=$address->state?>). </p>
                                                            <?php
                                                        }else{
                                                            echo '<p>Address not added yet</p>';
                                                        }
                                                    ?>
                                                        
                                                        <div id="active_user" class="tab-pane active"><br>
                                                            <div class="table-responsive">			
                                                                <table class="table table-striped table-bordered c_table_style" id="">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="border-top-0">SL No.</th>
                                                                            <th class="border-top-0">Product</th>
                                                                            <th class="border-top-0">Quantity</th>
                                                                            <th class="border-top-0">Price</th>
                                                                            <th class="border-top-0">Total</th>
                                                                            <th class="border-top-0">Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                            $total_apyable = 0;
                                                                        if($details){
                                                                            foreach ($details as $key => $order) {
                                                                                $total_apyable = $total_apyable+($order->quantity*$order->ordered_price);
                                                                                ?>
                                                                                    <tr>
                                                                                        <td><?= ($key+1) ?></td>
                                                                                        <td><?=$order->item_name?></td>
                                                                                        <td><?=$order->quantity?></td>
                                                                                        <td><?=$order->ordered_price?></td>
                                                                                        <td><?=$order->quantity*$order->ordered_price?></td>
                                                                                        <td><?=$order->description?></td>
                                                                                    </tr>
                                                                                <?php
                                                                                if($order->addons){
                                                                                    foreach ($order->addons as $k => $addons) {
                                                                                        $total_apyable = $total_apyable+($addons->quantity*$addons->price);
                                                                                       ?>
                                                                                        <tr>
                                                                                            <td style="padding-left: 30px;"><?=($key+1).'.'.($k+1)?></td>										
                                                                                            <td><?=$addons->addon_name?></td>
                                                                                            <td><?=$addons->quantity?></td>
                                                                                            <td><?=$addons->price?></td>
                                                                                            <td><?=$addons->quantity*$addons->price?></td>
                                                                                            <!-- <td><?=$addons->addon_description?></td> -->
                                                                                        </tr>
                                                                                       <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <tr>                                                                       
                                                                            <td colspan=6 class="text-right" style="font-size: 18px;">Total Order Amount Rs.<?=$total_apyable?></td>
                                                                        </tr>
                                                                        <?php
                                                                        if(!empty($order_coupon)){
                                                                            $coupon = $order_coupon[0];
                                                                            $total_apyable = $total_apyable-$coupon->discount_amount;
                                                                        ?>
                                                                        <tr>                                                                       
                                                                            <td colspan=5 class="text-right" style="font-size: 16px;">Used coupon [ <span><?=$coupon->coupon_code?></span> ]</td>
                                                                            <td colspan=1 class="text-right" style="font-size: 16px;">Discount Amount Rs. -<?=$coupon->discount_amount?></td>
                                                                        </tr>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <tr>                                                                       
                                                                            <td colspan=6 class="text-right" style="font-size: 18px;">Total Payable Amount Rs.<?=$total_apyable?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
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