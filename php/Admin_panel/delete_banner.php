<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $bannerId = $_GET['banner_id'];

    // Fetch the banner image name to delete the file from the server
    $sqlFetchImage = "SELECT image FROM banner_images WHERE id = '$bannerId'";
    $result = mysqli_query($connect, $sqlFetchImage);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $bannerImage = $row['image'];
        $bannerImagePath = '../img/banner/' . $bannerImage;

        // Delete the file from the server
        if (file_exists($bannerImagePath)) {
            unlink($bannerImagePath);
        }

        // Delete the record from the database
        $sqlDelete = "DELETE FROM banner_images WHERE id = '$bannerId'";
        if (mysqli_query($connect, $sqlDelete)) {
            echo '<script>alert("Banner deleted successfully!");</script>';
        } else {
            echo '<script>alert("Failed to delete banner!");</script>';
        }
    } else {
        echo '<script>alert("Banner not found!");</script>';
    }
}

mysqli_close($connect);

// Redirect back to the manage_banner.php page
echo '<script>window.location.href = "manage_banner.php";</script>';
exit();
?>