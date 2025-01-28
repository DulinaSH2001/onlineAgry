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
                    $('#categoryImagePreview').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <title> All Category </title>
</head>

<body>
    <?php

    function displayCategories($connect)
    {
        $result = mysqli_query($connect, "SELECT * FROM category");
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['catid'] . '</td>';
            echo '<td>' . $row['categoryname'] . '</td>';
            echo '<td>
                <a href="edit_category.php?id=' . $row['catid'] . '" class="btn btn-inverse-warning btn-fw">Edit</a>
                <a href="deletecategory.php?id=' . $row['catid'] . '" class="btn btn-inverse-danger btn-fw">Delete</a>
                <a href="filter_catList_product.php?id=' . $row['catid'] . '" class="btn btn-inverse-primary btn-fw">List Products</a>
              </td>';
            echo '</tr>';
        }
    }

    ?>
    <?php include 'header.php'; ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-0">All Category </h4>
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
                            <h4 class="card-title">Category Table</h4>
                            <p class="card-description"></p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php displayCategories($connect); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php

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