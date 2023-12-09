<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tempusername = $_POST['email'];
    $temppassword = $_POST['password'];

    if ($tempusername == 'adminsaradhalanka@gmail.com' && $temppassword == 'admin@2023saradhalanka') {
        header('Location:head admin\adminDashboard.php');


    } else {

        $sql = "SELECT * FROM users WHERE (username = '$tempusername' OR email = '$tempusername') AND (password = '$temppassword');";
        $result = mysqli_query($connect, $sql);

        if ($result && $result->num_rows == 1) {
            session_start();
            $user = $result->fetch_assoc();
            $_SESSION['u'] = $user;

            setcookie("username", $tempusername, time() + (60 * 60 * 24 * 365));
            setcookie("password", $temppassword, time() + (60 * 60 * 24 * 365));


            header("Location: userprofile.php");



        } else {
            echo "<script> alert('invalide user name or password')</script>";
        }
    }
}

if (isset($_GET['signup'])) {
    $signupcommand = $_GET['signup'];
    if ($signupcommand === 'Signup') {
        header("Location: Signup.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>




</head>

<body>
    <div class="login-fullframe">
        <div class="login-form">
            <h2>Login</h2>
            <form method="post" action="login.php">
                <div class="plch">
                    <input type="text" name="email" placeholder="Email or Username" required><br><br>
                </div>
                <div class="plch">
                    <input type="password" name="password" placeholder="Password" required><br><br>
                </div>
                <div class="btn1">
                    <input type="submit" name="login" value="Login"><br><br>
                </div>
            </form>
            <form method="get" action="login.php">
                <div class="btn1">
                    <h5>Not Registered?</h5>
                    <input type="submit" name="signup" value="Signup"><br><br>
                </div>
            </form>
        </div>
        <div class="rightside-container">
            <h4>AppPulse</h4>
            <h6>Welcome To World's Biggest App Collection</h6>
        </div>

    </div>

</body>

</html>