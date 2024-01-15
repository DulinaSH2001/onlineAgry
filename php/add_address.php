<?php
include 'connect.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_SESSION['u']['userid'];


    $street_address = $_POST["street_address"];
    $city = $_POST["city"];
    $postal_code = $_POST["postal_code"];


    $mainAddressSql = "INSERT INTO address (userid, street_address, town, Postcode)
                       VALUES ($userId,'$street_address', '$city', '$postal_code')";

    if ($connect->query($mainAddressSql) !== TRUE) {
        echo "Error inserting main address: " . $connect->error;
    } else {
        echo '<script>window.location.href = "Addresses.php";</script>';
    }
}
?>