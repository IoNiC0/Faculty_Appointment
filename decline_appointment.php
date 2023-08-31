<?php
include 'db_connect.php'; 
include 'auth.php';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['appointment_id'])) {
    $appointmentId = $_GET['appointment_id'];
    $status = "Declined";

    $updateQuery = "UPDATE appointment SET Status = '$status' WHERE app_id = $appointmentId";
    if (mysqli_query($db_connection, $updateQuery)) {
        echo "Appointment declined successfully.";
        header("Location: admin_app_details.php");
        exit();
    } else {
        echo "Error updating appointment status: " . mysqli_error($db_connection);
    }
} else {
    echo "Invalid request.";
}
?>
