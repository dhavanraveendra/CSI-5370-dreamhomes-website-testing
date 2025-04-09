<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:admin_login.php');
};

if (isset($_POST['submit'])) {
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $p_type = mysqli_real_escape_string($conn, $_POST['p_type']);
    $p_status = mysqli_real_escape_string($conn, $_POST['p_status']);
    $no_bedroom = mysqli_real_escape_string($conn, $_POST['no_bedroom']);
    $no_bathroom = mysqli_real_escape_string($conn, $_POST['no_bathroom']);
    $furnished = mysqli_real_escape_string($conn, $_POST['furnished']);
    $area = mysqli_real_escape_string($conn, $_POST['area']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $movein_date = mysqli_real_escape_string($conn, $_POST['movein_date']);
    $listing_date = mysqli_real_escape_string($conn, $_POST['listing_date']);
    $A_Id = mysqli_real_escape_string($conn, $_POST['A_Id']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Get today's date
    $today = date('Y-m-d');

    // Check if movein_date and listing_date are in the past
    if ($movein_date < $today) {
        $message = "Move-in date cannot be in the past!";
    } elseif ($listing_date < $today) {
        $message = "Listing date cannot be in the past!";
    } else {
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;

        // Insert property details into the database
        $query = "INSERT INTO `Property` (`city`, `address`, `p_type`, `p_status`, `no_bedroom`, `no_bathroom`, `furnished`, `image`, 
                  `area`, `price`, `movein_date`, `listing_date`, `A_Id`, `description`) 
                  VALUES ('$city', '$address', '$p_type', '$p_status', '$no_bedroom', '$no_bathroom', '$furnished', '$image', '$area', 
                  '$price', '$movein_date', '$listing_date', '$A_Id', '$description')";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Error: ' . mysqli_error($conn));
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message = "Property added successfully!";
            header('location: admin_property_listing_form.php'); // Redirect to a success page if needed
        }
    }
}

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
   <title>Property Listing Form</title>

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
      <h3>Property</h3>
      <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
         <div class="flex">
            <div class="box">
               <p>City *</p>
               <input type="text" name="city" required maxlength="50" placeholder="Enter City Name" class="input">
            </div>
            <div class="box">
               <p>Address *</p>
               <input type="text" name="address" required maxlength="50" placeholder="Enter the Address" class="input">
            </div>
            <div class="box">
               <p>Property Type *</p>
               <select name="p_type" class="input" required>
                  <option value="House">House</option>
                  <option value="Condo">Condo</option>
                  <option value="Apartment">Apartment</option>
               </select>
            </div>
            <div class="box">
               <p>Property Status *</p>
               <select name="p_status" class="input" required>
                  <option value="Coming Soon">Coming Soon</option>
                  <option value="Available">Available</option>
                  <option value="Sold">Sold</option>
               </select>
            </div>
            <div class="box">
               <p>Bedroom *</p>
               <select name="no_bedroom" class="input" required>
                  <option value="1">1 Bedroom</option>
                  <option value="2">2 Bedroom</option>
                  <option value="3">3 Bedroom</option>
                  <option value="4">4 Bedroom</option>
                  <option value="5">5 Bedroom</option>
                  <option value="6">6 Bedroom</option>
               </select>
            </div>
            <div class="box">
               <p>Bathroom *</p>
               <select name="no_bathroom" class="input" required>
                  <option value="1">1 Bathroom</option>
                  <option value="2">2 Bathroom</option>
                  <option value="3">3 Bathroom</option>
                  <option value="4">4 Bathroom</option>
                  <option value="5">5 Bathroom</option>
                  <option value="6">6 Bathroom</option>
               </select>
            </div>
            <div class="box">
               <p>Furnished *</p>
               <select name="furnished" class="input" required>
                  <option value="Furnished">Furnished</option>
                  <option value="Un-Furnished">Un-Furnished</option>
                  <option value="Semi-Furnished">Semi-Furnished</option>
               </select>
            </div>
            <div class="box">
                <p>Property Image *</p>
                <input type="file" name="image" class="input" accept="image/jpg, image/jpeg, image/png" required>
            </div>
            <div class="box">
               <p>Area *</p>
               <input type="text" name="area" required maxlength="50" placeholder="Enter Property Area in Sqft" class="input">
            </div>
            <div class="box">
               <p>Price *</p>
               <input type="text" name="price" required maxlength="50" placeholder="Enter Property Price" class="input">
            </div>
            <div class="box">
                <p>Move-in Date *</p>
                <input type="date" class="input" name="movein_date" required>
            </div>
            <div class = "box">
                <p>Listing Date *</p>
                <input type="date" class="input" name="listing_date" required>
            </div>
            <div class="box">
               <p>Agent Name *</p>
               <select name="A_Id" class="input" required>
                  <option value="5051">Neelima</option>
                  <option value="5052">Lara</option>
                  <option value="5053">Dhavan</option>
               </select>
            </div>
            <div class="box">
               <p>Description</p>
               <input type="text" name="description" maxlength="500" placeholder="Enter Additional Information" class="input">
            </div>
         </div>
         <input type="submit" value="submit" name="submit" class="btn">
   </form>

</section>


<section class="">
    <h1>Property Information</h1>

    <?php

        
        $sql = "SELECT * FROM property";
        $result = $conn->query($sql);

        // Check if there are results
        if ($result->num_rows > 0) {
            // Output data in the form of a table
            echo "<table border='1'>";
            echo "<tr><th> Property ID </th><th> Listing Date </th><th> City </th><th> Property Status </th><th> Property Type </th><th> Address </th><th> Bedroom </th><th> Bathroom </th>
            <th> Area </th><th> Furnished </th><th> Price </th><th> Move-in Date </th><th> Property ID </th><th> Agent ID </th></tr>";

            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["P_Id"] . "</td>";
                echo "<td>" . $row["listing_date"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["p_status"] . "</td>";
                echo "<td>" . $row["p_type"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["no_bedroom"] . "</td>";
                echo "<td>" . $row["no_bathroom"] . "</td>";
                echo "<td>" . $row["area"] . "</td>";
                echo "<td>" . $row["furnished"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["movein_date"] . "</td>";
                echo "<td>" . $row["P_Id"] . "</td>";
                echo "<td>" . $row["A_Id"] . "</td>";
                echo "<td><a href='admin_edit_property.php?P_Id=" . $row["P_Id"] . "'>Edit</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        
    ?>
    
    </section>



<!-- listings section starts  -->

<?php
echo '<section class="listings">';
echo '<h1 class="heading">all listings</h1>';
$listings_query = mysqli_query($conn, "SELECT * FROM `property` ORDER BY `P_Id` DESC") or die('Query failed');

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
        echo '<a href="view_property_' . $property['P_Id'] . '.php" class="btn">view property</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No listings found.";
}
echo '</section>';

?>


<!-- listings section ends -->

</body>
</html>