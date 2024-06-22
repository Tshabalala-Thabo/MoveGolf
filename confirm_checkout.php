<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

//secutity measures: signature

/**
 * @param array $data
 * @param null $passPhrase
 * @return string
 */
function generateSignature($data, $passPhrase = null)
{
   // Create parameter string
   $pfOutput = '';
   foreach ($data as $key => $val) {
      if ($val !== '') {
         $pfOutput .= $key . '=' . urlencode(trim($val)) . '&';
      }
   }
   // Remove last ampersand
   $getString = substr($pfOutput, 0, -1);
   if ($passPhrase !== null) {
      $getString .= '&passphrase=' . urlencode(trim($passPhrase));
   }
   return md5($getString);
}

//retreive email
 $check = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$check->execute([$user_id]);
$email = "email@email.com";
$fname = 'Firstname';
$lname = "lastname";
if ($check->rowCount() > 0) {
    $row = $check->fetch(PDO::FETCH_ASSOC);
    $email = $row['email'];
    $fname = $row['name'];
    $lname = $row['lastname'];
}
// Construct variables
$cartTotal = $_SESSION['c_total_price']; // This amount needs to be sourced from your application
$passphrase = 'jt7NOE43FZPn';
$data = array(
   // Merchant details
   'merchant_id' => '24421277',
   'merchant_key' => 'q4sktwdbadx9p',
   'return_url' => 'https://www.movegolf.co.za/return.php',
   'cancel_url' => 'https://www.movegolf.co.za/paymentcanceled.php',
   'notify_url' => 'https://www.movegolf.co.za/notify.php',
   // Buyer details
   'name_first' => $fname,
   'name_last'  => $lname,
   'email_address' => $email,
   // Transaction details
   'm_payment_id' => $user_id, //Unique payment ID to pass through to notify_url
   'amount' => number_format(sprintf('%.2f',  $cartTotal), 2, '.', ''),
   'item_name' => $_SESSION['c_total_products'] 
);

$signature = generateSignature($data, $passphrase);
//$signature = generateSignature($data);
$data['signature'] = $signature;

// If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
$testingMode = false;
$pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
$htmlForm = '<form action="https://' . $pfHost . '/eng/process" method="post">';
foreach ($data as $name => $value) {
   $htmlForm .= '<input name="' . $name . '" type="hidden" value=\'' . $value . '\' />';
}
$htmlForm .= '<input type="submit" value="Pay Now" /></form>';
//$htmlForm .= ' <input type="image" src="https://my.payfast.io/images/buttons/PayNow/Primary-Large-PayNow.png" alt="Pay Now" title="Pay Now with Payfast"></form>';


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout | MoveGolf</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <?php include 'components/head.php'; ?>

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="checkout-orders">

      <div class="container">
         <h2 class="cl-white">Confirm checkout</h2>
         <div>
            <!--form name="PayFastPayNowForm" action="https://sandbox.payfast.co.za​/eng/process" method="post"-->
            <div style="background-color: #fffefe; padding: 24px; border-radius: 8px;">
               <!--input type="hidden" name="merchant_id" value="10000100">
               <input type="hidden" name="merchant_key" value="46f0cd694581a">
               <!-input type="hidden" name="return_url" value="https://movegolf.co.za/confirm_checkout.php"->
               <input type="hidden" name="return_url" value="http://localhost/projectdone/return.php">
               <input type="hidden" name="cancel_url" value="http://localhost/paymentcanceled.php">
               <input type="hidden" name="notify_url" value="http://localhost/projectdone/notify.php"-->
               <table>
                  <tr>
                     <td><label id="PayFastAmountLabel" for="PayFastAmount">Amount :R<?php echo $_SESSION['c_total_price'] ?></label></td>
                     <td><input required id="PayFastAmount" type="hidden" step=".01" name="amount" min="5.00" placeholder="<?php echo $_SESSION['c_total_price'] ?>" value="<?php echo $_SESSION['c_total_price'] ?>"></td>
                  </tr>
               </table>

               <input required type="hidden" name="item_name" maxlength="255" value="<?php echo $_SESSION['c_total_products'] ?>">
               <table>
                  <tr>
                     <td colspan="2"><span style="font-weight: bold;">Shipping Address</span></td>
                  </tr>
                  <tr>
                     <td><span style="color:red;">*</span>&nbsp;Line 1 :</td>
                     <td><input type="text" disabled name="line1" class="shipping" value="<?php echo $_SESSION['c_line1']; ?>"></td>
                  </tr>
                  <!-tr>
                     <td>Line 2</td>
                     <td><input type="text" name="line2" class="shipping" value="<?php echo $_SESSION['c_line2']; ?>"></td>
                  </!--tr->
                  <tr>
                     <td><span style="color:red;">*</span>&nbsp;City :</td>
                     <td><input type="text" class="shipping" disabled name="city" value="<?php echo $_SESSION['c_city']; ?>"></td>
                  </tr>
                  <tr>
                     <td><span style="color:red;">*</span>&nbsp;Province :</td>
                     <td><input type="text" disabled class="shipping" name="region" value="<?php echo $_SESSION['state']; ?>"></td>
                  </tr>
                  <tr>
                     <td><span style="color:red;">*</span>&nbsp;Country :</td>
                     <td>
                        <select disabled name="country" class="shipping">
                           <option value="<?php echo $_SESSION['c_country']; ?>" selected="selected"><?php echo $_SESSION['c_country']; ?></option>
                           <option value="South Africa">South Africa</option>
                           <option value="">------------------------</option>
                           <option value="Botswana">Botswana</option>
                           <option value="Lesotho">Lesotho</option>
                           <option value="Mauritius">Mauritius</option>
                           <option value="Mozambique">Mozambique</option>
                           <option value="Swaziland">Swaziland</option>
                           <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td><span style="color:red;">*</span>&nbsp;Postal Code :</td>
                     <td><input type="number" disabled name="code" class="shipping" value="<?php echo $_SESSION['c_code']; ?>"></td>
                  </tr>
               </table>
               <table>
                  <tr>
                     <td colspan=2 align=center>
                        <!--input type="image" src="https://my.payfast.io/images/buttons/PayNow/Primary-Large-PayNow.png" alt="Pay Now" title="Pay Now with Payfast"-->
                        <?php echo $htmlForm;?>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>

   </section>













   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>