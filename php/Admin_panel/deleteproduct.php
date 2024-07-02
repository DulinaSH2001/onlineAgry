<?php
include 'connect.php';

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Fetch and delete associated images from the server
    $sqlImages = "SELECT image, prt FROM products_image WHERE pid = ?";
    $stmtImages = $connect->prepare($sqlImages);

    if ($stmtImages === false) {
        die('Error preparing the statement: ' . htmlspecialchars($connect->error));
    }

    $stmtImages->bind_param("i", $productId);
    $stmtImages->execute();
    $resultImages = $stmtImages->get_result();

    while ($row = $resultImages->fetch_assoc()) {
        $images = explode(",", $row['image']);
        foreach ($images as $image) {
            $filePath = '../product_images/' . $image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    $stmtImages->close();

    // Delete image records from products_image table
    $sqlDeleteImages = "DELETE FROM products_image WHERE pid = ?";
    $stmtDeleteImages = $connect->prepare($sqlDeleteImages);

    if ($stmtDeleteImages === false) {
        die('Error preparing the statement: ' . htmlspecialchars($connect->error));
    }

    $stmtDeleteImages->bind_param("i", $productId);
    $stmtDeleteImages->execute();
    $stmtDeleteImages->close();

    // Delete the product entry from products table
    $sqlDeleteProduct = "DELETE FROM products WHERE pid = ?";
    $stmtDeleteProduct = $connect->prepare($sqlDeleteProduct);

    if ($stmtDeleteProduct === false) {
        die('Error preparing the statement: ' . htmlspecialchars($connect->error));
    }

    $stmtDeleteProduct->bind_param("i", $productId);
    $stmtDeleteProduct->execute();

    // Check if the delete operation was successful
    if ($stmtDeleteProduct->affected_rows > 0) {
        echo "<script>alert('Product with ID $productId has been deleted successfully.');</script>";
        echo "<script>window.location.href = 'producttable.php';</script>";
        exit();
    } else {
        echo "Failed to delete product with ID $productId.";
    }

    $stmtDeleteProduct->close();
} else {
    echo 'Product ID not provided.';
}

$connect->close();
?>