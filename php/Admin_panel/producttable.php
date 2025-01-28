<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Product Table</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-0">Product Table</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="productTable">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Products</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Availability</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'connect.php';

                                        $query = "SELECT * FROM products";
                                        $result = $connect->query($query);

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['pid'] . "</td>";
                                            echo "<td><a href='#' onclick='showImages(" . $row['pid'] . ")'>" . $row['name'] . "</a></td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['qty'] . "</td>";
                                            echo "<td>" . ($row['stock'] == 1 ? 'In Stock' : 'Out of Stock') . "</td>";
                                            echo "<td>";
                                            echo "<a href='Editproduct.php?product_id=" . $row['pid'] . "' class='btn btn-inverse-warning btn-fw'>Edit</a> ";
                                            echo "<button onclick='updateStock(" . $row['pid'] . ")' class='btn btn-inverse-danger btn-fw'>Update Stock</button> ";
                                            echo "<button onclick='toggleStock(" . $row['pid'] . ")' class='btn btn-inverse-success btn-fw'>Toggle Stock</button> ";
                                            echo "<a href='deleteproduct.php?product_id=" . $row['pid'] . "' class='btn btn-danger btn-fw' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }

                                        mysqli_close($connect);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal for Image Slideshow -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Product Images</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="carouselImages">
                                    <!-- Images will be dynamically inserted here -->
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



            <?php include 'footer.php'; ?>

            <!-- ... (previous code) ... -->

            <script>
                // You can use JavaScript functions to handle stock and in-stock/out-stock toggling
                function updateStock(productId) {
                    // Add your logic for updating stock
                    console.log("Updating stock for Product ID: " + productId);

                    // Here, you can make an AJAX request to update the stock in the database
                    $.ajax({
                        type: "POST",
                        url: "updatestock.php", // Create a PHP file to handle the update
                        data: {
                            productId: productId
                        },
                        success: function (response) {
                            console.log(response);
                            $('#productTable').load('producttable.php #productTable');

                        },
                        error: function (error) {
                            console.error(error);
                            // Handle the error if the update fails
                        }
                    });
                }

                function toggleStock(productId) {
                    // Add your logic for toggling in-stock/out-stock status
                    console.log("Toggling stock for Product ID: " + productId);

                    // Here, you can make an AJAX request to toggle the stock status in the database
                    $.ajax({
                        type: "POST",
                        url: "togglestock.php", // Create a PHP file to handle the toggle
                        data: {
                            productId: productId
                        },
                        success: function (response) {
                            console.log(response);
                            location.reload(true);

                        },
                        error: function (error) {
                            console.error(error);
                            // Handle the error if the toggle fails
                        }
                    });
                }

                function showImages(productId) {
                    $.ajax({
                        type: "POST",
                        url: "getProductImages.php",
                        data: {
                            productId: productId
                        },
                        success: function (response) {
                            var images = $(response).find('img');
                            var carouselInner = $('#carouselImages');
                            carouselInner.empty();
                            images.each(function (index, img) {
                                var itemClass = index === 0 ? 'carousel-item active' :
                                    'carousel-item';
                                carouselInner.append(
                                    `<div class="${itemClass}">
                                        ${$(img).prop('outerHTML')}
                                    </div>`
                                );
                            });
                            $('#imageModal').modal('show');
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                }
            </script>




            <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
            </script>
</body>

</html>