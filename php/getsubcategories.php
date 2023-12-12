<?php
include 'connect.php';


if (isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];


    $sql = "SELECT * FROM subcategory WHERE catid = $categoryId";
    $result = $connect->query($sql);

    $subcategories = [];
    while ($row = $result->fetch_assoc()) {
        $subcategories[] = $row;
    }


    $htmlOptions = '';
    foreach ($subcategories as $subcategory) {
        $htmlOptions .= "<option value='{$subcategory['subcatid']}'>{$subcategory['subcategoryname']}</option>";
    }


    echo $htmlOptions;
} else {

    echo '';
}


$connect->close();
?>