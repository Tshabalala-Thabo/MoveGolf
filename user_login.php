<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

if (isset($_POST['submit'])) {

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if ($select_user->rowCount() > 0) {
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   } else {
      $message[] = 'incorrect username or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | MoveGolf</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <?php include 'components/head.php'; ?>

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="form-container">

      <div class="form-container-inner" style="">
         <div class="container">
            <div class="row  justify-content-center">
               <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                  <form action="" method="post">
                     <h3>Login</h3>
                     <input type="email" name="email" required placeholder="Enter your email" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                     <input type="password" name="pass" required placeholder="Enter your password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                     <input type="submit" value="login" class="btn btn-login" name="submit">
                     <p>Don't have an account? <a href="user_register.php">Register</a></p>

                  </form>
               </div>
            </div>
         </div>
      </div>

   </section>



   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>