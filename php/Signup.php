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
    <form action="Signup.php" method ='post'>
        <label for="firstname">First name:</label>
        <input type="text" name="Fname"></br>

        <label for="Lastname">Last name:</label>
        <input type="text" name="Lname"></br>

        <label for="dob">Date of birth:</label>
        <input type="date" name="dob"></br>

        <label for="email">Email:</label>
        <input type="text" name="email"></br>

        <label for="Mobile">Mobile number :</label>
        <input type="tel" name="tel"></br>

        <label for="Username">Username:</label>
        <input type="text" name="username"></br>

        <label for="Password">Password :</label>
        <input type="text" name="password"></br>
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

        // Update the user's profile in the database
        $sql = "INSERT INTO users (userid ,fname, lname,dob, phone, email, password, username) VALUES ('$user_id','$firstname', '$lastname','$dob', '$tel', '$email', '$password', '$username')";

        if (mysqli_query($connect, $sql)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    } ?>


</body>

</html>