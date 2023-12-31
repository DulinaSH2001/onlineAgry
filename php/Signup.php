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
    <title>Add Products</title>
    <link rel="stylesheet" href="../css/styles.css">


</head>

<body>
    <form action="Signup.php" method='post'>
        <div class="form-group">
            <label for="firstname">First name:</label>
            <input type="text" class="form-control" name="Fname"></br>
        </div>
        <div class="form-group"> <label for="Lastname">Last name:</label>
            <input type="text" class="form-control" name="Lname"></br>
        </div>
        <div class="form-group"> <label for="dob">Date of birth:</label>
            <input type="date" class="form-control" ?name="dob"></br>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email"></br>
        </div>
        <div class="form-group">
            <label for="Mobile">Mobile number :</label>
            <input type="tel" class="form-control" name="tel"></br>
        </div>
        <div class="form-group">
            <label for="Username">Username:</label>
            <input type="text" class="form-control" name="username"></br>
        </div>


        <div class="form-group"> <label for="Password">Password :</label>
            <input type="text" class="form-control" name="password"></br>
        </div>


        <button type="submit" class="btn btn-primary">Register</button>
        <button type="reset">Reset</button>
    </form>
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
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    } ?>


</body>

</html>