<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
    </script>

    <script>
        function updateSubcategories() {
            var categoryId = $("#category").val();

            $.ajax({
                url: "getsubcategories.php",
                type: "POST",
                data: {
                    categoryId: categoryId
                },
                success: function (data) {
                    $("#subcategory").html(data);
                }
            });
        }

        function readMultiURL(input, previewId) {
            if (input.files) {
                var fileCount = input.files.length;
                for (var i = 0; i < fileCount; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#' + previewId).append('<img src="' + e.target.result +
                            '" style="max-width: 200px; margin-top: 10px;">');
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        function readURL(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + previewId).attr('src', e.target.result);
                    $('#' + previewId).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <title>Add Product with Images</title>
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
                    <div class="card rounded">
                        <div class="card-body">
                            <h4 class="card-title">Add Product with Images</h4>
                            <p class="card-description">

                            </p>



                            <form enctype="multipart/form-data" action="addproduct.php" method="post"
                                class="forms-sample">

                                <div class="form-group">
                                    <label for="product_name">Product Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter product name "
                                        id="product_name" name="name" required>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control form-control-" placeholder="Enter description"
                                                id="description" name="description" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_name">Weight(Kg)</label>
                                            <input type="text" class="form-control" id="weight" name="weight"
                                                placeholder="1.0 Kg" required>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name">Products Infomation</label>
                                            <textarea class="form-control form-control-"
                                                placeholder="Enter products infomation" id="product_info"
                                                name="product_info" rows="10" required></textarea>
                                        </div>

                                    </div>
                                </div>

                                <?php
                                //get categories 
                                include 'connect.php';

                                $sql = "SELECT * FROM category";
                                $result = $connect->query($sql);

                                $categories = [];
                                while ($row = $result->fetch_assoc()) {
                                    $categories[] = $row;
                                }
                                ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control" name="category" id="category"
                                                    onchange="updateSubcategories()">
                                                    <option>--select category--</option>
                                                    <?php foreach ($categories as $category): ?>

                                                        <option value="<?php echo $category['catid']; ?>">
                                                            <?php echo $category['categoryname']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">SubCategory</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="subcategory" id="subcategory"
                                                    required>
                                                    <option class="form-control">--select subcategory--</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Price :</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="price" name="price"
                                                    step="0.01" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Qty:</label>
                                            <div class="col-sm-9">

                                                <input type="number" class="form-control" id="qty" name="qty"
                                                    step="0.01" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Logo_image">Logo image :</label>
                                    <input type="file" class="form-control" id="Logo_image" name="Logo_image"
                                        accept=".jpg, .jpeg, .png" onchange="readURL(this, 'logoImagePreview')"
                                        required>
                                    <img id="logoImagePreview" src="#" alt="Logo Image Preview"
                                        style="max-width: 200px; margin-top: 10px; display: none;">
                                </div>

                                <div class="form-group">
                                    <label for="more_image">More images: (add 2 or more images)</label>
                                    <input type="file" class="form-control" id="more_image" name="more_image[]"
                                        accept=".jpg, .jpeg, .png" onchange="readMultiURL(this, 'moreImagePreview')"
                                        required multiple>
                                    <div id="moreImagePreview" style="margin-top: 10px;"></div>

                                </div>

                                <button type="submit" name="submit" class="btn btn-primary">Add
                                    Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php

            if (isset($_POST['submit'])) {



                $name = $_POST['name'];
                $description = $_POST['description'];
                $catid = $_POST['category'];
                $subcatid = $_POST['subcategory'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $weight = $_POST['weight'];
                $product_info = $_POST['product_info'];




                $sql1 = "INSERT INTO products (name, description, catid, subcatid, price, qty ,weight,product_info) VALUES ('$name', '$description', '$catid', '$subcatid', '$price', '$qty', '$weight', '$product_info')";



                if (mysqli_query($connect, $sql1)) {
                    $pid = mysqli_insert_id($connect);
                    $logoImage = $_FILES['Logo_image']['name'];
                    $tmpLogoName = $_FILES['Logo_image']['tmp_name'];

                    $logoImageExtension = pathinfo($logoImage, PATHINFO_EXTENSION);
                    $logoImageExtension = strtolower($logoImageExtension);

                    $newLogoName = uniqid() . '.' . $logoImageExtension;
                    move_uploaded_file($tmpLogoName, '../product_images/' . $newLogoName);

                    $ptry = 1;
                    $queryLogo = "INSERT INTO products_image (pid, image, prt) VALUES (?, ?, ?)";
                    $stmtLogo = mysqli_prepare($connect, $queryLogo);

                    if ($stmtLogo) {
                        mysqli_stmt_bind_param($stmtLogo, 'sss', $pid, $newLogoName, $ptry);
                        if (mysqli_stmt_execute($stmtLogo)) {

                        } else {
                            echo "Error executing prepared statement for logo image: " . mysqli_stmt_error($stmtLogo);
                        }
                        mysqli_stmt_close($stmtLogo);
                    } else {
                        echo "Error preparing statement for logo image: " . mysqli_error($connect);
                    }

                    $totalfile1 = count($_FILES['more_image']['name']);
                    $fileArray = array();

                    for ($i = 0; $i < $totalfile1; $i++) {
                        $imagename = $_FILES['more_image']['name'][$i];
                        $tmpName = $_FILES['more_image']['tmp_name'][$i];

                        $imageExtension = explode('.', $imagename);
                        $imageExtension = strtolower(end($imageExtension));

                        $newimagename = uniqid() . '.' . $imageExtension;
                        $imageDestination = '../product_images/' . $newimagename;

                        move_uploaded_file($tmpName, $imageDestination);
                        $fileArray[] = $newimagename;

                    }

                    $fileArrayStr = implode(",", $fileArray);
                    $ptry = 2;
                    $query = "INSERT INTO products_image (pid, image, prt) VALUES (?, ?, ?)";
                    $stmt = mysqli_prepare($connect, $query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'sss', $pid, $fileArrayStr, $ptry);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('Product added successfully!');</script>";
                            echo "<script>window.location.href = 'addproduct.php';</script>";
                            exit();
                        } else {
                            echo "Error executing prepared statement: " . mysqli_stmt_error($stmt);
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error preparing statement: " . mysqli_error($connect);
                    }
                } else {
                    echo "Error: " . mysqli_error($connect);
                }
            }

            ?>
        </div>
        <?php include 'footer.php'; ?>

</body>

</html>