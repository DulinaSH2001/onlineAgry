<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <!-- calcilater -->

  <form action="test.php" method="get">


    <label for="price">price:</label>
    <input type="text" name="price">
    <br><br>

    <label for="qty">qty</label>
    <input type="text" name="qty">
    <br><br>

    <input type="submit">
    <label for="calculate">calculate price</label>
  </form>
  <?php
  $price = $_GET["price"];
  $qty = $_GET["qty"];
  $total = $price * $qty;

  echo "<br> total price:{$total} <br>";
  ?>





</body>

</html>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>


</body>

</html>