<?php
//echo '<pre>';print_r($user);
// Merchant key here as provided by Payu
$MERCHANT_KEY = "qevrXG53";

// Merchant Salt as provided by Payu
$SALT = "yn5Q1rM9Kr";

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";
$PAYU_BASE_URL = "https://secure.payu.in/_payment";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
  $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';  
  foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Cinecafes">
    <meta charset="UTF-8">
    <meta name="description" content="Cinecafes">
    <meta name="keywords" content="Cinecafes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinecafes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
<style>
input[type="submit"] {
      border: 2px solid orange;
      background: orange;
      color: #fff;
      padding: 15px 25px;
      font-size: 30px;
      font-weight: 300;
  }

@media screen and (max-width: 767px) {
  span.tm-text-odd {
    font-size: 18px;
}
}
@media screen and (max-width: 480px) {
  span.tm-text-odd {
    font-size: 14px;
}
}
</style>
</head>
  <body onload="submitPayuForm()" style="background:#000; font-size:30px">
      <div class="container">
        <div class="row" style="border:1px solid orange; margin:40px 5px 0;  padding: 25px 0px 25px 0">
            <div class="col-4" style="margin-bottom: 10px;color: #fff;">
                <span class="tm-text-odd">Name :</span>
            </div>
            <div class="col-8" style="margin-bottom: 10px; color: #fff;">
                <span class="tm-text-odd"><?php echo (empty($user)) ? '' : $user->name; ?> <?php echo (empty($user)) ? '' : $user->last_name; ?></span>
            </div>

            <div class="col-4" style="margin-bottom: 10px;color: #fff;">
                <span class="tm-text-odd">Email :</span>
            </div>
            <div class="col-8" style="margin-bottom: 10px;color: #fff;">
                <span class="tm-text-odd"><?php echo (empty($user)) ? '' : $user->email; ?></span>
            </div>

            <div class="col-4" style="margin-bottom: 10px;color: #fff;">
                <span class="tm-text-odd">Phone :</span>
            </div>
            <div class="col-8" style="margin-bottom: 10px;color: #fff;">
                <span class="tm-text-odd"><?php echo (empty($user)) ? '' : $user->mobile; ?></span>
            </div>

            <div class="col-4" style="margin-bottom: 10px;color: #fff;">
                <span class="tm-text-odd">Amount :</span>
            </div>
            <div class="col-8" style="margin-bottom: 10px;color: #fff;">
                <span class="tm-text-odd"><?php echo (empty($user)) ? 0.00 : number_format($amount,2); ?></span>
            </div>
            
        </div>
          <div class="col-sm-12">
                <?php if($formError) { ?>  
              <span style="color:red">Please fill all mandatory fields.</span>
              <br/>
              <br/>
            <?php } ?>
            <form action="<?php echo $action; ?>" method="post" name="payuForm">
              <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
              <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
              <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
              <table style="margin: 0 auto">

                <tr>
                  <td></td>
                  <td><input type="hidden" name="amount" value="<?php echo $amount ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="firstname" id="firstname" value="<?php echo (empty($user)) ? '' : $user->name; ?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="hidden" name="email" id="email" value="<?php echo (empty($user)) ? '' : $user->email; ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="phone" value="<?php echo (empty($user)) ? '' : $user->mobile; ?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan="3"><textarea name="productinfo" style="display:none;"><?php echo (empty($user)) ? '' : $user->user_id; ?></textarea></td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan="3"><input type="hidden" name="surl" value="<?=base_url('api/testPayuPaymentSuccess')?>" size="64" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan="3"><input type="hidden" name="furl" value="<?=base_url('api/testPayuPaymentFailure')?>" size="64" /></td>
                </tr>

                <tr>
                  <td colspan="3"><input type="hidden" type="hidden" name="service_provider" value="" size="64" /></td>
                </tr>


                <tr>
                  <td></td>
                  <td><input type="hidden" name="lastname" id="lastname" value="<?php echo (empty($user)) ? '' : $user->last_name; ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="curl" value="<?=base_url('api/testPayuPaymentFailure')?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="hidden" name="address1" value="<?php echo (empty($user)) ? '' : $user->address; ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="address2" value="<?php echo (empty($user)) ? '' : $user->address; ?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="hidden" name="city" value="<?php echo (empty($user)) ? '' : $user->address; ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="state" value="<?php echo (empty($user)) ? '' : $user->address; ?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="hidden" name="country" value="<?php echo (empty($user)) ? '' : $user->address; ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="zipcode" value="<?php echo (empty($user)) ? '' : $user->address; ?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="hidden" name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="hidden" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
                  <td></td>
                  <td><input type="hidden" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
                </tr>
                <tr>
                  <?php if(!$hash) { ?>
                    <td colspan="4" style="text-align:center;"><input type="submit" value="Pay Now" /></td>
                  <?php } ?>
                </tr>
              </table>
            </form>
            </div>
      </div>    
    <br/>    
  </body>
</html>