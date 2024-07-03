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
                            <h4 class="font-weight-bold mb-0">]Add Subcategory page </h4>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Subcategory Form -->
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Subcategory</h4>
                            <p class="card-description"></p>
                            <form enctype="multipart/form-data" action="add_subcategory.php" method="post">
                                <div class="form-group">
                                    <label for="category_id">Select Category:</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <!-- Fetch and display categories from the database -->
                                        <?php
                                        $result = mysqli_query($connect, "SELECT * FROM category");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['catid'] . '">' . $row['categoryname'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subcategory_name">Subcategory Name:</label>
                                    <input type="text" class="form-control" id="subcategory_name"
                                        name="subcategory_name" required>
                                </div>

                                <button type="submit" name="submit_subcategory" class="btn btn-primary">Add
                                    Subcategory</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            // Include connection and header files
            include 'connect.php';


            if (isset($_POST['submit_subcategory'])) {
                $categoryId = $_POST['category_id'];
                $subcategoryName = $_POST['subcategory_name'];

                // Insert data into the subcategory table
                $sqlInsertSubcategory = "INSERT INTO subcategory (catid, subcategoryname) VALUES ('$categoryId', '$subcategoryName')";

                if (mysqli_query($connect, $sqlInsertSubcategory)) {
                    // Subcategory insertion successful
                    echo '<script>window.location.href = "add_subcategory.php";</script>';
                    exit();
                } else {
                    echo "Error inserting subcategory data into subcategory table: " . mysqli_error($connect);
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