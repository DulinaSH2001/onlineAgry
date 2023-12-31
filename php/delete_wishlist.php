<?php
include 'connect.php';

session_start();
$id = $_SESSION['u']['userid'];

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    // Check if the item exists in the wishlist
    $checkSql = "SELECT * FROM wishlist WHERE pid='$pid' AND UserID='$id'";
    $checkResult = $connect->query($checkSql);
    if ($checkResult->num_rows > 0) {
        //deletesql 
        $deleteSql = "DELETE FROM wishlist WHERE pid='$pid' AND UserID='$id'";
        if ($connect->query($deleteSql) === TRUE) {
            echo "Item removed from wishlist successfully."; // add alaet 
            header("Location: wishlist.php");
        } else {
            echo "Error removing item from wishlist: " . mysqli_error($connect);
        }
    } else {
        echo "Item does not exist in the wishlist."; //add script alert 
    }
}

$connect->close();
?>