<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Food Order Invoice</title>
</head>

<body>
	<div style="width:100%; margin:0 auto; background:#fff; padding:30px; border:#ccc solid 1px;">
    <div style="margin-bottom:30px">
   <table cellspacing="0" cellpadding="0" style="width:100%;">
   	<tr>
    	<td style="font-weight:bold; padding:10px;">
            <img src="<?=$logo?>" alt="logo" height="100px" width="100px">
        </td>
        <td align="right">
        	<span style="font-size:25px; font-weight:bold; display:block; text-align:right; padding-bottom:5px;">Invoice No - <?=$food_order_id?></span>
            <span style="font-size:15px; font-weight:bold; display:block; text-align:right; padding-bottom:5px;"><?=d_format($order_user[0]->order_date, true)?></span>
        </td>
    </tr>
   </table>
   </div>
	<table width="100%;" cellpadding="0" cellspacing="0" style="border:#ccc solid 1px;">
    	<tr>
        	<td style="font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;">SL No.</td>
            <td style="font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;">Product</td>
            <td style="font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;">Quantity</td>
            <td style="font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;">Price</td>
            <td style="font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;">Total</td>
        </tr>
        <?php
        $total_apyable = 0;
        if($details){
            foreach ($details as $key => $order) {
                $total_apyable = $total_apyable+($order->quantity*$order->ordered_price);
                ?>
        <tr>
        	<td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;"><?= ($key+1) ?></td>
            <td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;"><?=$order->item_name?></td>
            <td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;"><?=$order->quantity?></td>
            <td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;"><?=$order->ordered_price?></td>
            <td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;"><?=$order->quantity*$order->ordered_price?></td>
        </tr>
        <?php
        if($order->addons){
            foreach ($order->addons as $k => $addons) {
                $total_apyable = $total_apyable+($addons->quantity*$addons->price);
                ?>
                	<tr>
                    	<td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 0 0 30px;"><?=($key+1).'.'.($k+1)?></td>
                    	<td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;"><?=$addons->addon_name?></td>
                        <td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px;"><?=$addons->quantity?></td>
                        <td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px; padding:10px;"><?=$addons->price?></td>
                        <td style="font-weight:normal; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px; padding:10px;"><?=$addons->quantity*$addons->price?></td>
                    </tr>
        <?php
                }
            }
        }
    }
    ?>
    <tr>
        <td colspan="3" style="text-align:right;font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 10px 10px 30px;">Total Order Amount Rs.</td>
        <td colspan="2" style="text-align:right;font-weight:normal; font-size:15px; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 10px 10px 30px;"><?=$total_apyable?></td>
    </tr>
    <?php
    if(!empty($order_coupon)){
        $coupon = $order_coupon[0];
        $total_apyable = $total_apyable-$coupon->discount_amount;
    ?>
    <tr>
        <td colspan="3" style="text-align:right;font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 10px 10px 30px;">Used coupon [ <span><?=$coupon->coupon_code?></span> ]</td>
        <td colspan="2" style="text-align:right;font-weight:normal; font-size:15px; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 10px 10px 30px;">Discount Amount Rs. -<?=round($coupon->discount_amount, 0)?></td>
    </tr>
    <?php
    }
    ?>
    <tr>
        <td colspan="3" style="text-align:right;font-weight:bold; border-right:#ccc solid 1px; padding:10px 10px 10px 30px;">Total Payable Amount Rs.</td>
        <td colspan="2" style="text-align:right;font-weight:normal; font-size:25px; border-right:#ccc solid 1px; padding:10px 10px 10px 30px;"><?=$total_apyable?></td>
    </tr>
    </table>
    
    <!-- <div style="width:400px; float:right; padding-top:30px;">
    	<table cellpadding="0" cellspacing="0" width="400px" style="border:1px solid #ccc; float:right;">
        	<tr>
            	<td style="font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 0 10px 30px;">Total Order Amount Rs.</td>
                <td style="font-weight:normal; font-size:15px; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 0 10px 30px;"><?=$total_apyable?></td>
            </tr>
            <?php
            if(!empty($order_coupon)){
                $coupon = $order_coupon[0];
                $total_apyable = $total_apyable-$coupon->discount_amount;
            ?>
            <tr>
            	<td style="font-weight:bold; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 0 10px 30px;">Used coupon [ <span><?=$coupon->coupon_code?></span> ]</td>
                <td style="font-weight:normal; font-size:15px; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px; padding:10px 0 10px 30px;">Discount Amount Rs. -<?=$coupon->discount_amount?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
            	<td style="font-weight:bold; border-right:#ccc solid 1px; padding:10px 0 10px 30px;">Total Payable Amount Rs.</td>
                <td style="font-weight:normal; font-size:25px; border-right:#ccc solid 1px; padding:10px 0 10px 30px;"><?=$total_apyable?></td>
            </tr>
        </table>
    </div> -->
    
    	<div style="clear:both;"></div>
   </div>

</body>
</html>
