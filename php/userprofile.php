<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <!-- Bootstrap CSS -->


    <style>
    body,
    html {
        height: 100%;
        margin: 0;

    }

    .wrapper {
        display: flex;
        height: 100%;
    }

    .sidebar {
        width: 250px;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .wrapper {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    body,
    html {
        height: 100%;
        margin: 0;

    }

    .wrapper {
        display: flex;
        height: 100%;
    }

    .sidebar {
        width: 250px;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    /* Responsive styles */
    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        .content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }

    /* Additional modifications for smaller screens */
    @media screen and (max-width: 320px) {
        .sidebar {
            padding: 10px;
        }

        .content {
            padding: 10px;
        }
    }

    /* Additional modifications for larger screens */
    @media screen and (min-width: 1200px) {
        .sidebar {
            width: 300px;
        }
    }
    </style>
</head>

<body>
    <?php

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
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="wrapper">



                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="profile-form">
                        <form action="userprofile.php" method="post">
                            <div class="form-group">
                                <label for="inputFirstName">First Name:</label>
                                <input type="text" class="form-control" id="inputFirstName" name="Fname"
                                    value="<?php echo $fname ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="inputLastName">Last Name:</label>
                                <input type="text" class="form-control" id="inputLastName" name="Lname"
                                    value="<?php echo $lname ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="inputDOB">Date of Birth:</label>
                                <input type="date" class="form-control" id="inputDOB" name="dob"
                                    value="<?php echo $dob ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail">Email:</label>
                                <input type="email" class="form-control" id="inputEmail" name="email"
                                    value="<?php echo $email ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="inputMobile">Mobile Number:</label>
                                <input type="tel" class="form-control" id="inputMobile" name="tel"
                                    value="<?php echo $tel ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="inputUsername">Username:</label>
                                <input type="text" class="form-control" id="inputUsername" name="username"
                                    value="<?php echo $username ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword">Password:</label>
                                <input type="password" class="form-control" id="inputPassword" name="password"
                                    value="<?php echo $password ?>" required>
                            </div>

                            <button type="submit" class="btn btn-success">Update Profile</button>
                            <button type="reset" class="btn btn-outline-danger">Cancel</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>


</body>

</html>