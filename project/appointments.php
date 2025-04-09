<?php


include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:admin_login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $user_query = mysqli_real_escape_string($conn, $_POST['query']);
    $P_no = mysqli_real_escape_string($conn, $_POST['P_no']);
    $A_Id = mysqli_real_escape_string($conn, $_POST['A_Id']);

    // Check if the selected date is in the past
    $currentDate = date('Y-m-d');
    if ($date < $currentDate) {
        die('Error: Cannot select a past date.');
    }

    // Insert the appointment
    $insert_query = "INSERT INTO `Appointment` (`name`, `email`, `phone_number`, `date`, `time`, `query`, `P_no`, `A_Id`) 
                     VALUES ('$name', '$email', '$phone_number', '$date', '$time', '$user_query', '$P_no', '$A_Id')";

    if (!mysqli_query($conn, $insert_query)) {
        die('Error: ' . mysqli_error($conn));
    } else {
        header('location: admin_appointments.php');
        exit();
    }
}

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:admin_login.php');
    exit();
}
?>


