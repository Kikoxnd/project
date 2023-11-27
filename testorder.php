<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:signlog.php');
}

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
   $fetch_quantcart = mysqli_fetch_assoc($check_cart_numbers);
   $compare_quant = mysqli_query($conn, "SELECT * FROM testproduct WHERE name='$product_name'");
   $fetch_quantitem = mysqli_fetch_assoc($compare_quant);

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart!';
   } else {
      //This is to compare if the item in the database is zero or not
      // $comapre_quant = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'");
      if ($fetch_quantitem['quant'] == 0) {
         $message[] = 'Product out of order';
      } else {
         mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
         $message[] = 'product added to cart!';
      }
   }
   // .................................
   // $spec_quant = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   // if (mysqli_num_rows($spec_quant) > 0) {
   //    while ($fetch_quant = mysqli_fetch_assoc($spec_quant)) {
   //       $newiditem = $fetch_quant['name'];
   //       // $newquant=0;
   //       $newquant = $fetch_quant['quantity'];
   //       // mysqli_query($conn, "SELECT quantity FROM cart WHERE user_id='$user_id'");
   //       mysqli_query($conn, "UPDATE testproduct SET quant = quant- $newquant WHERE name= '$newiditem' ");
   //    }
   // }
   // ..................................
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>testorder</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>our shop</h3>
      <p> <a href="home.php">Home</a> / Shop </p>
   </div>

   <section class="products">

      <h1 class="title">latest products</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `testproduct`") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="name">
                     <?php echo $fetch_products['name']; ?>
                  </div>
                  <div class="price">RM
                     <?php echo $fetch_products['price']; ?>/-
                  </div>
                  <div class="quant">Quant:
                     <?php echo $fetch_products['quant']; ?>
                  </div>
                  <?php $maxquantitem = $fetch_products['quant']; ?>
                  <input type="number" min="1" max="<?php $maxquantitem ?>" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn">
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

   </section>








   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>