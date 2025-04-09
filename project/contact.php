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


if (isset($_POST['submit'])) {
   $result = insertAppointment($conn, $_POST);

   if (!$result) {
       die('Error: ' . mysqli_error($conn));
   } else {
       header('location: home.php');
       exit();
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us</title>

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

<!-- contact section starts  -->

<section class="contact">
   <div class="contact-container">
      <div class="contact-image">
         <img src="images/contact-img.svg" alt="Contact Image">
      </div>

      <div class="contact-info">
         <h3>Contact Us</h3>
         <div class="contact-box">
            <p><i class="fas fa-user"></i> Neelima Thondapu</p>
            <p><i class="fas fa-envelope"></i> neelima@dreamhomes.com</p>
            <p><i class="fas fa-phone"></i> 210-000-1222</p>
         </div>
         <div class="contact-box">
            <p><i class="fas fa-user"></i> Lara Haiek</p>
            <p><i class="fas fa-envelope"></i> lara@dreamhomes.com</p>
            <p><i class="fas fa-phone"></i> 210-000-1223</p>
         </div>
         <div class="contact-box">
            <p><i class="fas fa-user"></i> Dhavan Raveendranath</p>
            <p><i class="fas fa-envelope"></i> dhavan@dreamhomes.com</p>
            <p><i class="fas fa-phone"></i> 210-000-1224</p>
         </div>
      </div>
   </div>
</section>

<!-- contact section ends -->

<section class="filters" style="padding-bottom: 0;">

   <form action="" method="post" enctype="multipart/form-data">
      <div id="close-filter"><i class="fas fa-times"></i></div>
      <h3>Book Appointment</h3>
      <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
         <div class="flex">
            <div class="box">
               <p>Name *</p>
               <input type="text" name="name" required maxlength="50" placeholder="Your Name" class="input">
            </div>
            <div class="box">
               <p>Email *</p>
               <input type="text" name="email" required maxlength="50" placeholder="Enter Email" class="input">
            </div>
            <div class="box">
               <p>Phone Number *</p>
               <input type="text" name="phone_number" required maxlength="50" placeholder="Enter Phone Number" class="input">
            </div>
            <div class="box">
               <p>Date *</p>
               <input type="date" class="input" name="date" required>
            </div>
            <div class="box">
               <p>Time Slot *</p>
               <select name="time" class="input" required>
                  <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                  <option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
                  <option value="12:00 PM - 01:00 PM">12:00 PM - 01:00 PM</option>
                  <option value="01:00 PM - 02:00 PM">01:00 PM - 02:00 PM</option>
                  <option value="02:00 PM - 03:00 PM">02:00 PM - 03:00 PM</option>
                  <option value="03:00 PM - 04:00 PM">03:00 PM - 04:00 PM</option>
                  <option value="04:00 PM - 05:00 PM">04:00 PM - 05:00 PM</option>
                  <option value="05:00 PM - 06:00 PM">05:00 PM - 06:00 PM</option>
               </select>
            </div>
            <div class="box">
               <p>Query</p>
               <input type="text" name="query" maxlength="50" placeholder="Appointment Reason" class="input">
            </div>
            <div class="box">
               <p>Property #</p>
               <input type="text" name="P_no" maxlength="50" placeholder="Enter Property #" class="input">
            </div>
            <div class="box">
               <p>Agent Name *</p>
               <select name="A_Id" class="input" required>
                  <option value="5051">Neelima</option>
                  <option value="5052">Lara</option>
                  <option value="5053">Dhavan</option>
               </select>
            </div>
         </div>
         <input type="submit" value="submit" name="submit" class="btn">
   </form>

</section>

<!-- faq section starts  -->

<section class="faq" id="faq">

   <h1 class="heading">FAQ</h1>

   <div class="box-container">

      <div class="box active">
         <h3><span>How to list my property for sale?</span><i class="fas fa-angle-down"></i></h3>
         <p></p>
      </div>

      <div class="box active">
         <h3><span>When will I get the possession?</span><i class="fas fa-angle-down"></i></h3>
         <p></p>
      </div>

      <div class="box">
         <h3><span>Where can I pay for the purchase of property?</span><i class="fas fa-angle-down"></i></h3>
         <p></p>
      </div>

      <div class="box">
         <h3><span>How to communicate with the buyers?</span><i class="fas fa-angle-down"></i></h3>
         <p></p>
      </div>

      <div class="box">
         <h3><span>Why my listing not showing up?</span><i class="fas fa-angle-down"></i></h3>
         <p></p>
      </div>

      <div class="box">
         <h3><span>How to view my listing?</span><i class="fas fa-angle-down"></i></h3>
         <p></p>
      </div>

   </div>

</section>

<!-- faq section ends -->










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