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
                data: { categoryId: categoryId },
                success: function (data) {
                   
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
        <!-- Product Information -->
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
            <!-- Subcategory options will be populated dynamically using AJAX -->
        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="price">Qty:</label>
        <input type="number" id="price" name="qty" step="0.01" required><br>

        <!-- Image Paths -->
        <label for="image_paths">Image Paths (comma-separated):</label>
        <input type="text" id="image_paths" name="image_paths" required><br>

        <!-- Submit Button -->
        <input type="submit" value="Add Product">
    </form>
</body>

</html>