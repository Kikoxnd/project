<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:signlog.php');
}
// echo 'the user id is $user_id:';
// echo $user_id;

if (isset($_POST['submit_rate'])) {
   $product_id = $_POST['product_name'];
   $product_rate = $_POST['product_rate'];
   // echo $product_id;
   // echo $product_rate;
   mysqli_query($conn, "UPDATE `history` SET product_rate = '$product_rate' WHERE product_name = '$product_id'") or die('query failed');
   $message[] = 'rating submitted';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>history</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
   <!-- Header -->
   <?php include 'header.php'; ?>

   <!-- heading -->
   <div class="heading">
      <h3>our shop</h3>
      <p> <a href="home.php">Home</a> / History </p>
   </div>

   <!-- Main Body -->
   <section class="products">
      <h1 class="title">History purchase</h1>
      <div class="box-container">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `history` WHERE user_id = '$user_id'") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <form action="" method="post" class="box">
                  <!-- <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="Prodcut_image"> -->
                  <div class="name">
                     Product name:
                     <?php echo $fetch_products['product_name']; ?>
                  </div>
                  <div class="name">Order Id:
                  <?php echo $fetch_products['order_id']; ?>
                  </div>
                  <select name="product_rate" class="form-control form-control-lg">
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5" selected>5</option>
                  </select>
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['product_name']; ?>">
                  <input type="submit" class="btn btn-primary btn-lg" value="Submit rating" name="submit_rate" class="btn">
                  <!-- <input type="submit" value="view details" name="view_details" class="btn"> -->
                  &nbsp
                  <!-- <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal"
                     data-target="#myModal<?php echo $fetch_products['id'] ?>">View</button> -->


               </form>
               <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

   </section>

   <!-- Footer -->
   <?php include 'footer.php'; ?>
   <!-- JS -->
   <script src="js/script.js"></script>

</body>

</html>

<!-- ytrfggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>History</title>

   <!-- CSS styles -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <style>
      .box-cont {
         border: 2px red solid;
         max-width: 1200px;
         margin: 0 auto;
         display: grid;
         grid-template-columns: repeat(auto-fit, 30rem);
         align-items: flex-start;
         gap: 1.5rem;
         justify-content: center;
      }

      .rating {
         display: flex;
         justify-content: flex-start;
         align-items: center;
      }

      .rating input[type="radio"] {
         display: none;
      }

      .rating label {
         font-size: 2rem;
         color: #ccc;
         cursor: pointer;
         margin-right: 5px;
      }

      .rating label:hover,
      .rating label:hover ~ label,
      .rating input[type="radio"]:checked ~ label {
         color: orange;
      }
   </style>
</head>
<body>
   <!-- Header -->
   <?php include 'header.php'; ?>

   <!-- Heading -->
   <div class="heading">
      <h3>Our Shop</h3>
      <p><a href="home.php">Home</a> / History</p>
   </div>

   <section class="products">
      <h1 class="title">History Purchase</h1>
      <?php
      if (mysqli_num_rows($select_order_ids) > 0) {
         while ($order_row = mysqli_fetch_assoc($select_order_ids)) {
            ?>
            <div class="box-cont">
            <?php
            $order_id = $order_row['order_id'];

            echo "<h2>Order ID: $order_id</h2>";
            $select_products = mysqli_query($conn, "SELECT * FROM `history` WHERE user_id = '$user_id' AND order_id = '$order_id'") or die('query failed');

            if (mysqli_num_rows($select_products) > 0) {
               while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                  ?>
                  <form action="" method="post" class="box">
                     <div class="name">
                        Product name: <?php echo $fetch_products['product_name']; ?>
                     </div>
                     <div class="name">Order ID: <?php echo $fetch_products['order_id']; ?></div>
                     <div class="rating">
                        <input type="radio" name="product_rate" id="star5-<?php echo $fetch_products['id']; ?>" value="5" <?php if ($fetch_products['product_rate'] == 5) echo 'checked'; ?>>
                        <label for="star5-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                        <input type="radio" name="product_rate" id="star4-<?php echo $fetch_products['id']; ?>" value="4" <?php if ($fetch_products['product_rate'] == 4) echo 'checked'; ?>>
                        <label for="star4-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                        <input type="radio" name="product_rate" id="star3-<?php echo $fetch_products['id']; ?>" value="3" <?php if ($fetch_products['product_rate'] == 3) echo 'checked'; ?>>
                        <label for="star3-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                        <input type="radio" name="product_rate" id="star2-<?php echo $fetch_products['id']; ?>" value="2" <?php if ($fetch_products['product_rate'] == 2) echo 'checked'; ?>>
                        <label for="star2-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                        <input type="radio" name="product_rate" id="star1-<?php echo $fetch_products['id']; ?>" value="1" <?php if ($fetch_products['product_rate'] == 1) echo 'checked'; ?>>
                        <label for="star1-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                     </div>
                     <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                     <input type="hidden" name="product_name" value="<?php echo $fetch_products['product_name']; ?>">
                     <input type="submit" class="btn btn-primary btn-lg" value="Submit Rating" name="submit_rate">
                  </form>
                  <?php
               }
               ?><br><?php
            } else {
               echo '<p class="empty">No products added yet for this order ID!</p>';
            }
            ?>
            </div>
            <br>
            <?php
         }
      } else {
         echo '<p class="empty">No orders found!</p>';
      }
      ?>
   </section>

   <!-- Footer -->
   <?php include 'footer.php'; ?>

   <!-- JS scripts -->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
