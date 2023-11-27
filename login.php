
<?php

include 'config.php';
session_start();
// using post to submit any data to *$_SESSION* and make sure that system know what it(Account) that use the system
if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <style>
         .form-group{
            background-color: #D3D3D3;
            padding: 10px;
            border-radius: 12px;
         }
      </style>
</head>

<body>
<div class="containerlogin">
            <h1 class="logintitle">
                <b> Welcome Admin</b>
            </h1>
            <div class="linetitle">
            </div>
            <div class="form-group">
                <form action="#" method="post" name="login">
                    <p>Email</p>
                    <input type="text" name="email" placeholder="Email" class="form-control form-control-lg" required /> </br>
                    <p>Password:</p>
                    <input type="password" name="password" placeholder="Password" class="form-control form-control-lg" required /> </br> </br>
                    <!-- <button type="submit" name="submit" value="login">Login</button> -->
                    <input type="submit" name="submit" value="Login" class="btn btn-primary"/>
                    <!-- <a href="register.php">To register</a> -->
                </form>
            </div>
            <button class="btn btn-primary btn-lg disabled"><a href="signlog.php">Customer</a></button>

        </div>
        </body>

</html>