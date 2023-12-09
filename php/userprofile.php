<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


<?php
    include 'connect.php';
    session_start();

   


    $id = $_SESSION['u']['ID'];

   

    // Fetch the user's information from the database
    $sql = "SELECT * FROM users WHERE ID = '$id'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();

    $fname = $row["FName"];
    $lname = $row["LName"];
    $email = $row["Email"];
    $username = $row["Username"];
    $password = $row["Password"];
    $dob = $row["DOB"];
    $tel = $row["Phonenumber"];
    ?>
    <form action="userprofile" method="post">
        <input type="text" value="" name="Fname">
        <input type="text" value="" name="Lname">
        <input type="text" value="" name="email">
        <input type="text" value="" name="username">
        <input type="text" value="" name="address">
        <input type="text" value="" name="password">
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <button type="reset">Cancel</button>
<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the updated form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $DOB = $_POST['dob'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $tel = $_POST['tel'];

    // Update the user's profile in the database
    $sql = "UPDATE users SET FName = '$firstname', LName = '$lastname', Phonenumber = '$tel', Email = '$email', Password = '$password', Username = '$username', DOB = '$DOB' WHERE ID = '$id'";

    if (mysqli_query($connect, $sql)) {
        header("Location: userprofile.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}?>







    </form>

   



</body>

</html>