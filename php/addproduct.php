<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <h2>Add Product with Images</h2>

    <form enctype="multipart/form-data" action="addproduct.php" method="post">

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="name" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

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

        <label for="category">Category:</label>
        <select name="category" id="category" onchange="updateSubcategories()">
            //ajex using to get sub catogery
            <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['catid']; ?>">
                <?php echo $category['categoryname']; ?>
            </option>
            <?php endforeach; ?>
        </select>

        <label for="subcategory">Subcategory:</label>
        <select name="subcategory" id="subcategory" required>

        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="price">Qty:</label>
        <input type="number" id="qty" name="qty" step="0.01" required><br>

        <label for="Logo_image">Logo image :</label>
        <input type="file" id="Logo_image" name="Logo_image" accept=".jpg, .jpeg,.png" required><br>


        <label for="more_image">more image :</label>
        <input type="file" id="more_image" name="more_image[]" accept=".jpg, .jpeg,.png" required multiple><br>




        <input type="submit" name="submit" value="Add Product">
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
</body>

</html>