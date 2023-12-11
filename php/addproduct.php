<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product with Images</title>
</head>
<body>
    <h2>Add Product with Images</h2>
    
    <form action="insert_product.php" method="post">
        <!-- Product Information -->
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <!-- Image Paths -->
        <label for="image_paths">Image Paths (comma-separated):</label>
        <input type="text" id="image_paths" name="image_paths" required><br>

        <!-- Submit Button -->
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
