<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
    function updateSubcategories() {
        var categoryId = $("#category").val();

        $.ajax({
            url: "getsubcategories.php", //
            type: "POST",
            data: {
                categoryId: categoryId
            },
            success: function(data) {

                $("#subcategory").html(data);
            }
        });
    }
    </script>
    <title>Add Product with Images</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Add Product with Images</h2>

        <form enctype="multipart/form-data" action="addproduct.php" method="post">

            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <?php
            //get categories 
            include 'connect.php';

            $sql = "SELECT * FROM category";
            $result = $connect->query($sql);

            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
            ?>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" name="category" id="category" onchange="updateSubcategories()">
                    <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['catid']; ?>">
                        <?php echo $category['categoryname']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="subcategory">Subcategory:</label>
                <select class="form-control" name="subcategory" id="subcategory" required></select>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="qty">Qty:</label>
                <input type="number" class="form-control" id="qty" name="qty" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="Logo_image">Logo image :</label>
                <input type="file" class="form-control" id="Logo_image" name="Logo_image" accept=".jpg, .jpeg,.png"
                    required>
            </div>

            <div class="form-group">
                <label for="more_image">More images :</label>
                <input type="file" class="form-control" id="more_image" name="more_image[]" accept=".jpg, .jpeg,.png"
                    required multiple>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
        </form>

        <?php

        if (isset($_POST['submit'])) {



            $name = $_POST['name'];
            $description = $_POST['description'];
            $catid = $_POST['category'];
            $subcatid = $_POST['subcategory'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];



            $sql1 = "INSERT INTO products (name, description, catid, subcatid, price, qty) VALUES ('$name', '$description', '$catid', '$subcatid', '$price', '$qty')";



            if (mysqli_query($connect, $sql1)) {
                $pid = mysqli_insert_id($connect);
                $logoImage = $_FILES['Logo_image']['name'];
                $tmpLogoName = $_FILES['Logo_image']['tmp_name'];

                $logoImageExtension = pathinfo($logoImage, PATHINFO_EXTENSION);
                $logoImageExtension = strtolower($logoImageExtension);

                $newLogoName = uniqid() . '.' . $logoImageExtension;
                move_uploaded_file($tmpLogoName, 'product_images/' . $newLogoName);

                $ptry = 1;
                $queryLogo = "INSERT INTO products_image (pid, image, prt) VALUES (?, ?, ?)";
                $stmtLogo = mysqli_prepare($connect, $queryLogo);

                if ($stmtLogo) {
                    mysqli_stmt_bind_param($stmtLogo, 'sss', $pid, $newLogoName, $ptry);
                    if (mysqli_stmt_execute($stmtLogo)) {

                    } else {
                        echo "Error executing prepared statement for logo image: " . mysqli_stmt_error($stmtLogo);
                    }
                    mysqli_stmt_close($stmtLogo);
                } else {
                    echo "Error preparing statement for logo image: " . mysqli_error($connect);
                }

                $totalfile1 = count($_FILES['more_image']['name']);
                $fileArray = array();

                for ($i = 0; $i < $totalfile1; $i++) {
                    $imagename = $_FILES['more_image']['name'][$i];
                    $tmpName = $_FILES['more_image']['tmp_name'][$i];

                    $imageExtension = explode('.', $imagename);
                    $imageExtension = strtolower(end($imageExtension));

                    $newimagename = uniqid() . '.' . $imageExtension;
                    move_uploaded_file($tmpName, 'product_images/' . $newimagename);
                    $fileArray[] = $newimagename;
                }

                $fileArrayStr = implode(",", $fileArray);
                $ptry = 2;
                $query = "INSERT INTO products_image (pid, image, prt) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($connect, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'sss', $pid, $fileArrayStr, $ptry);
                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: product_List.php");
                        exit();
                    } else {
                        echo "Error executing prepared statement: " . mysqli_stmt_error($stmt);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error preparing statement: " . mysqli_error($connect);
                }
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        }

        ?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
        integrity="sha384-u7U/VuhEEG9byKJb7wceFFcfdsHOnhGGpzDJwVl5qowmqu/6+jFVEeuU9fWOlZ+1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oMqFNp6Ew94ZCDYuxFnFyZQL+I3EmuKl3wZ5f+C7XkhfXTsk70ug/6UElRU5eME6" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyQ9bs0YO6Fh7CBK3IeJW7qDJ9U9C9ApeP" crossorigin="anonymous">
    </script>
</body>

</html>