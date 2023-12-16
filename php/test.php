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


    <label for="price">price:</label>
    <input type="text" name="price">
    <br><br>

    <label for="qty">qty</label>
    <input type="text" name="qt">
    <br><br>

    <input type="submit">
    <label for="calculate">calculate price</label>
  </form>
  <?php
  $price = $_POST["price"];
  $qty = $_POST["qt"];
  $total = $price * $qty;

  echo "<b> total price:{$total} <b>";
  ?>





</body>

</html>




