<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if (isset($_GET['delete_all'])) {
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart | MoveGolf</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <?php include 'components/head.php'; ?>

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="products shopping-cart">
      <div class="container">
         <h3 class="cl-white">Shopping cart</h3>

         <div class="row">
            <div class="col-8">
               <div class="row justify-content-center">

                  <?php
                  $grand_total = 0;
                  $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                  $select_cart->execute([$user_id]);
                  if ($select_cart->rowCount() > 0) {
                     while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                        <div class="col-6">
                           <div class="box-container">
                              <form action="" method="post" class="box">
                                 <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                                 <!--a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></!--a-->
                                 <div class="product-image">
                                    <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                                 </div>
                                 <div class="name">
                                    <h4><?= $fetch_cart['name']; ?></h4>
                                 </div>
                                 <div class="flex">
                                    <div class="price">R<?= $fetch_cart['price']; ?></div>
                                    <div class="d-flex">
                                       <p>Quantity</p>
                                       <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                                       <button type="submit" class="fas fa-edit" name="update_qty"></button>
                                    </div>
                                 </div>
                                 <div class="sub-total"> Sub total :<span>R<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> </div>
                                 <input type="submit" value="Remove item" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
                              </form>
                           </div>
                        </div>
                  <?php
                        $grand_total += $sub_total;
                     }
                  } else {
                     echo '<p class="empty">your cart is empty</p>';
                  }
                  ?>
               </div>
            </div>

            <div class="col-4">
               <div class="cart-total">
                  <p>Grand Total : <span>R<?= $grand_total; ?></span></p>
                  <a href="checkout.php" class="btn bttn-primary <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to checkout</a>
                  <a href="shop.php" class="option-btn">Continue shopping</a>
                  <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">Remove all items</a>

               </div>
            </div>
         </div>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>