<section class="filters" style="padding-bottom: 0;">
    <form action="" method="post">
        <input type="hidden" name="T_ID" value="<?php echo $row['T_ID']; ?>">
        <!-- Add other input fields here with pre-filled data -->
        <!-- ... (existing code) -->
        <div id="close-filter"><i class="fas fa-times"></i></div>
        <h3>Transaction</h3>
        <?php if (isset($message)) : ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <div class="flex">

            <div class="box">
                <p>Agent Email</p>
                <input type="text" name="agent_email" required maxlength="50" placeholder="Agent Email" class="input" value="<?php echo $row['A_Id']; ?>">
                </div>
                <div class="box">
                <p>Buyer Email</p>
                <input type="text" name="buyer_email" required maxlength="50" placeholder="Buyer Email" class="input" value="<?php echo $row['B_Id']; ?>">
                </div>

                <div class="box">
                <p>Seller Email</p>
                <input type="text" name="seller_email" required maxlength="50" placeholder="Seller Email" class="input" value="<?php echo $row['S_Id']; ?>">
                </div>

                <div class="box">
                <p>Transaction Amount</p>
                <input type="number" name="t_amount" required placeholder="Enter Amount" class="input" value="<?php echo $row['t_amount']; ?>">

                </div>

                <div class="box">
                <p>Transaction Date *</p>
                <input type="date" name="t_date" required maxlength="50" placeholder="Transaction Date" class="input" value="<?php echo $row['t_date']; ?>">
                </div>

                <div class="box">
                <p>Transaction Type</p>
                <select name="t_type" class="input" required value="<?php echo $row['t_type']; ?>">
                    <option value="select">Select</option>
                    <option value="Card">Card</option>
                    <option value="Check">Check</option>
                    <option value="Cash">Cash</option>
                </select>
                </div>
            </div>

        <input type="submit" value="Update" name="update" class="btn">
    </form>
</section>
