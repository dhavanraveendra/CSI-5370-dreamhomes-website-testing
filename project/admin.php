<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:admin_login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:admin_login.php');
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>

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
         <a href="admin.php" class="logo"><i class="fas fa-house"></i>DreamHomes Admin</a>

         <!-- <ul>
            <li><a href="#">post property<i class="fas fa-paper-plane"></i></a></li>
         </ul> -->
      </section>
   </nav>

   <nav class="navbar nav-2">
      <section class="flex">
         <div id="menu-btn" class="fas fa-bars"></div>

         <div class="menu">
            <ul>
               <li><a href="admin_property_listing_form.php">Property Listing</i></a></li>
               <li><a href="admin_buyers.php">Buyers</i></a></li>
               <li><a href="admin_sellers.php">Sellers</a></i></li>
               <li><a href="admin_transactions.php">Transactions</a></i></li>
               <li><a href="admin_appointments.php">Appoinments</a></i></li>
               <li><a href="admin_marketing.php">Marketing</a></i></li>
               <li><a href="admin_reviews.php">Reviews</a></i></li>
            </ul>
         </div>

         <ul>
            <!-- <li><a href="#">saved <i class="far fa-heart"></i></a></li> -->
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
                                <a href="admin.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout</a>
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


<div class="admin_home">
    

</div>


</body>
</html>