<?php
// Assuming you have already established a database connection
include 'header.php';

if (isset($_GET['addressid'])) {
    $addressId = $_GET['addressid'];

    // Perform validation and security checks if necessary

    // Delete address from the database
    $deleteQuery = "DELETE FROM address WHERE addressid = ?";
    $stmt = $connect->prepare($deleteQuery);
    $stmt->bind_param("i", $addressId);

    if ($stmt->execute()) {
        // Redirect to the addresses.php page after successful deletion
        echo "<script>window.location.href = 'addresses.php';</script>";
        exit();
    } else {
        // Handle error, redirect or display an error message
        echo "Error deleting address: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Handle invalid or missing addressid parameter
    echo "Invalid or missing addressid parameter";
}
include 'footer.php';
?>