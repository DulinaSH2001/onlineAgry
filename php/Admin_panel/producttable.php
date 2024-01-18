<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyQ9bs0YO6Fh7CBK3IeJW7qDJ9U9C9ApeP" crossorigin="anonymous">
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
                                            echo "<td>" . $row['name'] . "</td>";

                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['qty'] . "</td>";
                                            if ($row['stock'] == 1) {
                                                echo "<td> In Stock</td>";

                                            } elseif ($row['stock'] == 0) {

                                                echo "<td> out of stock</td>";
                                            }



                                            echo "<td>";
                                            echo "<a href='Editproduct.php?product_id=" . $row['pid'] . "' class='btn btn-inverse-warning btn-fw'>Edit</a> ";
                                            echo "<button onclick='updateStock(" . $row['pid'] . ")' class='btn btn-inverse-danger btn-fw'>Update Stock</button> ";
                                            echo "<button onclick='toggleStock(" . $row['pid'] . ")' class='btn btn-inverse-success btn-fw'>Toggle Stock</button>";
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
                        success: function(response) {
                            console.log(response);
                            $('#productTable').load('producttable.php #productTable');

                        },
                        error: function(error) {
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
                        success: function(response) {
                            console.log(response);
                            location.reload(true);

                        },
                        error: function(error) {
                            console.error(error);
                            // Handle the error if the toggle fails
                        }
                    });
                }
                </script>




                <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
                    integrity="sha384-u7U/VuhEEG9byKJb7wceFFcfdsHOnhGGpzDJwVl5qowmqu/6+jFVEeuU9fWOlZ+1"
                    crossorigin="anonymous">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
                    integrity="sha384-oMqFNp6Ew94ZCDYuxFnFyZQL+I3EmuKl3wZ5f+C7XkhfXTsk70ug/6UElRU5eME6"
                    crossorigin="anonymous">
                </script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
                    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyQ9bs0YO6Fh7CBK3IeJW7qDJ9U9C9ApeP"
                    crossorigin="anonymous">
                </script>
</body>

</html>