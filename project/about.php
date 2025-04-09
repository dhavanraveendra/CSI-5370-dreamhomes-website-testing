<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->

<header class="header">

   <nav class="navbar nav-1">
      <section class="flex">
         <a href="home.php" class="logo"><i class="fas fa-house"></i>DreamHomes</a>

         <ul>
            <li><a href="review.php">Share Review<i class="fas fa-paper-plane"></i></a></li>
         </ul>
      </section>
   </nav>

   <nav class="navbar nav-2">
      <section class="flex">
         <div id="menu-btn" class="fas fa-bars"></div>

         <div class="menu">
            <ul>
               <li><a href="listings.php">Buy</i></a></li>
               <li><a href="contact.php">Sell</i></a></li>
               <li><a href="about.php">About Us</a></i></li>
               <li><a href="contact.php">Contact Us</a></i></li>
               <li><a href="contact.php#faq">FAQs</a></i></li>
            </ul>
         </div>

         <ul>
            <!-- <li><a href="#">saved <i class="far fa-heart"></i></a></li> -->
            <li><a href="search.php"><i class="fas fa-search"></i></a></li>
            <li>
            <div class="account-container">
            <div class="account-btn">
                <h2><b>Account</b></h2>
                <div class="profile">
                    <ul>
                        <li><!-- profile section starts -->
                            <?php
                            $select = mysqli_query($conn, "SELECT * FROM `User` WHERE U_ID = '$user_id'") or die('query failed');
                            if(mysqli_num_rows($select) > 0){
                                $fetch = mysqli_fetch_assoc($select);
                            }
                            if($fetch['image'] == ''){
                                echo '<img src="images/default-avatar.png" width="100" height="100">';
                            } else {
                                echo '<img src="uploaded_img/'.$fetch['image'].'" width="100" height="100">';
                            }
                            ?>

                            <?php if (!empty($fetch)): ?>
                                <h2><?php echo $fetch['name']; ?></h2>
                                <a href="update_profile.php" class="btn">Update Profile</a>
                                <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout</a>
                            <?php endif; ?>
                        </li>
                    </ul>

                     </div>

                  </div>
               </ul>
            </li>
         </ul>

         <script>
            // JavaScript for handling hover event
            const accountBtn = document.querySelector('.account-btn');
            const profileContainer = document.querySelector('.profile');

            accountBtn.addEventListener('mouseenter', function () {
                profileContainer.style.display = 'block';
            });

            accountBtn.addEventListener('mouseleave', function () {
                profileContainer.style.display = 'none';
            });
        </script>


         
      </section>
      
   </nav>

</header>

<!-- header section ends -->





<!-- about section starts  -->

<section class="about">

   <div class="row">
      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>
      <div class="content">
         <h3>why choose us?</h3>
         <p>Ready to embark on your real estate journey with confidence? Choose DreamHomes today!</p>
         <a href="contact.php" class="inline-btn">contact us</a>
      </div>
   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="heading">3 simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>search property</h3>
         <p>Begin your real estate journey by exploring a wide range of properties tailored to your preferences. Our user-friendly search feature allows you to filter through a diverse selection of homes, apartments, and commercial spaces based on location, budget, property type, and more.</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>contact agents</h3>
         <p>Feel free to contact us to schedule a consultation, ask questions, or discuss your specific real estate needs. We value open communication and transparency, and our agents are ready to provide you with the information and guidance you need to make informed decisions.</p>
         
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy property</h3>
        <p>At DreamHomes, we understand that finding the perfect property is a significant decision. Let us guide you through the process, providing expert advice and personalized solutions. Your satisfaction is our priority, and we strive to make your real estate journey a seamless and enjoyable experience.</p>

      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- review section starts  -->

<section class="reviews">

   <h1 class="heading">Client's Reviews</h1>

   <div class="box-container">

      <div class="box">
         <div class="user">
            <img src="images/pic-1.png" alt="">
            <div>
               <h3>Connie</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
         <p>I didn't know how to begin the search for a realtor in the area I was interested in purchasing my next home. DreamHomes was recommended to me. They were responsive and efficient in getting back to me very quickly and recommended a realtor who turned out to be absolutely terrfic. I would highly recommend them to assist you in your search.</p>
      </div>

      <div class="box">
         <div class="user">
            <img src="images/pic-2.png" alt="">
            <div>
               <h3>Monica</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
         <p>My husaband and I were first time home buyers. After going to DreamHomes website, I answered a few questions and the next day got matched up with our realtor. It was the absolute best, and we were able to find our Starter home Soon after. DreamHomes service was so easy, and I have them to thank for setting us up with our amazing realtor.I am very happy with DreamHomes.</p>
      </div>

      <div class="box">
         <div class="user">
            <img src="images/pic-3.png" alt="">
            <div>
               <h3>Thomas</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
         <p>The service that DreamHomes provided was a tremendous help. DreamHomes was able to match our specific situation and needs to a selection of local realtors and remove a lot of the legwork from the selection process.I am very happy that work done within a month and I moved into the house with my family and My childern are loved with the place.</p>
      </div>

      <div class="box">
         <div class="user">
            <img src="images/pic-4.png" alt="">
            <div>
               <h3>Cory</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
         <p>Using DreamHomes made it to easy to find the top selling real estate agent in our area. The process from beginning to end was so quick and easy. Our DreamHomes got to work right away and was very confident in the listing process. Our home went under contract just 2-3 weeks and sold quickly!.</p>
      </div>

      <div class="box">
         <div class="user">
            <img src="images/pic-5.png" alt="">
            <div>
               <h3>Pattie</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
         <p>Purely Professional from start to finish. I received an immediate response. In less than two months the property was sold for much more than expected. DreamHomes is the game changer of real estate. I am very happy that I can earn more than what I expected. They explained eveything in details.</p>
      </div>

      <div class="box">
         <div class="user">
            <img src="images/pic-6.png" alt="">
            <div>
               <h3>Lisa</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
         <p>When selling my home, I needed a reliable, trustworthy, competent team with excellent communication and coordianation skills. DreamHomes met those requirements. The sale was handled quickly and falwlessly. I would recommend the DreamHomes teams to anyone.</p>
      </div>

   </div>

</section>

<!-- review section ends -->










<!-- footer section starts  -->

<footer class="footer">

   <section class="flex">

      <div class="box">
         <a href="tel:1234567890"><i class="fas fa-phone"></i><span>2100001221</span></a>
         <a href="mailto:shaikhanas@gmail.com"><i class="fas fa-envelope"></i><span>contact@dreamhomes.com</span></a>
         <a href="#"><i class="fas fa-map-marker-alt"></i><span>5450 CSI St, Star City, MI - 12053</span></a>
      </div>

      <div class="box">
         <a href="home.php"><span>Home</span></a>
         <a href="about.php"><span>About</span></a>
         <a href="contact.php"><span>Contact</span></a>
         <a href="listings.php"><span>All Listings</span></a>
      </div>

      <div class="box">
         <a href="#"><span>facebook</span><i class="fab fa-facebook-f"></i></a>
         <a href="#"><span>twitter</span><i class="fab fa-twitter"></i></a>
         <a href="#"><span>linkedin</span><i class="fab fa-linkedin"></i></a>
         <a href="#"><span>instagram</span><i class="fab fa-instagram"></i></a>

      </div>

   </section>

   <div class="credit">&copy; copyright @ 2023 | all rights reserved!</div>

</footer>

<!-- footer section ends -->


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>