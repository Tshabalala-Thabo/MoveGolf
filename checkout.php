<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

if (isset($_POST['order'])) { //then save the data into session variables

   $name = $_POST['name'];
   $_SESSION['c_name'] = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $_SESSION['c_number'] = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $_SESSION['c_email'] = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $_SESSION['c_method'] = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];

   $_SESSION['c_line1'] =  $_POST['flat'];
   $_SESSION['c_line2'] = $_POST['street'];
   $_SESSION['c_city'] =  $_POST['city'];
   $_SESSION['state'] =  $_POST['state'];
   $_SESSION['c_country'] =  $_POST['country'];
   $_SESSION['c_code'] =  $_POST['pin_code'];

   $_SESSION['c_address'] = filter_var($address, FILTER_SANITIZE_STRING);
   $_SESSION['c_total_products'] = $_POST['total_products'];
   $_SESSION['c_total_price'] = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {

      //$insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      //$insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      //$delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      //$delete_cart->execute([$user_id]);

      //$message[] = 'order placed successfully!';
      header("location:confirm_checkout.php");
   } else {
      $message[] = 'your cart is empty';
   }
}

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
         <form action="" method="POST">

            <h3>Order item(s)</h3>

            <div class="display-orders">
               <?php
               $grand_total = 0;
               $cart_items[] = '';
               $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
               $select_cart->execute([$user_id]);
               if ($select_cart->rowCount() > 0) {
                  while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                     $cart_items[] = $fetch_cart['name'] . ' (R' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                     $total_products = implode($cart_items);
                     $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
               ?>
                     <p> <?= $fetch_cart['name']; ?> <span>(<?= 'R' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
               <?php
                  }
               } else {
                  echo '<p class="empty">your cart is empty!</p>';
               }
               ?>
               <input type="hidden" name="total_products" value="<?= $total_products; ?>">
               <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
               <div class="grand-total">Grand Total :<span>R<?= $grand_total; ?></span></div>
            </div>

            <h3>Shipping address</h3>

            <div class="row">
               <div class="inputBox col-6">
                  <span>Name</span>
                  <input type="text" name="name" placeholder="Name" class="box" maxlength="20" required>
               </div>
               <div class="inputBox col-6">
                  <span>Phone number :</span>
                  <input type="number" name="number" placeholder="Phone number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
               </div>
               <div class="inputBox col-6">
                  <span>Email </span>
                  <input type="email" name="email" placeholder="Email" class="box" maxlength="50" required>
               </div>
               <div class="inputBox col-6">
                  <span>Payment method</span>
                  <select name="method" class="box" required>
                     <option value="cash on delivery">Online payment</option>
                  </select>
               </div>
               <div class="inputBox col-6">
                  <span>Address line 1</span>
                  <input type="text" name="flat" placeholder="e.g. Flat number" class="box" maxlength="50" required>
               </div>
               <div class="inputBox col-6">
                  <span>Address line 2</span>
                  <input type="text" name="street" placeholder="Street name" class="box" maxlength="50" required>
               </div>
               <div class="inputBox col-6">
                  <span>City</span>
                  <input type="text" name="city" placeholder="City" class="box" maxlength="50" required>
               </div>
               <div class="inputBox col-6">
                  <span>Province</span>
                  <input type="text" name="state" placeholder="Province" class="box" maxlength="50" required>
               </div>
               <div class="inputBox col-6">
                  <span>Country</span>
                  <input type="text" name="country" placeholder="Country" value="South Africa" class="box" maxlength="50" required>
               </div>
               <div class="inputBox col-6">
                  <span>Zip code</span>
                  <input type="number" min="0" name="pin_code" placeholder="Zip code" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
               </div>
            </div>

            <input type="submit" name="order" class="btn bttn-primary <?= ($grand_total > 1) ? '' : 'disabled'; ?>" value="Proceed">

         </form>
      </div>

   </section>
   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>