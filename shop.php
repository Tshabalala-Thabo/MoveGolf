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
   <title>Products | MoveGolf</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <?php include 'components/head.php'; ?>


</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section id="banner2">
      <div class="main-container banner2-coontainer">
         <div style="display: grid; align-self: center;">
            <div class="heading-c" style="margin: auto; margin-top: 40px;">
               <h2 class="heading cl-brown">Products</h2>
               <div class="headin-line"></div>
            </div>
         </div>
      </div>
   </section>

   <section class="products">
      <div class="container">
         <div class="row justify-content-center">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                     <a style="text-decoration: none;" href="quick_view.php?pid=<?= $fetch_product['id']; ?>">
                        <div class="product">
                           <form action="" method="post" class="box">
                              <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                              <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                              <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                              <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                              <!--button class="fas fa-heart" type="submit" name="add_to_wishlist"></!--button>
                           <a-- href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a-->
                              <div class="product-image">
                                 <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" width="100%" alt="">
                              </div>
                              <div class="name"><?= $fetch_product['name']; ?></div>
                              <div class="d-flex">
                                 <div class="d-flex">
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
                                       $stars_html .= '<ion-icon name="star" style="margin-top: 4px;"></ion-icon>';
                                    }

                                    // Generate half star if needed
                                    if ($rating - $full_stars >= 0.5) {
                                       $stars_html .= '<ion-icon name="star-half" style="margin-top: 4px;"></ion-icon>';
                                    }

                                    // Generate empty stars to fill up to 5 stars
                                    $empty_stars = 5 - ceil($rating);
                                    for ($i = 0; $i < $empty_stars; $i++) {
                                       $stars_html .= '<ion-icon name="star-outline" style="margin-top: 4px;"></ion-icon>';
                                    }

                                    echo $stars_html;

                                    ?>
                                 </div>
                                 <p style="margin-left: 8px;"> <?= $fetch_product['no_reviews'] ?> reviews</p>
                                 <input type="hidden" name="qty" class="qty" min="1" max="99"
                                    onkeypress="if(this.value.length == 2) return false;" value="1">
                              </div>
                              <!--input type="submit" value="add to cart" class="btn cl-white bttn-primary" name="add_to_cart"-->
                           </form>
                        </div>
                     </a>
                  </div>

                  <?php
               }
            } else {
               echo '<p class="empty">no products found!</p>';
            }
            ?>

         </div>
      </div>

   </section>













   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>