<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/stock.JPG" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>At our ecommerce system, we offering an exceptional shopping experience. When you choose us, you gain access to a wide range of high-quality products that have been carefully curated to meet your needs. Rest assured that your data and transactions are secure, as we prioritize the privacy and protection of our customers. With our user-friendly interface, extensive product selection, and seamless checkout process, shopping with us is convenient and hassle-free.</p>
         <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p> -->
         <a href="contact.php" class="btn btn-primary btn-lg">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/amir.JPG" alt="">
         <p>I can't say enough good things about this website. It was a breeze to navigate, with a clean and modern design. The content was top-notch, providing valuable information and captivating articles. This website exceeded my expectations in every way.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Amir Asyraaf</h3>
      </div>

      <div class="box">
         <img src="images/dee.JPG" alt="">
         <p>The website was user-friendly with a smooth interface and easy navigation. It loaded quickly on various devices. The content was informative and well-written, and the customer service was excellent. Overall, a great experience when using it!.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Effa Mardiana</h3>
      </div>

      <div class="box">
         <img src="images/adib.JPG" alt="">
         <p>This website was a pleasure to use. It was incredibly user-friendly, with intuitive navigation and a sleek interface. The content was informative and engaging. I recommend this website for its usability, quality content, and excellent support.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Muhammad Adib</h3>
      </div>

      <div class="box">
         <img src="images/ezayana.JPG" alt="">
         <p> I was blown away by this website! The user experience was outstanding, with seamless navigation and an intuitive interface. The content was not only informative but also presented in a captivating and engaging manner. I can confidently say that this website sets the bar high for others in terms of usability, content quality, and customer support.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Dr Nurezayana</h3>
      </div>

      
   </div>

</section>

<section class="authors">

   <h1 class="title">Developers Team</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/team-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Adib Aqil-Designer</h3>
      </div>

      <div class="box">
         <img src="images/team-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Mrkiko-Data Integration</h3>
      </div>

      <div class="box">
         <img src="images/team-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>AqilAdib-Tester</h3>
      </div>

   </div>

</section>




<h1>&nbsp</h1>
<div class="h_line"></div>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>