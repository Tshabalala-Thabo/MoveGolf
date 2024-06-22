<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

if (isset($_POST['send'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if ($select_message->rowCount() > 0) {
      $message[] = 'already sent message!';
   } else {

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';
   }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact us | MoveGolf</title>

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
               <h2 class="heading cl-white">Contact us</h2>
               <div class="headin-line"></div>
            </div>
         </div>
      </div>

      <div class="c-box">
         <div class="c-container container">
            <div class="contactInfo">
               <div>
                  <h2 class="contactInfo-heading">Contact info</h2>
                  <div>
                     <ul class="info">
                        <li>
                           <ion-icon class="contact-icon" name="mail-outline"></ion-icon>
                           <div class="contactInfo-text">
                              <p>info@movegolf.com</p>
                              <p>Email</p>
                           </div>
                        </li>
                        <li>
                           <ion-icon class="contact-icon" name="call-outline"></ion-icon>
                           <div class="contactInfo-text">
                              <p>071 234 4567</p>
                              <p>Phone</p>
                           </div>
                        </li>
                        <li>
                           <ion-icon class="contact-icon" name="location-outline"></ion-icon>
                           <div class="contactInfo-text">
                              <p>street name, town, city</p>
                              <p>Office</p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <ul class="sci">
                  <li> <ion-icon class="sci-icon" name="logo-facebook"></ion-icon>
                  </li>
                  <li> <ion-icon class="sci-icon" name="logo-instagram"></ion-icon>
                  </li>
                  <li> <ion-icon class="sci-icon" name="logo-youtube"></ion-icon>
                  </li>
               </ul>
            </div>
            <div class="contactForm">
               <h2 class="contactInfo-heading" style="margin-bottom: 24px;">Send us a message</h2>
               <form class="formBox" method="post">
                  <div class="inputBox w50">
                  <input type="text" name="name" required maxlength="20" class="box">
                     <span>First Name</span>
                  </div>
                  <div class="inputBox w50">
                     <input type="text" required>
                     <span>Last Name</span>
                  </div>
                  <div class="inputBox w50">
                  <input type="email" name="email" required maxlength="50" class="box">
                     <span>Email Address</span>
                  </div>
                  <div class="inputBox w50">
                  <input type="number" name="number" min="0" max="9999999999" required onkeypress="if(this.value.length == 10) return false;" class="box">
                     <span>Mobile Number</span>
                  </div>
                  <div class="inputBox w100">
                     <!--textarea type="text" required></!--textarea-->
                     <textarea name="msg" type="text" required></textarea>
                     <span>Write your message here...</span>
                  </div>
                  <div class="inputBox w100">
                     <input class="submit-b" name="send" type="submit" value="Send" required></input>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   <section id="c-box">

   </section>

   <section class="contact">

      <!--form action="" method="post">
         <h3>Get in touch.</h3>
         <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
         <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
         <input type="number" name="number" min="0" max="9999999999" placeholder="enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
         <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
      </!--form-->

   </section>













   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>