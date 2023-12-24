<?php
include 'connect.php';

session_start();
$id = $_SESSION['u']['ID'];

if (isset($_GET['id'])) {
    $appId = $_GET['id'];

    $checkSql = "SELECT * FROM wishlist WHERE appID='$appId' AND UserID='$id'";
    $checkResult = $connect->query($checkSql);
    if ($checkResult->num_rows > 0) {
        echo "Item already exists in the wishlist.";
    } else {
        // Get the details of the app from the apps table
        $appSql = "SELECT * FROM apps WHERE ID='$appId'";
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
}

$connect->close();
?>