<?php
include 'connect.php';

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Fetch the logo image
    $sqllogo = "SELECT image FROM products_image WHERE pid = ? AND prt = 1";
    $stmtLogo = $connect->prepare($sqllogo);

    if ($stmtLogo === false) {
        die('Error preparing the statement: ' . htmlspecialchars($connect->error));
    }

    $stmtLogo->bind_param("i", $productId);
    $stmtLogo->execute();
    $resultLogo = $stmtLogo->get_result();

    // Fetch other images
    $sqlImages = "SELECT image FROM products_image WHERE pid = ? AND prt = 2";
    $stmtImages = $connect->prepare($sqlImages);

    if ($stmtImages === false) {
        die('Error preparing the statement: ' . htmlspecialchars($connect->error));
    }

    $stmtImages->bind_param("i", $productId);
    $stmtImages->execute();
    $resultImages = $stmtImages->get_result();

    if ($resultLogo->num_rows > 0 || $resultImages->num_rows > 0) {
        echo "<div class='text-center mb-3'>";
        // Display logo image
        if ($resultLogo->num_rows > 0) {
            while ($logo = $resultLogo->fetch_assoc()) {
                echo "<img src='product_images/" . htmlspecialchars($logo['image']) . "' alt='Logo' class='img-fluid' style='max-width: 200px;'>";
            }
        }
        echo "</div>";

        echo "<div class='row'>";
        // Display other images
        if ($resultImages->num_rows > 0) {
            while ($image = $resultImages->fetch_assoc()) {
                $images = explode(",", $image['image']);
                foreach ($images as $imageName) {
                    echo "<div class='col-md-4 mb-3'>";
                    echo "<img src='product_images/" . htmlspecialchars($imageName) . "' alt='Image' class='img-fluid'>";
                    echo "</div>";
                }
            }
        }
        echo "</div>";
    } else {
        echo "No images found for this product.";
    }

    $stmtLogo->close();
    $stmtImages->close();
} else {
    echo 'Product ID not provided.';
}

$connect->close();
?>