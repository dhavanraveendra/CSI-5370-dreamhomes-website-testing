<?php
function insertAppointment($conn, $postData) {
    $name = mysqli_real_escape_string($conn, $postData['name']);
    $email = mysqli_real_escape_string($conn, $postData['email']);
    $phone_number = mysqli_real_escape_string($conn, $postData['phone_number']);
    $date = mysqli_real_escape_string($conn, $postData['date']);
    $time = mysqli_real_escape_string($conn, $postData['time']);
    $user_query = mysqli_real_escape_string($conn, $postData['query']);
    $P_no = mysqli_real_escape_string($conn, $postData['P_no']);
    $A_Id = mysqli_real_escape_string($conn, $postData['A_Id']);

    // Check if the selected date is in the past
    $currentDate = date('Y-m-d');  // Get current date in 'Y-m-d' format
    if ($date < $currentDate) {
        // Return false or an error message if the date is in the past
        return false; // Or you can customize this error message
    }

    // If the date is valid (not in the past), insert the appointment
    $insert_query = "INSERT INTO `Appointment` (`name`, `email`, `phone_number`, `date`, `time`, `query`, `P_no`, `A_Id`) 
                     VALUES ('$name', '$email', '$phone_number', '$date', '$time', '$user_query', '$P_no', '$A_Id')";

    return mysqli_query($conn, $insert_query);
}
?>