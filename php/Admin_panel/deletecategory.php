<?php
include 'connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Check if the category has any associated products
    $sqlCheckProducts = "SELECT COUNT(*) as product_count FROM products WHERE catid = '$categoryId'";
    $resultCheckProducts = mysqli_query($connect, $sqlCheckProducts);
    if (!$resultCheckProducts) {
        die('Error checking products: ' . mysqli_error($connect));
    }
    $rowCheckProducts = mysqli_fetch_assoc($resultCheckProducts);

    if ($rowCheckProducts['product_count'] > 0) {
        echo '<script>alert("Cannot delete category. There are products associated with it. Remove the products first.");';
        echo 'window.location.href = "category_table.php";</script>';
        exit();
    }

    // Check if the category has any associated subcategories
    $sqlCheckSubcategories = "SELECT COUNT(*) as subcategory_count FROM subcategory WHERE catid = '$categoryId'";
    $resultCheckSubcategories = mysqli_query($connect, $sqlCheckSubcategories);
    if (!$resultCheckSubcategories) {
        die('Error checking subcategories: ' . mysqli_error($connect));
    }
    $rowCheckSubcategories = mysqli_fetch_assoc($resultCheckSubcategories);

    if ($rowCheckSubcategories['subcategory_count'] > 0) {
        echo '<script>alert("Cannot delete category. There are subcategories associated with it. Remove the subcategories first.");';
        echo 'window.location.href = "category_table.php";</script>';
        exit();
    }

    // Fetch the image filename from the database
    $sqlFetchImage = "SELECT image FROM cat_images WHERE catid = '$categoryId'";
    $resultFetchImage = mysqli_query($connect, $sqlFetchImage);
    if (!$resultFetchImage) {
        die('Error fetching image: ' . mysqli_error($connect));
    }

    if (mysqli_num_rows($resultFetchImage) > 0) {
        $row = mysqli_fetch_assoc($resultFetchImage);
        $imageFilename = $row['image'];

        // Delete the image file from the server
        $imageFilePath = 'category_images/' . $imageFilename;
        if (file_exists($imageFilePath)) {
            unlink($imageFilePath);
        }

        // Delete the image record from the database
        $sqlDeleteImage = "DELETE FROM cat_images WHERE catid = '$categoryId'";
        if (!mysqli_query($connect, $sqlDeleteImage)) {
            die('Error deleting image record: ' . mysqli_error($connect));
        }

        // Delete the category from the database
        $sqlDeleteCategory = "DELETE FROM category WHERE catid = '$categoryId'";
        if (!mysqli_query($connect, $sqlDeleteCategory)) {
            die('Error deleting category: ' . mysqli_error($connect));
        }

        // Check if the delete operation was successful
        if (mysqli_affected_rows($connect) > 0) {
            echo '<script>alert("Category deleted successfully.");';
            echo 'window.location.href = "category_table.php";</script>';
            exit();
        } else {
            echo "Failed to delete category with ID $categoryId.";
        }
    } else {
        echo "Image not found for category ID $categoryId.";
    }
} else {
    echo "Invalid category ID.";
}

mysqli_close($connect);
?>