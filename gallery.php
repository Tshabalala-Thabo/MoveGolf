<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders | MoveGolf</title>

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
            <div class="heading-c" style="margin: auto;">
               <h2 class="heading cl-brown">Gallery</h2>
               <div class="headin-line"></div>
            </div>
         </div>
      </div>
   </section>
   <section id="gallery">
      <div class="container">
         <!--div style="display: flex; justify-content: center;">
                    <div class="heading-c">
                        <h2 class="heading cl-white">All procucts</h2>
                        <div class="headin-line"></div>
                    </div>
                </!--div-->


         <h3 style="color: #fffefe;">Album 1</h3>
         <div class="row justify-content-center" style="row-gap: 24px;">
            <div class="col-6 col-lg-3">
               <img src="./images/field 3.webp" width="100%" alt="">
            </div>
            <div class="col-6 col-lg-3">
               <img src="./images/Field 1.webp" width="100%" alt="">
            </div>
            <div class="col-12 col-lg-6">
               <img src="./images/golfer-hit-sweeping-driver-after-600nw-2273318515.webp" width="100%" alt="">
            </div>

            <div class="col-12 col-lg-9">
               <img src="./images/banner2.jpg" width="100%" alt="">
            </div>

            <div class="col-6 col-lg-3">
               <img src="./images/field 8.webp" width="100%" alt="">
            </div>
         </div>

         <br><br>

         <h3 style="color: #fffefe;">Album 2</h3>
         <div class="row justify-content-center" style="row-gap: 24px;">
            <div class="col-6 col-lg-3">
               <img src="./images/field 3.webp" width="100%" alt="">
            </div>
            <div class="col-6 col-lg-3">
               <img src="./images/Field 1.webp" width="100%" alt="">
            </div>
            <div class="col-12 col-lg-6">
               <img src="./images/golfer-hit-sweeping-driver-after-600nw-2273318515.webp" width="100%" alt="">
            </div>

            <div class="col-12 col-lg-9">
               <img src="./images/banner2.jpg" width="100%" alt="">
            </div>

            <div class="col-6 col-lg-3">
               <img src="./images/field 8.webp" width="100%" alt="">
            </div>
         </div>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>