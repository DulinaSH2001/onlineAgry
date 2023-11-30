<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tempusername = $_POST['email'];
    $temppassword = $_POST['password'];

    if ($tempusername === 'apppluseadmin665@gmail.com' && $temppassword === 'admin@2023app') {
        header('Location:head admin\adminDashboard.php');
        

    } else if ($tempusername === 'appplusesecurity665@gmail.com' && $temppassword === 'security@2023app') {
        header('Location:Security admin\securityadminDashboard.php');
       


    } else if ($tempusername === 'appplusepayment665@gmail.com' && $temppassword === 'payment@2023app') {
        header('Location:Payment Admin\paymentadminDashboard.php');
        

    } else {

        $sql = "SELECT * FROM users WHERE (Username = '$tempusername' OR Email = '$tempusername') AND (Password = '$temppassword');";
        $result = mysqli_query($connect, $sql);

        if ($result && $result->num_rows === 1) {
            session_start();
            $d = $result->fetch_assoc();
            $_SESSION['u'] = $d;

            setcookie("username", $tempusername, time() + (60 * 60 * 24 * 365));
            setcookie("password", $temppassword, time() + (60 * 60 * 24 * 365));

            if ($_SESSION['u']['usertype'] === 'User') {
                header("Location: homepage.php");
                exit();

            } else {
                header("Location: devprofile.php");
                exit();
            }


        } else {
            echo "Invalid username or password.";
        }
    }
}

if (isset($_GET['signup'])) {
    $signupcommand = $_GET['signup'];
    if ($signupcommand === 'Signup') {
        header("Location: Registation.php");
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

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .login-fullframe {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .login-form {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px 0px 0px 8px;
            box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.2)
        }

        .login-form h2 {
            margin: 0 0 20px;
            text-align: center;
            color: #333;
        }

        .plch input[type="text"],
        .plch input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;

        }

        .btn1 input[type="submit"] {
            background: linear-gradient(to right, lightpurple, lightyellow);

        }

        .rightside-container {
            width: 400px;
            display: flex;
            height: 394px;
            padding: 20px;
            border-radius: 8px;
            border-radius: 0px 8px 8px 0px;
            box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #439e96b0, #08154c);
            flex-direction: column;
            flex-wrap: nowrap;
            justify-content: center;
            align-items: center;
        }



        .btn1 input[type="submit"] {
            width: 80%;
            padding: 11px;
            background-color: #08154c;
            color: white;
            border: none;
            border-radius: 26px;
            cursor: pointer;
        }

        .btn1 input[type="submit"]:hover{
            width: 80%;
            padding: 11px;
            background-color: #08374c;
            color: white;
            border: none;
            border-radius: 26px;
            cursor: pointer;
        }



        .rightside-container h4 {
            margin: 0 0 10px;
            font-size: 24px;
            color: #fff;
        }

        .rightside-container h6 {
            margin: 0;
            font-size: 14px;
            color: #fff;
        }

        .btn1 {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: center;
            align-items: center;
        }
    </style>


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