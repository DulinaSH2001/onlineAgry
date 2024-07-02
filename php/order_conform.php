<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <section class="product-details spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6">
                    <?php
                    $conform = $_GET['conform'];
                    $getcartid = $_GET['cartid'];

                    if ($conform) {

                        // Update cart_status to 1
                        $updateQuery = "UPDATE cart SET cart_status = 1 , status ='pending'  WHERE cartid = '$getcartid'";
                        $updateResult = mysqli_query($connect, $updateQuery);
                        if ($updateResult) {
                            echo '
                                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                     Order placed successfully! Thank you for your purchase.
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                     </button>
                                     </div>';
                            echo '<a href="product_List.php" class="btn btn-primary">Go back to the shop</a>';
                        } else {
                            echo "Error updating cart status: " . mysqli_error($connect);
                        }
                    } else {
                        echo "Error executing query: " . mysqli_error($connect);
                    }


                    ?>

                </div>
            </div>
        </div>
    </section>


    <?php include 'footer.php'; ?>

</body>

</html>