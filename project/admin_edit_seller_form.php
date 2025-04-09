<section class="filters" style="padding-bottom: 0;">
    <form action="" method="post">
        <input type="hidden" name="S_Id" value="<?php echo $row['S_Id']; ?>">
        <!-- Add other input fields here with pre-filled data -->
        <!-- ... (existing code) -->
        <div id="close-filter"><i class="fas fa-times"></i></div>
        <h3>Seller</h3>
        <?php if (isset($message)) : ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <div class="flex">
                <div class="box">
                <p>First Name *</p>
                <input type="text" name="First_Name" required maxlength="50" placeholder="Enter First Name" class="input" value="<?php echo $row['First_Name']; ?>">
                </div>
                <div class="box">
                <p>Last Name *</p>
                <input type="text" name="Last_Name" required maxlength="50" placeholder="Enter Last Name" class="input" value="<?php echo $row['Last_Name']; ?>">
                </div>
                <div class="box">
                <p>Email *</p>
                <input type="text" name="Email" required maxlength="50" placeholder="Enter Email" class="input" value="<?php echo $row['Email']; ?>">
                </div>
                <div class="box">
                <p>Phone Number *</p>
                <input type="text" name="Phone_Number" required maxlength="50" placeholder="Enter Phone Number" class="input" value="<?php echo $row['Phone_Number']; ?>">
                </div>
                <div class="box">
                <p>Sale Description</p>
                <input type="text" name="Sale_Description" maxlength="50" placeholder="Enter the Preferences" class="input" value="<?php echo $row['Sale_Description']; ?>">
                </div>
                <div class="box">
                <p>Property ID</p>
                <input type="text" name="P_Id" maxlength="50" placeholder="Enter Property ID" class="input" value="<?php echo $row['P_Id']; ?>">
                </div>
                <div class="box">
                <p>Agent Name *</p>
                <select name="A_Id" class="input" required value="<?php echo $row['A_Id']; ?>">
                    <option value="5051">Neelima</option>
                    <option value="5052">Lara</option>
                    <option value="5053">Dhavan</option>
                </select>
                </div>
            </div>

        <input type="submit" value="Update" name="update" class="btn">
    </form>
</section>