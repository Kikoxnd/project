<?php
// connect to database mysqladmin
include 'config.php';
session_start();
//Making sure the id(customer acc) is used in this case
$user_id = $_SESSION['user_id'];

if (isset($_POST['save_changes'])) {
	// Variable declaration
	$name = mysqli_real_escape_string($conn, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
	$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $pnum = $_POST['phone'];
   if($pass == $cpass){

      $select_users = mysqli_query($conn, "UPDATE `users` SET name = '$name',email = '$email' ,password = '$pass', pnumber = '$pnum' WHERE id='$user_id' ") or die('register not success');
      $message[] = 'Profile has been updated!';
   }else{
      $message[] = 'Password does not match';
   }
	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ProfileUser</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/newprofile.css">

   <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <script src="/bootstrap/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <style>
      .container {
         max-width: 500px;
         margin: 20px auto;
         padding: 20px;
         background-color: #f5f5f5;
         border-radius: 5px;
      }

      h2 {
         text-align: center;
         margin-bottom: 20px;
      }

      .form-group {
         margin-bottom: 15px;
      }

      label {
         display: block;
         font-weight: bold;
         margin-bottom: 5px;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"],
      input[type="tel"] {
         width: 100%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 3px;
         font-size: 16px;
      }

      button[type="submit"] {
         display: block;
         width: 100%;
         padding: 10px;
         background-color: #4CAF50;
         color: #fff;
         border: none;
         border-radius: 3px;
         font-size: 16px;
         cursor: pointer;
      }

      button[type="submit"]:hover {
         background-color: #45a049;
      }
   </style>

</head>
<?php include 'header.php'; ?>


<?php
$get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id' ");
$fetch_user = mysqli_fetch_assoc($get_user);

?>

<body>
   <div class="container">
      <h2>Manage Profile</h2>
      <form action="" method="POST">
         <div class="form-group">
            <h3 for="username">Username</h3>
            <input type="text" id="username" name="username" value="<?php echo $fetch_user['name']?>" >
         </div>
         <div class="form-group">
            <h3 for="email">Email</h3>
            <input type="email" id="email" name="email" value="<?php echo $fetch_user['email']?>" required>
         </div>
         <div class="form-group">
            <h3 for="password">Password</label>
               <input type="password" id="password" name="password" value="" required>
         </div>
         <div class="form-group">
            <h3 for="password">Confirm Password</label>
               <input type="password" id="password" name="cpassword" value="" required>
         </div>
         <div class="form-group">
            <h3 for="phone">Phone Number[+60]</h3>
            <input type="tel" id="phone" name="phone" value="<?php echo $fetch_user['pnumber'] ?>" required>
         </div>
         <button type="submit" name="save_changes">Save Changes</button>
      </form>
   </div>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>

</html>