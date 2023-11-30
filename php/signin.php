<?php
// Include the database connection file
include 'connect.php';

session_start();
$devid = $_SESSION['u']['ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["logo"]) && isset($_FILES["screenshot"])) {
        // Get form data
       
        $name = $_POST["name"];
        $category = $_POST["category"];
        $subcategory = $_POST["subcategory"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $logo = $_FILES["logo"]["tmp_name"];
        $screenshots = $_FILES["screenshot"]["tmp_name"];

        // Prepare logo data for insertion
        $logoData = file_get_contents($logo);
        $logoData = mysqli_real_escape_string($connect, $logoData);

        // Prepare APK data for insertion (only for App category)
        $apkData = '';
        if (isset($_FILES["apk"])) {
            $apk = $_FILES["apk"]["tmp_name"];
            $apkData = file_get_contents($apk);
            $apkData = mysqli_real_escape_string($connect, $apkData);
        }

        // Generate a unique ID for the product
        $id = uniqid('app');

        // Prepare and execute the SQL query
        $sql = "INSERT INTO apps (ID,devID, Name, Price, Logo, Category, Subcategory,Description";
        $values = "VALUES ('$id','$devid' ,'$name', '$price', '$logoData', '$category', '$subcategory','$description'";

            $screenshotsData = array();
            foreach ($screenshots as $screenshot) {
                $screenshotData = file_get_contents($screenshot);
                $screenshotData = mysqli_real_escape_string($connect, $screenshotData);
                $screenshotsData[] = $screenshotData;
            }
            $screenshotsData = implode(",", $screenshotsData);

            $sql .= ", Screenshots, APK";
            $values .= ", '$screenshotsData', '$apkData'";
        

            $sql .= ") " . $values . ");";
        
        $rs = mysqli_query($connect, $sql);

        $query = "SELECT * FROM apps WHERE devID = '$devid'";
        $rs1 = mysqli_query($connect, $query);

        if ($row = $rs1->fetch_assoc()) {
            $appID = $id;
            $query1 = "INSERT INTO appstatus (appID, devID, Security, Payment, headadmin) VALUES ('$appID', '$devid','NO','NO','NO');";
             mysqli_query($connect, $query1);
         
            header("Location: homepage.php");
          
        } else {
            // Error handling
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px 0px 0px 8px;
            
        }
        h3{
            color:#070f34;
            font-family: monospace;
            font-size: 25px;
        }
      
        .add-product {
            margin-bottom: 20px;
        }

       
        .form-group {
            margin-bottom: 10px;
        }

        
        label {
            display: block;
            margin-bottom: 5px;
        }

      
        input[type="text"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        
        .btn {
            background-color: #08154c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 26px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #08374c;
        }

        /* Styles for error messages */
        .error {
            color: red;
            margin-bottom: 10px;
        }

        /* Styles for success messages */
        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    <?php 
    include 'header.php';
    ?>
    
    <div class="addappsframe">

        <div class="container">
            <section class="add-product">
                <form action="Add_apps.php" method="post" enctype="multipart/form-data">
                    <h3>Product Details</h3>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="box" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category">
                            <option value="none" selected></option>
                            <option value="Game">Game</option>
                            <option value="App">App</option>
                        </select>
                    </div>

                    <div class="form-group game">
                        <label for="game">Game Category</label>
                        <select name="subcategory" id="game">
                            <option value="action">Action</option>
                            <option value="sport">Sport</option>
                            <option value="kids">Kids</option>
                            <option value="puzzle">Puzzle</option>
                        </select>
                    </div>

                    <div class="form-group app">
                        <label for="app">App Category</label>
                        <select name="subcategory" id="app">
                            <option value="shopping">Shopping</option>
                            <option value="entertainment">Entertainment</option>
                            <option value="social-media">Social Media</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="education">Education</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">App Price</label>
                        <input type="text" name="price" id="price" class="box" required maxlength="10" min="0"
                            max="9999999">
                    </div>
                    <div class="form-group">
                        <label for="screenshot">Description</label>
                        <input type="text" name="description" id="desc" class="box" required >
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" id="logo" class="box" required accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="screenshot">App Screenshot</label>
                        <input type="file" name="screenshot[]" id="screenshot" class="box" required accept="image/*"
                            multiple>
                    </div>
                    
                    <div class="form-group">
                        <label for="apk">Add apk or ios file</label>
                        <input type="file" name="apk" id="apk" class="box-sizing" required accept="apk/*">
                    </div>

                    <input type="submit" value="Add Product" name="add_product" class="btn">
                </form>
            </section>
        </div>

    </div>
 
    <script>
        var category = document.getElementById("category");
        var game = document.querySelector(".game");
        var app = document.querySelector(".app");

        category.addEventListener("change", function () {
            if (category.value === "Game") {
                game.style.display = "block";
                app.style.display = "none";
            } else if (category.value === "App") {
                game.style.display = "none";
                app.style.display = "block";
            } else {
                game.style.display = "none";
                app.style.display = "none";
            }
        });
    </script>
    
</body>

</html>