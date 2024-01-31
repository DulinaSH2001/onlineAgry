<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#categoryImagePreview').attr('src', e.target.result);
                    $('#categoryImagePreview').show(); // Display the preview image
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <title>Add Category with Logo</title>
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
                            <h4 class="card-title">Add Category with Logo</h4>
                            <p class="card-description"></p>
                            <form enctype="multipart/form-data" action="addcategory.php" method="post">
                                <div class="form-group">
                                    <label for="category_name">Category Name:</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="category_logo">Category Logo:</label>
                                    <input type="file" class="form-control" id="category_logo" name="category_logo"
                                        accept=".jpg, .jpeg, .png" onchange="readURL(this);" required>
                                    <img id="categoryImagePreview" src="#" alt="Category Logo Preview"
                                        style="max-width: 200px; margin-top: 10px; display: none;">
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include 'connect.php';

            if (isset($_POST['submit'])) {
                $categoryName = $_POST['category_name'];


                // Insert data into the category table
                $sqlInsertCategory = "INSERT INTO category (categoryname) VALUES ('$categoryName')";
                if (mysqli_query($connect, $sqlInsertCategory)) {
                    $categoryId = mysqli_insert_id($connect);

                    // Handle category logo image upload
                    $categoryLogo = $_FILES['category_logo']['name'];
                    $tmpCategoryLogo = $_FILES['category_logo']['tmp_name'];

                    $categoryLogoExtension = pathinfo($categoryLogo, PATHINFO_EXTENSION);
                    $categoryLogoExtension = strtolower($categoryLogoExtension);

                    $newCategoryLogoName = uniqid() . '.' . $categoryLogoExtension;
                    move_uploaded_file($tmpCategoryLogo, 'category_images/' . $newCategoryLogoName);

                    // Insert data into the cat_image table
                    $sqlInsertImage = "INSERT INTO cat_images (catid, image) VALUES ('$categoryId', '$newCategoryLogoName')";
                    if (mysqli_query($connect, $sqlInsertImage)) {
                        // Image insertion successful
                        echo '<script>window.location.href = "addcategory.php";</script>';
                        exit();
                    } else {
                        echo "Error inserting image data into cat_image table: " . mysqli_error($connect);
                    }
                } else {
                    echo "Error inserting category data into category table: " . mysqli_error($connect);
                }
            }

            // Close the database connection
            mysqli_close($connect);
            ?>


        </div>
        <?php include 'footer.php'; ?>
        <!-- Include jQuery, Popper.js, and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
            integrity="sha384-u7U/VuhEEG9byKJb7wceFFcfdsHOnhGGpzDJwVl5qowmqu/6+jFVEeuU9fWOlZ+1" crossorigin="anonymous">
            </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oMqFNp6Ew94ZCDYuxFnFyZQL+I3EmuKl3wZ5f+C7XkhfXTsk70ug/6UElRU5eME6" crossorigin="anonymous">
            </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyQ9bs0YO6Fh7CBK3IeJW7qDJ9U9C9ApeP" crossorigin="anonymous">
            </script>
</body>

</html>