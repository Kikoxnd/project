<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:signlog.php');
}

// calculate the total rating from product and history
// Take data from products
$get_productrating = mysqli_query($conn, "SELECT * FROM `products`") or die('Query get product rating failed');
if (mysqli_num_rows($get_productrating) > 0) {
   while ($productrating_get = mysqli_fetch_assoc($get_productrating)) {
      $get_nameproducts = $productrating_get['name'];
      $get_ratingproducts = $productrating_get['pro_rates'];
      // echo $get_nameproducts, "-PRODUCT"; ?>
      <!-- </br> -->
      <?php
      $temptotal = 0;
      $finalrate_peritem = 0;
      $get_historyrating = mysqli_query($conn, "SELECT * FROM `history` WHERE product_name = '$get_nameproducts' ") or die('Query get product rating failed');
      if (mysqli_num_rows($get_historyrating) > 0) {
         while ($historyrating_get = mysqli_fetch_assoc($get_historyrating)) {

            $rate_peritem = $historyrating_get['product_rate'];
            $finalrate_peritem += $rate_peritem;
            mysqli_query($conn, "UPDATE `products` SET pro_rates ='$finalrate_peritem' WHERE name = '$get_nameproducts'") or die('not able to update total rate');
            // echo $historyrating_get['product_name'], "+", $historyrating_get['product_rate'], "-HISTORY";
            ?>
            <!-- </br> -->
            <?php
            // echo "Final rate for item", $historyrating_get['product_name'], ":", $finalrate_peritem;
            // echo "Total item for", $historyrating_get['product_name'], ":", $temptotal;
            ?>
            <!-- </br> -->
            <?php
            $temptotal = $temptotal + 1;
            $final_pertitemrate = $finalrate_peritem / $temptotal;
            // echo $final_pertitemrate, "=", $finalrate_peritem, "/", $temptotal;
            mysqli_query($conn, "UPDATE `products` SET pro_rates ='$final_pertitemrate' WHERE name = '$get_nameproducts'") or die('not able to update total rate');
         }

      }
   }

}

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_size = $_POST['product_size'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
   $fetch_quantcart = mysqli_fetch_assoc($check_cart_numbers);
   $compare_quant = mysqli_query($conn, "SELECT * FROM products WHERE name='$product_name'");
   $fetch_quantitem = mysqli_fetch_assoc($compare_quant);

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart!';
   } else {
      // if quantity item = 0 and less than 0 and quantity required more than quantity available
      if ($fetch_quantitem['quant'] == 0 || $fetch_quantitem['quant'] < 0 || $product_quantity > $fetch_quantitem['quant']) {
         $message[] = 'Product out of order or exceed the quantity available';
      } else {
         mysqli_query($conn, "INSERT INTO `cart`(user_id, name, pro_size,price, quantity, image) 
                        VALUES('$user_id', '$product_name', $product_size, '$product_price', '$product_quantity', '$product_image')") or die('query failed');
         $message[] = 'product added to cart!';
      }
      // mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      // $message[] = 'product added to cart!';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Implies Coding Techniques -->
   <meta charset="UTF-8">

   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="css/popup.css"> -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <!-- boot view popup -->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   <style>
      .modal {
         background-color: none;
         width: 100%;
         /* border: 4px yellow solid; */
         position: center;
      }

      .modal-dialog {
         background-color: none;
         border-radius: 12px;
         width: auto;
         /* height: 120%; */
         /* border: 4px blue solid; */
         /* margin-right: auto; */
         position: center;
         overflow: visible;
         right: 100px
            /* margin-left: 100px; */
            /* padding-left: 100px;
         padding-right: 100px; */
            /* display: relative;
         justify-content: end;
         align-items: start; */
      }

      .modal-content {
         background-color: none;
         border-radius: 12px;
         width: 140%;
         /* border: 4px red solid; */
         position: center;
         margin-left: auto;
         margin-right: auto;
      }

      .modal-body {
         /* border: 5px green solid; */
         display: flex;
         /* flex-direction: row; */
         padding: 7px;
      }

      .content {
         padding: 10px;
         text-align: justify;
         letter-spacing: 1px;
         font-size: 14px;
      }

      .container {
         padding: 10px;
      }

      .buttonnn {
         border: 10px solid blue;
         border-radius: 12px;
         background-color: turquoise;
         color: black;
         padding: 15px 32px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 16px;
         margin: 4px 2px;
         cursor: pointer;
      }

      .card {
         position: relative;
         width: 320px;
         height: 480px;
         background: #191919;
         border-radius: 20px;
         overflow: hidden;
      }

      .card::before {
         content: "";
         position: absolute;
         top: -50%;
         width: 100%;
         height: 100%;
         background: #ffce00;
         transform: skewY(345deg);
         transition: 0.5s;
      }

      .card:hover::before {
         top: -70%;
         transform: skewY(390deg);
      }

      .card::after {
         content: "CORSAIR";
         position: absolute;
         bottom: 0;
         left: 0;
         font-weight: 600;
         font-size: 6em;
         color: rgba(0, 0, 0, 0.1);
      }

      .card .imgBox {
         position: relative;
         width: 100%;
         display: flex;
         justify-content: center;
         align-items: center;
         padding-top: 20px;
         z-index: 1;
      }

      /*
.card .imgBox img {
    max-width: 100%;
    
    transition: .5s;
}

.card:hover .imgBox img {
    max-width: 50%;
      
}
*/
      /* .card .contentBox {
  position: relative;
  padding: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  z-index: 2;
}

.card .contentBox h3 {
  font-size: 18px;
  color: white;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.card .contentBox .price {
  font-size: 24px;
  color: white;
  font-weight: 700;
  letter-spacing: 1px;
}

.card .contentBox .buy {
  position: relative;
  top: 100px;
  opacity: 0;
  padding: 10px 30px;
  margin-top: 15px;
  color: #000000;
  text-decoration: none;
  background: #ffce00;
  border-radius: 30px;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: 0.5s;
}

.card:hover .contentBox .buy {
  top: 0;
  opacity: 1;
}

.mouse {
  height: 300px;
  width: auto;
} */
   </style>
</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>our shop</h3>
      <p> <a href="home.php">Home</a> / Shop </p>
   </div>

   <section class="products">
      <!-- HTML -->
      <h1 class="title">latest products</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="Products shop">
                  <div class="name">
                     <?php echo $fetch_products['name']; ?>
                  </div>
                  <div class="price">RM
                     <?php echo $fetch_products['price']; ?>/Size:
                     <?php echo $fetch_products['Size']; ?>
                  </div>
                  <div class="quant">Stock:
                     <?php echo $fetch_products['quant']; ?>
                  </div>
                  <div class="quant">
                     <?php
                     $rating = $fetch_products['pro_rates'];
                     // Display the rating as stars
                     for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                           echo '<i class="fa fa-star text-primary" style="margin-right: 5px;"></i>';
                        } else {
                           echo '<i class="fa fa-star text" style="margin-right: 5px;"></i>';
                        }
                     }
                     ?>
                     </div>
                  <?php $maxquantitem = $fetch_products['quant']; ?>
                  <input type="hidden" min="1" name="product_quantity" value="1" class="form-control form-control-lg">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_size" value="<?php echo $fetch_products['Size']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" class="btn btn-primary btn-lg" value="add to cart" name="add_to_cart" class="btn">
                  <a href="shop_details.php?id=<?php echo $fetch_products['id']; ?>" class="btn btn-outline-primary btn-lg">details</a>
                  <!-- <input type="submit" value="view details" name="view_details" class="btn"> -->
                  &nbsp
                  <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal"
                     data-target="#myModal<?php echo $fetch_products['id'] ?>">View</button>

                  <!-- Display popup -->
                  <div id="myModal<?php echo $fetch_products['id'] ?>" class="modal fade" role="dialog">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h4 class="modal-title">Details</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                           </div>
                           <div class="modal-body">

                              <div class="container">
                                 <div class="imgBx">
                                    <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                 </div>
                                 <!-- <img src="https://github.com/anuzbvbmaniac/Responsive-Product-Card---CSS-ONLY/blob/master/assets/img/jordan_proto.png?raw=true" alt="Nike Jordan Proto-Lyte Image"> -->
                              </div>

                              <div class="content">
                                 <h2>
                                    <?php echo $fetch_products['name']; ?>
                                    <br>
                                    <span>Deezek.co Collection</span>
                                 </h2>
                                 <p>
                                    <?php echo $fetch_products['description']; ?>
                                 </p>
                                 <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                       class="bi bi-box" viewBox="0 0 16 16">
                                       <path
                                          d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                    </svg>
                                    BUBBLEWARP + 3 FREEGIFT, KOTAK, STOKING, KEYCHAIN
                                 </p>
                                 <h3>Size(Euro):
                                    <?php echo $fetch_products['Size']; ?>
                                 </h3>
                                 <h3>Stock:
                                    <?php echo $fetch_products['quant']; ?>
                                 </h3>
                                 <h3>RM:
                                    <?php echo $fetch_products['price']; ?>
                                 </h3>
                                 <!-- <button>Buy Now</button> -->
                              </div>

                           </div>
                        </div>
                     </div>
                  </div>

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