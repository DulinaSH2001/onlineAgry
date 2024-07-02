<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
        integrity="sha384-u7U/VuhEEG9byKJb7wceFFcfdsHOnhGGpzDJwVl5qowmqu/6+jFVEeuU9fWOlZ+1" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-MpEV5fZnQ2yYQvGmHGQ+7R9V/Ejq8Jd7fU/8lEHRsnOKG19XT3G1k0sIbjp2uQ5r" crossorigin="anonymous">

    <title>Manage Banners</title>
    <style>
    .banner-image {
        max-width: 100%;
        /* Ensure the image takes the full width of the container */
        height: auto;
        /* Maintain the aspect ratio of the image */
        cursor: pointer;
        /* Add pointer cursor to indicate it is clickable */
    }

    .modal-dialog {
        max-width: 75%;
        /* Set modal width to 75% of the viewport width */
    }
    </style>
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
                            <h4 class="card-title">Manage Banners</h4>
                            <p class="card-description"></p>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Banner Image</th>
                                        <th></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'connect.php';

                                    $sql = "SELECT * FROM banner_images";
                                    $result = mysqli_query($connect, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        $count = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $count++;
                                            echo '<tr>';
                                            echo '<td>'.$count.'</td>';
                                            echo '<td><img src="../img/banner/' . $row['image'] . '" alt="Banner Image" class="banner-image" data-src="../img/banner/' . $row['image'] . '"></td>';
                                            echo '<td></td>';
                                            echo '<td><a href="delete_banner.php?banner_id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this banner?\');" class="btn btn-danger">Delete</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="2">No banners found.</td></tr>';
                                    }

                                    mysqli_close($connect);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
        <!-- Modal -->
        <div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bannerModalLabel">Banner Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" id="modalBannerImage" class="img-fluid" alt="Banner Image">
                    </div>
                </div>
            </div>
        </div>

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
        $(document).ready(function() {
            $('.banner-image').on('click', function() {
                var src = $(this).attr('data-src');
                $('#modalBannerImage').attr('src', src);
                $('#bannerModal').modal('show');
            });

            $('#bannerModal .close').on('click', function() {
                $('#bannerModal').modal('hide');
            });
        });
        </script>

</body>

</html>