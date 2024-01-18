<?php
include 'connect.php';
if (isset($_POST['submit'])) {
    // Get product details from the form
    $productId = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $catid = $_POST['category'];
    $subcatid = $_POST['subcategory'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    // Update product details in the 'products' table
    $updateProductQuery = "UPDATE products SET name = ?, description = ?, catid = ?, subcatid = ?, price = ?, qty = ? WHERE pid = ?";
    $stmt = mysqli_prepare($connect, $updateProductQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssi', $name, $description, $catid, $subcatid, $price, $qty, $productId);

        if (mysqli_stmt_execute($stmt)) {
            // Update successful

            // Handle logo image update
            if (!empty($_FILES['Logo_image']['name'])) {
                $logoImage = $_FILES['Logo_image']['name'];
                $tmpLogoName = $_FILES['Logo_image']['tmp_name'];

                $logoImageExtension = pathinfo($logoImage, PATHINFO_EXTENSION);
                $logoImageExtension = strtolower($logoImageExtension);

                $newLogoName = uniqid() . '.' . $logoImageExtension;
                move_uploaded_file($tmpLogoName, '../product_images/' . $newLogoName);

                // Update or insert the logo image into the 'products_image' table
                $updateLogoQuery = "INSERT INTO products_image (pid, image, prt) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE image = ?";
                $ptry = 1;
                $stmtLogo = mysqli_prepare($connect, $updateLogoQuery);

                if ($stmtLogo) {
                    mysqli_stmt_bind_param($stmtLogo, 'ssss', $productId, $newLogoName, $ptry, $newLogoName);

                    if (mysqli_stmt_execute($stmtLogo)) {
                        // Logo image update successful
                    } else {
                        echo "Error executing prepared statement for logo image: " . mysqli_stmt_error($stmtLogo);
                    }

                    mysqli_stmt_close($stmtLogo);
                } else {
                    echo "Error preparing statement for logo image: " . mysqli_error($connect);
                }
            }

            // Handle more images update
            if (!empty($_FILES['more_image']['name'][0])) {
                // Process more images similar to the Add Product page
                if (!empty($_FILES['more_image']['name'][0])) {
                    $moreImages = $_FILES['more_image'];
                    $totalFiles = count($moreImages['name']);

                    for ($i = 0; $i < $totalFiles; $i++) {
                        $moreImage = $moreImages['name'][$i];
                        $tmpMoreImage = $moreImages['tmp_name'][$i];

                        $moreImageExtension = pathinfo($moreImage, PATHINFO_EXTENSION);
                        $moreImageExtension = strtolower($moreImageExtension);

                        $newMoreImageName = uniqid() . '.' . $moreImageExtension;
                        move_uploaded_file($tmpMoreImage, '../product_images/' . $newMoreImageName);



                        // Update or insert the more image into the 'products_image' table
                        $updateMoreImageQuery = "INSERT INTO products_image (pid, image, prt) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE image = ?";
                        $ptry = 2;
                        $stmtMoreImage = mysqli_prepare($connect, $updateMoreImageQuery);

                        if ($stmtMoreImage) {
                            mysqli_stmt_bind_param($stmtMoreImage, 'ssss', $productId, $newMoreImageName, $ptry, $newMoreImageName);

                            if (mysqli_stmt_execute($stmtMoreImage)) {
                                // More image update successful
                            } else {
                                echo "Error executing prepared statement for more image: " . mysqli_stmt_error($stmtMoreImage);
                            }

                            mysqli_stmt_close($stmtMoreImage);
                        } else {
                            echo "Error preparing statement for more image: " . mysqli_error($connect);
                        }
                    }
                }

                // You can use the $productId to associate images with the correct product
            }

            echo "<script>alert('Product updated successfully!');</script>";
            echo "<script>window.location.href = 'producttable.php';</script>";
            exit();
        } else {
            echo "Error executing prepared statement: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($connect);
    }
} else {
    // Handle cases where form is not submitted properly
    echo "Form not submitted properly!";
}

// Close the database connection
mysqli_close($connect);
?>