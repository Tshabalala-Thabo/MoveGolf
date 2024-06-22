<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About | MoveGolf</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <?php include 'components/head.php'; ?>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section id="contacts-banner">
            <div class="contacts-banner-inner">
                <div class="container">
                    <div class="heading-c" style="margin: auto;">
                        <h2 class="heading cl-white">About us</h2>
                        <div class="headin-line"></div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <p style="color: #fffefe;
                            margin-top: 16px; text-align: center;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci
                                    consectetur corporis ipsam repellendus, cum ad doloremque rem reprehenderit rerum
                                    hic nesciunt magnam quidem dolorum aliquam. Accusantium fugit odit mollitia
                                    provident!</p>

                                    <p style="color: #fffefe;
                            margin-top: 16px; text-align: center;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci
                                    consectetur corporis ipsam repellendus, cum ad doloremque rem reprehenderit rerum
                                    hic nesciunt magnam quidem dolorum aliquam. Accusantium fugit odit mollitia
                                    provident!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>
       
        <section id="about-us">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 mission-inner">
                        <div class="m-container">
                            <div class="left-abt"></div>
                            <div class="right">
                                <div class="content">
                                    <div class="heading-c">
                                        <h2 class="heading cl-brown">Vision</h2>
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

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>