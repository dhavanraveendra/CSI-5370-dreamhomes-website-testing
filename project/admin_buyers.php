<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
   header('location:admin_login.php');
}

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:admin_login.php');
}


if (isset($_POST['submit'])) {
    $First_Name = mysqli_real_escape_string($conn, $_POST['First_Name']);
    $Last_Name = mysqli_real_escape_string($conn, $_POST['Last_Name']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Phone_Number = mysqli_real_escape_string($conn, $_POST['Phone_Number']);
    $Budget = mysqli_real_escape_string($conn, $_POST['Budget']);
    $Preference = mysqli_real_escape_string($conn, $_POST['Preference']);
    $P_Id = mysqli_real_escape_string($conn, $_POST['P_Id']);
    $A_Id = mysqli_real_escape_string($conn, $_POST['A_Id']);

    // Insert property details into the database
    $query = "INSERT INTO `Buyer` (`First_Name`, `Last_Name`, `Email`, `Phone_Number`, `Budget`, `Preference`, `P_Id`, `A_Id`) 
          VALUES ('$First_Name', '$Last_Name', '$Email', '$Phone_Number', '$Budget', '$Preference', '$P_Id', '$A_Id')";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    } else {
        $message = "Property added successfully!";
        header('location: admin_buyers.php'); // Redirect to a success page if needed
}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Buyer Information</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 2px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

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
               <li><a href="admin_reviews.php#faq">Reviews</a></i></li>
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



<section class="filters" style="padding-bottom: 0;">

   <form action="" method="post" enctype="multipart/form-data">
      <div id="close-filter"><i class="fas fa-times"></i></div>
      <h3>Buyer</h3>
      <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
         <div class="flex">
            <div class="box">
               <p>First Name *</p>
               <input type="text" name="First_Name" required maxlength="50" placeholder="Enter First Name" class="input">
            </div>
            <div class="box">
               <p>Last Name *</p>
               <input type="text" name="Last_Name" required maxlength="50" placeholder="Enter Last Name" class="input">
            </div>
            <div class="box">
               <p>Email *</p>
               <input type="text" name="Email" required maxlength="50" placeholder="Enter Email" class="input">
            </div>
            <div class="box">
               <p>Phone Number *</p>
               <input type="text" name="Phone_Number" required maxlength="50" placeholder="Enter Phone Number" class="input">
            </div>
            <div class="box">
               <p>Budget</p>
               <input type="text" name="Budget" maxlength="50" placeholder="Enter the Budget" class="input">
            </div>
            <div class="box">
               <p>Preference</p>
               <input type="text" name="Preference" maxlength="50" placeholder="Enter the Preferences" class="input">
            </div>
            <div class="box">
               <p>Property ID</p>
               <input type="text" name="P_Id" maxlength="50" placeholder="Enter Property ID" class="input">
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






<section class="">
    <h1>Buyer Information</h1>

    <?php

        
        $sql = "SELECT * FROM Buyer";
        $result = $conn->query($sql);

        // Check if there are results
        if ($result->num_rows > 0) {
            // Output data in the form of a table
            echo "<table border='1'>";
            echo "<tr><th> Buyer ID </th><th> First Name </th><th> Last Name </th><th> Email </th><th> Phone Number </th><th> Budget </th><th> Preference </th><th> Property ID </th><th> Agent ID </th></tr>";

            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["B_ID"] . "</td>";
                echo "<td>" . $row["First_Name"] . "</td>";
                echo "<td>" . $row["Last_Name"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["Phone_Number"] . "</td>";
                echo "<td>" . $row["Budget"] . "</td>";
                echo "<td>" . $row["Preference"] . "</td>";
                echo "<td>" . $row["P_Id"] . "</td>";
                echo "<td>" . $row["A_Id"] . "</td>";
                echo "<td><a href='admin_edit_buyer.php?B_ID=" . $row["B_ID"] . "'>Edit</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        
    ?>
    
    </section>



</body>
</html>