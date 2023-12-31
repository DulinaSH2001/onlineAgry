<?php
include 'connect.php';

session_start();
$id = $_SESSION['u']['userid'];

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $qty = $_GET['qty'];


    // Get the details of the app from the apps table
    $cartSql = "SELECT * FROM apps WHERE ID='$appId'";
    $appResult = $connect->query($appSql);
    if ($appResult->num_rows > 0) {
        $appRow = $appResult->fetch_assoc();

        $appName = $appRow['Name'];
        $appLogo = base64_encode($appRow['Logo']);

        // Insert the item into the wishlist
        $insertSql = "INSERT INTO wishlist (UserID, appID, Appname, image) VALUES ('$id', '$appId', '$appName', '$appLogo')";
        if ($connect->query($insertSql) === TRUE) {
            echo "Item added to wishlist successfully.";
            header("Location:Wishlist.php");
        } else {
            echo "Error adding item to wishlist: " . mysqli_error($connect);
        }
    } else {
        echo "App not found.";
    }

}

$connect->close();
?>