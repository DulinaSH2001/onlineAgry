<?php
include 'connect.php';

// Check if categoryId is set in the POST data
if (isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];

    // Fetch subcategories based on the selected category
    $sql = "SELECT * FROM subcategory WHERE catid = $categoryId";
    $result = $connect->query($sql);

    $subcategories = [];
    while ($row = $result->fetch_assoc()) {
        $subcategories[] = $row;
    }

    // Generate HTML options for subcategories
    $htmlOptions = '';
    foreach ($subcategories as $subcategory) {
        $htmlOptions .= "<option value='{$subcategory['subcatid']}'>{$subcategory['subcategoryname']}</option>";
    }

    // Output the HTML options
    echo $htmlOptions;
} else {
    // If categoryId is not set in the POST data, return an empty string
    echo '';
}

// Close the database connection
$connect->close();
?>
