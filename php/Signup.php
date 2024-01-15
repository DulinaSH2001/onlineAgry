<?php
// Include the database connection file
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up </title>
    <link rel="stylesheet" href="../css/styles.css">


</head>

<body>
    <?php include 'header.php'; ?>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="wrapper">



                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="profile-form">
                        <div class="container">
                            <form action="Signup.php" method='post' class="mt-5">
                                <div class="form-group">
                                    <label for="firstname">First name:</label>
                                    <input type="text" class="form-control" name="Fname">
                                </div>
                                <div class="form-group">
                                    <label for="Lastname">Last name:</label>
                                    <input type="text" class="form-control" name="Lname">
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of birth:</label>
                                    <input type="date" class="form-control" name="dob">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="Mobile">Mobile number:</label>
                                    <input type="tel" class="form-control" name="tel">
                                </div>
                                <div class="form-group">
                                    <label for="Username">Username:</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password:</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <button type="submit" class="btn btn-success">Register</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <?php include 'footer.php'; ?>
    <?php


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $user_id = 'us' . substr(uniqid(), 0, 6);
        $firstname = $_POST['Fname'];
        $lastname = $_POST['Lname'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $tel = $_POST['tel'];
        $status = 1;

        // Update the user's profile in the database
        $sql = "INSERT INTO users (userid ,fname, lname,dob, phone, email, password, username,status) VALUES ('$user_id','$firstname', '$lastname','$dob', '$tel', '$email', '$password', '$username','$status')";

        if (mysqli_query($connect, $sql)) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "login.php";';
            echo '</script>';
            exit();
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    } ?>


</body>

</html>