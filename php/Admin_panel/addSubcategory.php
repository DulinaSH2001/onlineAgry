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
                    $('#subcategoryImagePreview').attr('src', e.target.result);
                    $('#subcategoryImagePreview').show(); // Display the preview image
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <title>Add Sub-Category with Logo</title>
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
                            <h4 class="card-title">Add Sub-Category with Logo</h4>
                            <p class="card-description"></p>
                            <form enctype="multipart/form-data" action="addsubcategory.php" method="post">
                                <div class="form-group">
                                    <label for="subcategory_name">Sub-Category Name:</label>
                                    <input type="text" class="form-control" id="subcategory_name"
                                        name="subcategory_name" required>
                                </div>



                                <div class="form-group">
                                    <label for="parent_category">Parent Category:</label>
                                    <select class="form-control" id="parent_category" name="parent_category" required>
                                        <option value="">--Select Parent Category--</option>
                                        <?php
                                        // Fetch categories from the database and populate the dropdown
                                        include 'connect.php';
                                        $result = mysqli_query($connect, "SELECT * FROM category");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row['catid']}'>{$row['categoryname']}</option>";
                                        }
                                        mysqli_close($connect);
                                        ?>
                                    </select>
                                </div>

                                <button type="submit" name="submit" class="btn btn-inverse-primary">Add
                                    Sub-Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include 'connect.php';

            if (isset($_POST['submit'])) {
                $subcategoryName = $_POST['subcategory_name'];
                $parentCategory = $_POST['parent_category'];


                $sqlInsertSubCategory = "INSERT INTO subcategory (subcategoryname, catid) VALUES ('$subcategoryName', '$parentCategory')";

                if (mysqli_query($connect, $sqlInsertSubCategory)) {
                    echo '<script>alert("Sub-Category added successfully!");</script>';
                    echo '<script>window.location.href = "addsubcategory.php";</script>';
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
        <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
        </script>
</body>

</html>