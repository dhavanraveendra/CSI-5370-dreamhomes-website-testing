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
   <title>All Listings</title>

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




<!-- listings section starts  -->

<?php
echo '<section class="listings">';
echo '<h1 class="heading">all listings</h1>';
$listings_query = mysqli_query($conn, "SELECT * FROM `property`") or die('Query failed');

// Check if there are listings
if (mysqli_num_rows($listings_query) > 0) {
    while ($property = mysqli_fetch_assoc($listings_query)) {
        // Your HTML code here, replacing static content with dynamic content from $listing
        // Example: $listing['property_name'], $listing['location'], etc.
        echo '<div class="box-container">';
        echo '<div class="box">';
        echo '<h1>Property #' . $property['P_Id'] . '</h1>';
        echo '<h2>' . $property['city'] . '</h2>';
        echo '<span>' . $property['listing_date'] . '</span>';
        echo '<div class="thumb">';
        //echo '<p class="total-images"><i class="far fa-image"></i><span></span></p>';
        echo '<p class="type"><span>' . $property['p_type'] . '</span><span>' . $property['p_status'] . '</span></p>';
        //echo '<form action="" method="post" class="save">';
        //echo '<button type="submit" name="save" class="far fa-heart"></button>';
        //echo '</form>';
        echo '<img src="uploaded_img/' . $property['image'] . '" alt="property-image">';
        echo '</div>';
        echo '<p class="location"><i class="fas fa-map-marker-alt"></i><span>' . $property['address'] . '</span></p>';
        echo '<div class="flex">';
        echo '<p><i class="fas fa-bed"></i><span>' . $property['no_bedroom'] . '</span></p>';
        echo '<p><i class="fas fa-bath"></i><span>' . $property['no_bathroom'] . '</span></p>';
        echo '<p><i class="fas fa-maximize"></i><span>' . $property['area'] . '</span></p>';
        echo '</div>';
        echo '<a href="view_property.php?P_Id=' . $property['P_Id'] . '" class="btn">View Property</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No listings found.";
}
echo '</section>';

?>


<!-- listings section ends -->












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