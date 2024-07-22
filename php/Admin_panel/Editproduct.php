<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
        integrity="sha384-u7U/VuhEEG9byKJb7wceFFcfdsHOnhGGpzDJwVl5qowmqu/6+jFVEeuU9fWOlZ+1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oMqFNp6Ew94ZCDYuxFnFyZQL+I3EmuKl3wZ5f+C7XkhfXTsk70ug/6UElRU5eME6" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyQ9bs0YO6Fh7CBK3IeJW7qDJ9U9C9ApeP" crossorigin="anonymous">
    </script>

    <script>
    // Your JavaScript functions for image preview, category/subcategory update, etc.
    function updateSubcategories() {
        var categoryId = $("#category").val();

        $.ajax({
            url: "getsubcategories.php",
            type: "POST",
            data: {
                categoryId: categoryId
            },
            success: function(data) {
                $("#subcategory").html(data);
            }
        });
    }

    function readMultiURL(input, previewId) {
        if (input.files) {
            var fileCount = input.files.length;
            for (var i = 0; i < fileCount; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
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
            reader.onload = function(e) {
                $('#' + previewId).attr('src', e.target.result);
                $('#' + previewId).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>

    <title>Edit Product</title>
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
                            <h4 class="card-title">Edit Product</h4>
                            <p class="card-description">

                            </p>

                            <?php
                            // Fetch the product details based on the product ID from the URL
                            // You need to modify this part based on your database structure
                            include 'connect.php';

                            $productId = isset($_GET['product_id']) ? $_GET['product_id'] : null;

                            $sql = "SELECT * FROM products WHERE pid = $productId";
                            $result = $connect->query($sql);

                            if ($result->num_rows > 0) {
                                $product = $result->fetch_assoc();
                            } else {
                                echo "Product not found!";
                                exit();
                            }
                            ?>

                            <?php $sqlSubcategories = "SELECT * FROM subcategory WHERE subcatid = " . $product['subcatid'];
                                    $resultSubcategories = $connect->query($sqlSubcategories);
                                    $subcategories = [];
                                    ?>

                            <form enctype="multipart/form-data" action="updateproduct.php" method="post"
                                class="forms-sample">
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">


                                <div class="form-group">
                                    <label for="product_name">Product Name:</label>
                                    <input type="text" class="form-control" id="product_name" name="name"
                                        value="<?php echo $product['name']; ?>" required>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control form-control-" placeholder="Enter description"
                                                id="description" name="description" rows="3"
                                                required><?php echo $product['description']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_name">Weight</label>
                                            <input type="text" class="form-control" id="weight" name="weight"
                                                placeholder="1.0 Kg" value="<?php echo $product['weight']; ?>" required>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name">Products Infomation</label>
                                            <textarea class="form-control form-control-"
                                                placeholder="Enter products infomation" id="product_info"
                                                name="product_info" rows="10"
                                                required><?php echo $product['product_info']; ?></textarea>
                                        </div>

                                    </div>
                                </div>

                                <?php
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
                                                    <option value="">--select category--</option>
                                                    <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category['catid']; ?>"
                                                        <?php echo ($category['catid'] == $product['catid']) ? 'selected' : ''; ?>>
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
                                                <select class="form-control" name="subcategory" id="subcategory">
                                                    <option value="">--select subcategory--</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Price :</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="price" name="price"
                                                        step="0.01" value="<?php echo $product['price']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Qty:</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="qty" name="qty"
                                                        step="0.01" value="<?php echo $product['qty']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Logo_image">Logo image :</label>
                                        <input type="file" class="form-control" id="Logo_image" name="Logo_image"
                                            accept=".jpg, .jpeg, .png" onchange="readURL(this, 'logoImagePreview')">
                                        <img id="logoImagePreview" src="#" alt="Logo Image Preview"
                                            style="max-width: 200px; margin-top: 10px; display: none;">
                                    </div>

                                    <div class="form-group">
                                        <label for="more_image">More images: (add 2 or more images)</label>
                                        <input type="file" class="form-control" id="more_image" name="more_image[]"
                                            accept=".jpg, .jpeg, .png" onchange="readMultiURL(this, 'moreImagePreview')"
                                            multiple>
                                        <div id="moreImagePreview" style="margin-top: 10px;"></div>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-inverse-primary btn-fw">Update
                                        Product</button>
                            </form>

                        </div>
                    </div>
                </div>

                <?php include 'footer.php'; ?>
                <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
                    integrity="sha384-u7U/VuhEEG9byKJb7wceFFcfdsHOnhGGpzDJwVl5qowmqu/6+jFVEeuU9fWOlZ+1"
                    crossorigin="anonymous">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
                    integrity="sha384-oMqFNp6Ew94ZCDYuxFnFyZQL+I3EmuKl3wZ5f+C7XkhfXTsk70ug/6UElRU5eME6"
                    crossorigin="anonymous">
                </script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
                    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyQ9bs0YO6Fh7CBK3IeJW7qDJ9U9C9ApeP"
                    crossorigin="anonymous">
                </script>
</body>

</html>