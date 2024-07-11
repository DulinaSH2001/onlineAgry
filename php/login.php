<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tempusername = $_POST['email'];
    $temppassword = $_POST['password'];

    if ($tempusername == 'SLAadmin@admin.com' && $temppassword == 'admin123') {
        header('Location: Admin_panel/dashboard.php');


    } else {

        $sql = "SELECT * FROM users WHERE (email = '$tempusername') AND (password = '$temppassword');";
        $result = mysqli_query($connect, $sql);

        if ($result && $result->num_rows == 1) {
            echo '<h2>' . $tempusername . '</h2>';
            session_start();
            $user = $result->fetch_assoc();
            $_SESSION['u'] = $user;

            setcookie("username", $tempusername, time() + (60 * 60 * 24 * 365));
            setcookie("password", $temppassword, time() + (60 * 60 * 24 * 365));


            header("Location: index.php");



        } else if ($result && $result->num_rows == 0) {
            $adminsql = "SELECT * FROM admin WHERE (username = '$tempusername' OR email = '$tempusername') AND (password = '$temppassword');";
            $adminresult = mysqli_query($connect, $sql);
            if ($adminresult && $adminresult->num_rows == 1) {
                session_start();
                $admin = $adminresult->fetch_assoc();
                $_SESSION['a'] = $admin;

                setcookie("username", $tempusername, time() + (60 * 60 * 24 * 365));
                setcookie("password", $temppassword, time() + (60 * 60 * 24 * 365));


                header("Location: Admin_panel/dashboard.php");

            } else {
                // echo "<script> alert('invalide user name or password')</script>";
            }

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .logincut {
        padding: 59px;
        border-radius: 20px;
        width: 502px;
    }

    h2 {
        text-align: center;
    }



    label {
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    </style>
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
                        <div class="logincut shadow mb-5 bg-body">
                            <h2>Login</h2>
                            <form action="login.php" method="POST">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" name="password" required class="form-control">


                                </div>
                                <div class="row space-between">
                                    <div style="display: flex; justify-content: flex-start; align-items: center;"
                                        class="col-6">

                                        <input type="checkbox" class="col-2" id="showPassword"
                                            onclick="togglePasswordVisibility()">
                                        <div for="showPassword" class="col-10">Show Password</div>
                                    </div>
                                    <div class="input-group-append col-6">
                                        <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Login</button>
                                </div>

                                <div class="form-group">
                                    <p>Don't have an account? <a href="Signup.php" class="text-primary">Sign
                                            up</a></p>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById('password');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    }
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>