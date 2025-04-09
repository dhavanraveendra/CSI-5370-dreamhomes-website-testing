<section class="filters" style="padding-bottom: 0;">
    <form action="" method="post">
        <input type="hidden" name="P_Id" value="<?php echo $row['P_Id']; ?>">
        <!-- Add other input fields here with pre-filled data -->
        <!-- ... (existing code) -->
        <div id="close-filter"><i class="fas fa-times"></i></div>
      <h3>Property</h3>
      <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
         <div class="flex">
            <div class="box">
               <p>City *</p>
               <input type="text" name="city" required maxlength="50" placeholder="Enter City Name" class="input" value="<?php echo $row['city']; ?>">
            </div>
            <div class="box">
               <p>Address *</p>
               <input type="text" name="address" required maxlength="50" placeholder="Enter the Address" class="input" value="<?php echo $row['address']; ?>">
            </div>
            <div class="box">
               <p>Property Type *</p>
               <select name="p_type" class="input" required value="<?php echo $row['p_type']; ?>">
                  <option value="House">House</option>
                  <option value="Condo">Condo</option>
                  <option value="Apartment">Apartment</option>
               </select>
            </div>
            <div class="box">
               <p>Property Status *</p>
               <select name="p_status" class="input" required value="<?php echo $row['p_status']; ?>">
                  <option value="Coming Soon">Coming Soon</option>
                  <option value="Available">Available</option>
                  <option value="Sold">Sold</option>
               </select>
            </div>
            <div class="box">
               <p>Bedroom *</p>
               <input type="text" name="no_bedroom" required maxlength="50" placeholder="Enter Number of Bedrooms" class="input" value="<?php echo $row['no_bedroom']; ?>">
            </div>
            <!-- <div class="box">
               <p>Bedroom *</p>
               <select name="no_bedroom" class="input" required value="<?php echo $row['no_bedroom']; ?>">
                  <option value="1">1 Bedroom</option>
                  <option value="2">2 Bedroom</option>
                  <option value="3">3 Bedroom</option>
                  <option value="4">4 Bedroom</option>
                  <option value="5">5 Bedroom</option>
                  <option value="6">6 Bedroom</option>
               </select>
            </div> -->
            <div class="box">
               <p>Bathroom *</p>
               <input type="text" name="no_bathroom" required maxlength="50" placeholder="Enter Number of Bathrooms" class="input" value="<?php echo $row['no_bathroom']; ?>">
            </div>
            <!-- <div class="box">
               <p>Bathroom *</p>
               <select name="no_bathroom" class="input" required value="<?php echo $row['no_bathroom']; ?>">
                  <option value="1">1 Bathroom</option>
                  <option value="2">2 Bathroom</option>
                  <option value="3">3 Bathroom</option>
                  <option value="4">4 Bathroom</option>
                  <option value="5">5 Bathroom</option>
                  <option value="6">6 Bathroom</option>
               </select>
            </div> -->
            <div class="box">
               <p>Furnished *</p>
               <select name="furnished" class="input" required value="<?php echo $row['furnished']; ?>">
                  <option value="Furnished">Furnished</option>
                  <option value="Un-Furnished">Un-Furnished</option>
                  <option value="Semi-Furnished">Semi-Furnished</option>
               </select>
            </div>
            <!-- <div class="box">
                <p>Property Image *</p>
                <input type="file" name="image" class="input" accept="image/jpg, image/jpeg, image/png" required>
            </div> -->
            <div class="box">
               <p>Area *</p>
               <input type="text" name="area" required maxlength="50" placeholder="Enter Property Area in Sqft" class="input" value="<?php echo $row['area']; ?>">
            </div>
            <div class="box">
               <p>Price *</p>
               <input type="text" name="price" required maxlength="50" placeholder="Enter Property Price" class="input" value="<?php echo $row['price']; ?>">
            </div>
            <div class="box">
                <p>Move-in Date *</p>
                <input type="date" class="input" name="movein_date" required value="<?php echo $row['movein_date']; ?>">
            </div>
            <div class = "box">
                <p>Listing Date *</p>
                <input type="date" class="input" name="listing_date" required value="<?php echo $row['listing_date']; ?>">
            </div>
            <div class="box">
               <p>Agent Name *</p>
               <select name="A_Id" class="input" required value="<?php echo $row['A_Id']; ?>">
                  <option value="5051">Neelima</option>
                  <option value="5052">Lara</option>
                  <option value="5053">Dhavan</option>
               </select>
            </div>
            <div class="box">
               <p>Description</p>
               <input type="text" name="description" maxlength="500" placeholder="Enter Additional Information" class="input" value="<?php echo $row['description']; ?>">
            </div>
         </div>


        <input type="submit" value="Update" name="update" class="btn">
    </form>
</section>