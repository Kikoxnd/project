<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:signlog.php');
   exit(); // Stop executing further code
}

if (isset($_POST['submit_rate'])) {
   $product_id = $_POST['product_id'];
   $product_rate = $_POST['product_rate'];

   mysqli_query($conn, "UPDATE `history` SET product_rate = '$product_rate' WHERE id = '$product_id'") or die('query failed');
   $message[] = 'Rating submitted';
}

// Retrieve distinct order_ids from the database
$select_order_ids = mysqli_query($conn, "SELECT DISTINCT order_id FROM `history` WHERE user_id = '$user_id'") or die('query failed');

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Your head code here -->
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>history</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <style>
      .material-symbols-outlined {
         font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 20
      }
    
      .box-cont {
          border: 2px grey solid;
         max-width: 450px;
         margin: 0 auto;
         display: grid;
         grid-template-columns: repeat(auto-fit, 30rem);
         align-items: flex-start;
         gap: 1.5rem;
         justify-content: center;       
     
      }

      /* .products {
   display: flex;
   flex-wrap: wrap;
   justify-content: flex-start;
   align-items: flex-start;
   gap: 10px;
} */

      .rating {
         display: flex;
         align-items: center;
         flex-direction: row-reverse;
      }

      .rating input[type="radio"] {
         display: none;
      }

      .rating label {
         font-size: 2rem;
         color: #ccc;
         cursor: pointer;
         margin-right: 0.5rem;
      }

      .rating label:hover,
      .rating label:hover~label,
      .rating input[type="radio"]:checked~label {
         color: orange;
      }
   </style>
   <!-- Custom google -->
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,200,0,0" />
</head>

<body>
   <!-- Your HTML code here -->
   <!-- Header -->
   <?php include 'header.php'; ?>

   <!-- heading -->
   <div class="heading">
      <h3>our shop</h3>
      <p> <a href="home.php">Home</a> / History </p>
   </div>

   <h1 class="title">History purchase</h1>
   <section class="products">
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

                        <!-- Display your product details here -->
                        <div class="name">
                           <h4>Product name:
                              <?php echo $fetch_products['product_name']; ?>
                           </h4>
                        </div>
                        <div class="name">
                           <h4>On Order Id:
                              <?php echo $fetch_products['order_id']; ?>
                           </h4>
                        <h5>Rating:</h5>
                        </div>
                        <div class="rating" >
                           <input type="radio" name="product_rate" id="star5-<?php echo $fetch_products['id']; ?>" value="5" <?php if ($fetch_products['product_rate'] == 5)
                                 echo 'checked'; ?>>
                           <label for="star5-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                           <input type="radio" name="product_rate" id="star4-<?php echo $fetch_products['id']; ?>" value="4" <?php if ($fetch_products['product_rate'] == 4)
                                 echo 'checked'; ?>>
                           <label for="star4-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                           <input type="radio" name="product_rate" id="star3-<?php echo $fetch_products['id']; ?>" value="3" <?php if ($fetch_products['product_rate'] == 3)
                                 echo 'checked'; ?>>
                           <label for="star3-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                           <input type="radio" name="product_rate" id="star2-<?php echo $fetch_products['id']; ?>" value="2" <?php if ($fetch_products['product_rate'] == 2)
                                 echo 'checked'; ?>>
                           <label for="star2-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                           <input type="radio" name="product_rate" id="star1-<?php echo $fetch_products['id']; ?>" value="1" <?php if ($fetch_products['product_rate'] == 1)
                                 echo 'checked'; ?>>
                           <label for="star1-<?php echo $fetch_products['id']; ?>">&#9733;</label>
                        </div>

                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['product_name']; ?>">
                        <input type="submit" class="btn btn-primary btn-lg" value="Submit rating" name="submit_rate" class="btn">
                     </form>
                     <?php
                  }
                  ?></br>
               <?php
               } else {
                  echo '<p class="empty">No products added yet for this order ID!</p>';
               }
               ?>
            </div>
            </br>
            <?php
         }
      } else {
         echo '<p class="empty">No orders found!</p>';
      }

      ?>
   </section>

   <!-- Your remaining HTML code here -->
   <!-- Footer -->
   <?php include 'footer.php'; ?>
   <!-- JS -->
   <script src="js/script.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>