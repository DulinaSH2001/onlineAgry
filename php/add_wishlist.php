<?php
include 'connect.php';

session_start();
$id = $_SESSION['u']['userid'];

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];


    $checkSql = "SELECT * FROM wishlist WHERE pid='$pid' AND UserID='$id'";
    $checkResult = $connect->query($checkSql);
    if ($checkResult->num_rows > 0) {
        echo "Item already exists in the wishlist.";
    } else {
        // Insert the item into the wishlist
        $insertSql = "INSERT INTO wishlist (userid,pid) VALUES ('$id', '$pid')";
        if ($connect->query($insertSql) === TRUE) {
            echo "Item added to wishlist successfully.";
            header("Location: wishlist.php");
        } else {
            echo "Error adding item to wishlist: " . mysqli_error($connect);
        }
    }
}


$connect->close();
?>