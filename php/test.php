<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <!-- calcilater -->

  <form action="test.php" method="post">


    <label for="fname">First name:</label>
    <input type="text" name="fname">
    <br><br>

    <label for="lname">Last name:</label>
    <input type="text" name="lname">
    <br><br>

    <label for="age">age:</label>
    <input type="text" name="age">
    <br><br>

    <label for="dob">date of birth:</label>
    <input type="date" name="dob">
    <br><br>


    <select name="gender">
      <option value="0" selected>--select gender --</option>
      <option value="male">male</option>
      <option value="female">female</option>
    </select>
    <br><br>


    <label for="address">address:</label>
    <input type="text" name="address">
    <br><br>

    <label for="email">email:</label>
    <input type="text" name="email">
    <br><br>

    <input type="submit" name="submit" value="add user">




  </form>
  <?php
  include 'testconnect.php';



  if (isset($_POST['submit'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];


    $sql = "INSERT INTO user (fname,lname,age,dob,gender,address,email) Value('$fname','$lname','$age','$dob',' $gender ','$address','$email');";
    mysqli_query($connect, $sql);

  }

  ?>





</body>

</html>