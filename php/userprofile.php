<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user profile</title>
</head>

<body>


    <?php
    include 'connect.php';
    include 'header1.php';
    session_start();




    $id = $_SESSION['u']['userid'];



    // Fetch the user's information from the database
    $sql = "SELECT * FROM users WHERE userid = '$id'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();

    $fname = $row["fname"];
    $lname = $row["lname"];
    $email = $row["email"];
    $username = $row["username"];
    $password = $row["password"];
    $dob = $row["DOB"];
    $tel = $row["phone"];
    ?>
    <form action="userprofile.php" method="post">
        <label for="firstname">First name:</label>
        <input type="text" value="<?php echo $fname ?>" name="Fname"></br>

        <label for="Lastname">Last name:</label>
        <input type="text" value="<?php echo $lname ?>" name="Lname"></br>

        <label for="dob">Date of birth:</label>
        <input type="date" value="<?php echo $dob ?>" name="dob"></br>

        <label for="email">Email:</label>
        <input type="text" value="<?php echo $email ?>" name="email"></br>

        <label for="Mobile">Mobile number :</label>
        <input type="tel" value="<?php echo $tel ?>" name="tel"></br>

        <label for="Username">Username:</label>
        <input type="text" value="<?php echo $username ?>" name="username"></br>

        <label for="Password">Password :</label>
        <input type="text" value="<?php echo $password ?>" name="password"></br>
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <button type="reset">Cancel</button>
        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve and sanitize the updated form data
            $firstname = $_POST['Fname'];
            $lastname = $_POST['Lname'];
            $email = $_POST['email'];
            $dob = $_POST['dob'];

            $username = $_POST['username'];
            $password = $_POST['password'];
            $tel = $_POST['tel'];

            // Update the user's profile in the database
            $sql = "UPDATE users SET fname = '$firstname', lname = '$lastname', phone = '$tel', email = '$email', password = '$password',dob = '$dob', username = '$username' WHERE userid = '$id'";

            if (mysqli_query($connect, $sql)) {
                header("Location: userprofile.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        } ?>







    </form>





</body>

</html>