<?php


// Handle search query
if (isset($_POST['searchquery'])) {
    $search = $_POST['searchquery'];

    $search = "SELECT * FROM products WHERE name LIKE '%$search%'";
    $searchresult = $connect->query($search);

    if ($searchresult->num_rows > 0) {
        while ($searchrow = $searchresult->fetch_assoc()) {
            echo '<p>' . $searchrow['name'] . '</p>';
        }
    } else {
        echo '<p>No results found</p>';
    }
}

$connect->close();
?>