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

    <h2>Address Form</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Street Address</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["addressid"] . "</td>";

                echo "<td>" . $row["street_address"] . "</td>";
                echo "<td>" . $row["town"] . "</td>";

                echo "<td>" . $row["Postcode"] . "</td>";
                echo "<td><a href='select_action.php?addressid=" . $row["addressid"] . "'>Select</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No addresses found</td></tr>";
        }
        ?>
    </table>

    <br>

    <input type="checkbox" name="ship_to_different_address" id="ship_to_different_address"> Ship to a different address?
    <div id="additional_address_fields" style="display: none;">
        <form action="add_address.php" method="post">



            <label for="street_address">Street Address:</label>
            <input type="text" name="street_address" required><br>

            <label for="city">Town / City:</label>
            <input type="text" name="city" required><br>

            <label for="postal_code">Postal Code:</label>
            <input type="text" name="postal_code" required><br>




            <input type="submit" value="add">
        </form>
    </div>
    <script>
    const checkbox = document.getElementById('ship_to_different_address');
    const additionalFieldsDiv = document.getElementById('additional_address_fields');

    checkbox.addEventListener('change', function() {
        additionalFieldsDiv.style.display = checkbox.checked ? 'block' : 'none';
    });
    </script>
    <?php include 'footer.php'; ?>



</body>

</html>