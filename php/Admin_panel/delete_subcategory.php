<?php
include 'connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $subcategoryId = $_GET['id'];


    $result = mysqli_query($connect, "SELECT * FROM subcategory WHERE subcatid = '$subcategoryId'");

    if (mysqli_num_rows($result) > 0) {

        $productResult = mysqli_query($connect, "SELECT * FROM products WHERE subcategoryid = '$subcategoryId'");

        if (mysqli_num_rows($productResult) > 0) {

            echo '<script>alert("Cannot delete subcategory. There are products associated with it. Remove the products first.");';
            echo 'window.location.href = "subcategory_table.php";</script>';
            exit();
        } else {

            $sqlDeleteSubcategory = "DELETE FROM subcategory WHERE id = '$subcategoryId'";

            if (mysqli_query($connect, $sqlDeleteSubcategory)) {

                header("Location: subcategory_table.php");
                exit();
            } else {
                echo "Error deleting subcategory: " . mysqli_error($connect);
            }
        }
    } else {
        echo "Subcategory not found.";
    }
} else {
    echo "Invalid subcategory ID.";
}

mysqli_close($connect);

?>