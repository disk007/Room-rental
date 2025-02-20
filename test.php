<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Example</title>
</head>
<body>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  Name: <input type="text" name="name">
  <input type="submit" name="submit">
</form>

<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  echo "Hello, $name!";
}
?>

</body>
</html>
