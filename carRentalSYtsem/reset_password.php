<?php
include_once("./connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve customer ID and new password from the form
    $customer_id = $_POST['customer_id'];
    $new_password = $_POST['new_password'];

    // Update the password in the database
    $sql = "UPDATE customer SET cust_password = '$new_password' WHERE id = $customer_id";
    if ($conn->query($sql) === TRUE) {
        header('location:./?page=reset&message=edit');
    } else {
        echo "Error resetting password: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
