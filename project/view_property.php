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
   <title>View Property</title>

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

<!-- view property section starts  -->

<?php
// view_property.php

// Check if the P_Id parameter is set in the URL
if (isset($_GET['P_Id'])) {
    $property_id = $_GET['P_Id'];

    // Retrieve property details from the database using the property ID
    $property_query = mysqli_query($conn, "SELECT * FROM `property` WHERE `P_Id` = $property_id") or die('Query failed');
    


    echo '<section class="view-property">';
    echo '<div class="details">';

    // Check if the property exists
    if (mysqli_num_rows($property_query) > 0) {
        $property_details = mysqli_fetch_assoc($property_query);

        // Display property details here using $property_details
        echo '<div class="thumb">
        <div class="big-image">
           <img src="uploaded_img/' . $property_details['image'] . '" alt="">
        </div>
      </div>';
        echo '<h3 class="name">Property #' . $property_details['P_Id'] . '</h3>';
        echo '<p class="location"><i class="fas fa-map-marker-alt"></i><span>' . $property_details['address'] . '</span></p>';
        echo '<div class="info">
        <p><i class="fas fa-tag"></i><span>' . $property_details['price'] . '</span></p>
        <p><i class="fas fa-building"></i><span>' . $property_details['p_type'] . '</span></p>
        <p><i class="fas fa-house"></i><span>' . $property_details['p_status'] . '</span></p>
        <p><i class="fas fa-calendar"></i><span>' . $property_details['listing_date'] . '</span></p>
      </div>';
        echo '<h3 class="title">Details</h3>';
        echo '<div class="flex">
        <div class="box">
           <p><i>Status :</i><span>' . $property_details['p_status'] . '</span></p>
           <p><i>Type :</i><span>' . $property_details['p_type'] . '</span></p>
           <p><i>Bedroom :</i><span>' . $property_details['no_bedroom'] . '</span></p>
           <p><i>Bathroom :</i><span>' . $property_details['no_bathroom'] . '</span></p>
           <p><i>Furnished :</i><span>' . $property_details['furnished'] . '</span></p>
        </div>
        <div class="box">
           <p><i>Area :</i><span>' . $property_details['area'] . '</span></p>
           <p><i>Price :</i><span>' . $property_details['price'] . '</span></p>
           <p><i>Move-in Date :</i><span>' . $property_details['movein_date'] . '</span></p>';

           // Fetch Agent details using A_Id
            $agent_id = $property_details['A_Id'];
            $agent_query = mysqli_query($conn, "SELECT * FROM `Agent` WHERE `A_Id` = $agent_id") or die('Agent query failed');

            // Check if the agent exists
            if ($agent = mysqli_fetch_assoc($agent_query)) {
                  // Display Agent Name and Phone Number
                  echo '<p><i>Agent Name :</i><span>' . $agent['First_Name'] . ' ' . $agent['Last_Name'] . '</span></p>';
                  echo '<p><i>Agent Phone :</i><span>' . $agent['Phone_Number'] . '</span></p>';
            } else {
                  echo 'Agent not found.';
            }
        
        
        echo '</div></div>';
        echo '<h3 class="title">Description</h3>';
        echo '<p class="description">' . $property_details['description'] . '</p>';
        echo '</div>';
        echo '</section>';
    } else {
        echo "Property not found.";
    }
} else {
    echo "Invalid request.";
}
?>


<!-- view property section ends -->












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