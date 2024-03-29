<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill information</title>
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
                                    echo '<td><a href="Add_order.php?addressid=' . $row["addressid"] . '" class="btn btn-outline-success btn-md" <i class="bi bi-check2"></i> Select
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
                        <form action="create_Address.php" method="post">
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