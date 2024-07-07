<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quick view | MoveGolf</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <?php include 'components/head.php'; ?>

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="quick-view">

      <div class="container">
         <h1 class="cl-white">Quick view</h1>

         <?php
         $pid = $_GET['pid'];
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
         $select_products->execute([$pid]);
         if ($select_products->rowCount() > 0) {
            while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                  <div class="row">
                     <div class="image-container col-12 col-lg-7">
                        <div class="main-image">
                           <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                        </div>
                        <div class="sub-image">
                           <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                           <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
                           <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
                        </div>
                     </div>
                     <div class="content col-12 col-lg-5">
                        <div class="name">
                           <h2><?= $fetch_product['name']; ?></h2>
                        </div>
                        <div class="d-flex" style="align-self: center;">
                           <?php

                           $stars_html = '';
                           $rating = $fetch_product['stars'];

                           // Validate rating value to be between 0 and 5
                           $rating = floatval($rating);
                           if ($rating < 0) {
                              $rating = 0;
                           } elseif ($rating > 5) {
                              $rating = 5;
                           }

                           // Round to the nearest half-star
                           $rating = round($rating * 2) / 2;

                           // Generate full stars
                           $full_stars = floor($rating);
                           for ($i = 0; $i < $full_stars; $i++) {
                              $stars_html .= '<ion-icon class="yellow-stars" name="star" style="margin-top: 4px;"></ion-icon>';
                           }

                           // Generate half star if needed
                           if ($rating - $full_stars >= 0.5) {
                              $stars_html .= '<ion-icon class="yellow-stars" name="star-half" style="margin-top: 4px;"></ion-icon>';
                           }

                           // Generate empty stars to fill up to 5 stars
                           $empty_stars = 5 - ceil($rating);
                           for ($i = 0; $i < $empty_stars; $i++) {
                              $stars_html .= '<ion-icon class="yellow-stars" name="star-outline" style="margin-top: 4px;"></ion-icon>';
                           }

                           echo $stars_html;

                           ?>
                           <p style="margin-left: 8px;"> <?= $fetch_product['no_reviews'] ?> reviews</p>
                        </div>
                        <div class="details"><?= $fetch_product['details']; ?></div>
                        <div class="flex">
                           <div class="price">
                              <p><span>R</span><?= $fetch_product['price']; ?><span></span></p>
                           </div>
                           <div class="flex">
                              <p>Quantity</p>
                              <input type="number" name="qty" class="qty" min="1" max="99"
                                 onkeypress="if(this.value.length == 2) return false;" value="1">
                           </div>
                        </div>

                        <div class="flex-btn">
                           <input type="submit" value="Add to cart" class="bttn-primary add-to-cart" name="add_to_cart">
                           <!--input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist"-->
                        </div>
                     </div>
                  </div>
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>