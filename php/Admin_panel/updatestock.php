<?php
// Include the database connection file
include 'connect.php';

// Check if productId is set in the POST request
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Fetch the current quantity from the database
    $query = "SELECT qty FROM products WHERE pid = '$productId'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentQty = $row['qty'];

        // Increase the quantity by 10
        $newQty = $currentQty + 10;

        // Update the quantity in the database
        $updateQuery = "UPDATE products SET qty = '$newQty' WHERE pid = '$productId'";
        if ($connect->query($updateQuery) === TRUE) {

            echo "<script>alert('Quantity updated successfully!');</script>"; // Display JavaScript alert
            echo "<script>window.location.href = 'producttable.php';</script>";
        } else {
            echo "Error updating quantity: " . $connect->error;
        }
    } else {
        echo "Product not found!";
    }
} else {
    echo "Invalid request!";
}

// Close the database connection
$connect->close();
?>