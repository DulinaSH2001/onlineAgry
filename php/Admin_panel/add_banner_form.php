<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js">
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#bannerImagePreview').attr('src', e.target.result);
                    $('#bannerImagePreview').show(); // Display the preview image
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <title>Add banner </title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-0">RoyalUI Dashboard</h4>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add banner for index</h4>
                            <p class="card-description"></p>
                            <form enctype="multipart/form-data" action="add_banner_form.php" method="post">
                                <div class="form-group">
                                    <label for="banner_image">Banner Image:</label>
                                    <input type="file" class="form-control" id="banner_image" name="banner_image"
                                        accept=".jpg, .jpeg, .png" onchange="readURL(this);" required>
                                    <img id="bannerImagePreview" src="#" alt="Banner Image Preview"
                                        style="max-width: 200px; margin-top: 10px; display: none;">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Add Banner</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include 'connect.php';

            if (isset($_POST['submit'])) {
                $bannerImage = $_FILES['banner_image']['name'];
                $tmpBannerImage = $_FILES['banner_image']['tmp_name'];

                // Validate file type
                $allowedExtensions = array('jpg', 'jpeg', 'png');
                $bannerImageExtension = pathinfo($bannerImage, PATHINFO_EXTENSION);
                $bannerImageExtension = strtolower($bannerImageExtension);

                if (!in_array($bannerImageExtension, $allowedExtensions)) {
                    echo '<script>alert("Invalid file type. Only JPG, JPEG, and PNG files are allowed.");</script>';
                    exit();
                }

                $newBannerImageName = uniqid() . '.' . $bannerImageExtension;
                move_uploaded_file($tmpBannerImage, '../img/banner/' . $newBannerImageName);

                // Insert data into the banner_images table
                $sqlInsertBannerImage = "INSERT INTO banner_images (image) VALUES ('$newBannerImageName')";
                if (mysqli_query($connect, $sqlInsertBannerImage)) {
                    // Banner image insertion successful
                    echo '<script>alert("Banner image inserted successfully!");</script>';
                    echo '<script>window.location.href = "add_banner_form.php";</script>';
                    exit();
                } else {
                    echo '<script>alert("Failed to insert banner image!");</script>';
                    echo "Error inserting banner image data into banner_images table: " . mysqli_error($connect);
                }
            }

            // Close the database connection
            mysqli_close($connect);
            ?>



        </div>
        <?php include 'footer.php'; ?>
        <!-- Include jQuery, Popper.js, and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
        </script>
</body>

</html>