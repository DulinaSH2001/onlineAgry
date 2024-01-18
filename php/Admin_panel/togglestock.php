<?php
// Include the database connection file
include 'connect.php';

// Check if productId is set in the POST request
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Fetch the current stock status from the database
    $query = "SELECT stock FROM products WHERE pid = '$productId'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentStock = $row['stock'];

        // Toggle the stock status (1 to 0, 0 to 1)
        $newStock = ($currentStock == 1) ? 0 : 1;

        // Update the stock status in the database
        $updateQuery = "UPDATE products SET stock = '$newStock' WHERE pid = '$productId'";
        if ($connect->query($updateQuery) === TRUE) {

            echo "<script>window.location.href = 'producttable.php';</script>";
        } else {
            echo "Error updating stock status: " . $connect->error;
        }
    } else {
        echo "Product not found!";
    }
} else {
    echo "Invalid request!";
}

// Close the database connection
?>