<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Sub category table </title>
</head>

<body>
    <?php

    function displaySubcategories($connect)
    {
        $result = mysqli_query($connect, "SELECT sub.subcatid, sub.subcategoryname, sub.catid, cat.categoryname 
                                       FROM subcategory sub 
                                       INNER JOIN category cat ON sub.catid = cat.catid");

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['subcatid'] . '</td>';
            echo '<td>' . $row['subcategoryname'] . '</td>';
            echo '<td>' . $row['categoryname'] . '</td>';
            echo '<td>
                <a href="edit_subcategory.php?id=' . $row['subcatid'] . '" class="btn btn-inverse-warning btn-fw">Edit</a>
                <a href="delete_subcategory.php?id=' . $row['subcatid'] . '" class="btn btn-inverse-danger btn-fw">Delete</a>
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
                            <h4 class="font-weight-bold mb-0">Add Subcategory page </h4>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Display Categories -->
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
                                        <th>Subcategory Name</th>
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php displaySubcategories($connect); ?>
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
<?php
// Include connection and header files