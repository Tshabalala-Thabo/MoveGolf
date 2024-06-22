<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home | MoveGolf</title>

   

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <?php include 'components/head.php';?>

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section id="banner">
            <div class="banner-coontainer">
                <div class="container">
                    <div style="display: grid; align-items: center; height: 100%;">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6">

                            </div>
                            <div class="col-12 col-md-6">
                                <div class="heading-c">
                                    <h2 class="heading cl-brown">Move your golf experience to the next level</h2>
                                    <div class="headin-line"></div>
                                </div>
                                <p class="cl-white">Random paragraph with a bunch of words to fill up the space you’re
                                    busy
                                    looking at now. It will be replaced with a more useful paragraph soon but for now,
                                    we
                                    will stick to this for demonstration purposes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="services">
            <div class="heading-c">
                <h2 class="heading cl-brown">What do we do?</h2>
                <div class="headin-line"></div>
            </div>
            <div class="container" style="margin-top: 32px;">
                <div class="row justify-content-center" style="row-gap: 24px;">
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="service">
                            <ion-icon class="service-icon" name="golf-outline"></ion-icon>
                            <h6 class="sercice-heading">VIRTUAL GOLF PLAY</h6>
                            <p>Offering virtual golf play on various famous courses around the world. Players can
                                experience realistic gameplay without leaving the facility.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="service">
                            <ion-icon class="service-icon" name="pricetags-outline"></ion-icon>
                            <h6 class="sercice-heading">Golf Simulator Rentals</h6>
                            <p>Renting out individual golf simulators for use by individuals or groups. This could be
                                charged hourly or for a set period.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="service">
                            <ion-icon class="service-icon" name="cart-outline"></ion-icon>
                            <h6 class="sercice-heading">Golf Simulator Products</h6>
                            <p>Providing golf-related merchandise such as clubs, apparel, accessories, and equipment
                                within the facility.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="service">
                            <ion-icon class="service-icon" name="diamond-outline"></ion-icon>
                            <h6 class="sercice-heading">Membership Packages</h6>
                            <p>Offering membership packages that provide discounted rates for regular visitors and
                                access to exclusive events or services.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mission">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 mission-inner">
                        <div class="m-container">
                            <div class="left"></div>
                            <div class="right">
                                <div class="content">
                                    <div class="heading-c">
                                        <h2 class="heading cl-brown">Our mission</h2>
                                        <div class="headin-line"></div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia assumenda dolore
                                        reprehenderit ullam blanditiis ex sapiente pariatur tempore incidunt facilis?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>
</body>

</html>