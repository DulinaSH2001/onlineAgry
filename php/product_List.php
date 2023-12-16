<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        .product-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .product-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin: 15px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .image-gallery {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            text-decoration: none;
            color: #000;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 0 5px;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <h2>Product Cards</h2>
    <div class="product-cards">
        <?php
        include "connect.php";

        $limit = 6; // Number of products per page
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;

        $sqlProducts = "SELECT * FROM products LIMIT $offset, $limit";
        $resultProducts = mysqli_query($connect, $sqlProducts);

        while ($product = $resultProducts->fetch_assoc()) {
            echo '<div class="product-card">';
            echo '<h3>' . $product['name'] . '</h3>';
            echo '<p>' . $product['description'] . '</p>';
            echo '<p>Price: $' . $product['price'] . '</p>';

            $productId = $product['pid'];
            $sqlImages = "SELECT image FROM products_image WHERE pid = $productId AND prt = 1";
            $resultImages = mysqli_query($connect, $sqlImages);

            echo '<div class="image-gallery">';
            while ($image = $resultImages->fetch_assoc()) {
                echo '<img src="product_images/' . $image['image'] . '" alt="Product Image">';
            }
            echo '</div>';

            // Add more information as needed
            echo '</div>';
        }
        ?>

    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        $sqlCount = "SELECT COUNT(*) AS total FROM products";
        $resultCount = mysqli_query($connect, $sqlCount);
        $rowCount = mysqli_fetch_assoc($resultCount)['total'];
        $totalPages = ceil($rowCount / $limit);

        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $currentPage) ? "active" : "";
            echo '<a class="' . $activeClass . '" href="?page=' . $i . '">' . $i . '</a>';
        }
        ?>
    </div>

</body>

</html>