<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill information</title>
    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    .wrapper {
        display: flex;
        height: 100%;
    }

    .sidebar {
        width: 250px;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .wrapper {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    body,
    html {
        height: 100%;
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    .wrapper {
        display: flex;
        height: 100%;
    }

    .sidebar {
        width: 250px;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    /* Responsive styles */
    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        .content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }

    /* Additional modifications for smaller screens */
    @media screen and (max-width: 320px) {
        .sidebar {
            padding: 10px;
        }

        .content {
            padding: 10px;
        }
    }

    /* Additional modifications for larger screens */
    @media screen and (min-width: 1200px) {
        .sidebar {
            width: 300px;
        }
    }
    </style>
</head>

<body>
    <?php
    // Assuming you have already established a database connection
    include 'header.php';



    $userId = $_SESSION['u']['userid'];

    $sql = "SELECT * FROM address WHERE userid = $userId";
    $result = $connect->query($sql);
    ?>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="wrapper">
                        <nav class="sidebar">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                            </button>

                            <div class="collapse" id="sidebarCollapse">
                                <div class="list-group">
                                    <a href="userprofile.php" class="list-group-item list-group-item-action">My
                                        profile</a>
                                    <a href="my_orders.php" class="list-group-item list-group-item-action">My Orders</a>
                                    <a href="addresses.php" class="list-group-item list-group-item-action">Addresses</a>
                                    <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Street Address</th>
                                <th>City</th>
                                <th>Postal Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["addressid"] . "</td>";

                                    echo "<td>" . $row["street_address"] . "</td>";
                                    echo "<td>" . $row["town"] . "</td>";

                                    echo "<td>" . $row["Postcode"] . "</td>";
                                    echo '<td><a href="delete_address.php?addressid=' . $row["addressid"] . '" class="btn btn-outline-danger btn-md"> <i class="fa fa-trash"></i> Delete
                                    </a></td>';

                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No addresses found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ship_to_different_address"
                            id="ship_to_different_address">
                        <label class="form-check-label" for="ship_to_different_address">Ship to a different
                            address?</label>
                    </div>
                    <div id="additional_address_fields" style="display: none;">
                        <form action="add_address.php" method="post">
                            <div class="form-group">
                                <label for="street_address">Street Address:</label>
                                <input type="text" class="form-control" name="street_address" required>
                            </div>

                            <div class="form-group">
                                <label for="city">Town / City:</label>
                                <input type="text" class="form-control" name="city" required>
                            </div>

                            <div class="form-group">
                                <label for="postal_code">Postal Code:</label>
                                <input type="text" class="form-control" name="postal_code" required>
                            </div>

                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    </div>

                    <script>
                    const checkbox = document.getElementById('ship_to_different_address');
                    const additionalFieldsDiv = document.getElementById('additional_address_fields');

                    checkbox.addEventListener('change', function() {
                        additionalFieldsDiv.style.display = checkbox.checked ? 'block' : 'none';
                    });
                    </script>

                </div>
            </div>
        </div>
    </section>



    <?php include 'footer.php'; ?>



</body>

</html>