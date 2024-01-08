<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user profile</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


    <?php
    include 'connect.php';
    include 'header.php';





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
    $dob = $row["dob"];
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

    <div id="colorlib-page">
        <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
        <aside id="colorlib-aside" role="complementary" class="js-fullheight">
            <nav id="colorlib-main-menu" role="navigation">
                <ul>
                    <li class="colorlib-active"><a href="#">Home</a></li>
                    <li><a href="#">Project</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </aside> <!-- END COLORLIB-ASIDE -->




        <!-- <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#home"></use>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#speedometer2"></use>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#table"></use>
                    </svg>
                    Orders
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#grid"></use>
                    </svg>
                    Products
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#people-circle"></use>
                    </svg>
                    Customers
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div> -->


        <?php include 'footer.php';
        ?>

</body>

</html>