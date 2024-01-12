<?php
// Assuming you have already established a database connection
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from the form
    $streetAddress = $_POST['street_address'];
    $city = $_POST['city'];
    $postalCode = $_POST['postal_code'];
    $userId = $_SESSION['u']['userid'];

    // Perform validation and security checks if necessary

    // Insert new address into the database
    $insertQuery = "INSERT INTO address (userid, street_address, town, Postcode) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($insertQuery);
    $stmt->bind_param("isss", $userId, $streetAddress, $city, $postalCode);

    if ($stmt->execute()) {
        // Redirect to the addresses.php page after successful insertion
        echo "<script>window.location.href = 'addresses.php';</script>";
        exit();
    } else {
        // Handle error, redirect or display an error message
        echo "Error adding address: " . $stmt->error;
    }

    include 'footer.php';
}
?>