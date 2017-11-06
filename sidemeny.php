<!DOCTYPE html>
<?xml version="1.0" encoding="UTF-8"?>
<html>
<?php include 'menylistearray.php';

?>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<body>


<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Områder</h3>
  <ul>
  <?php
  foreach ($menyliste as $key => $value) {
    echo '<li><a href=';
    echo ("#");
    echo '>';
    echo ($value);
    echo ("</a></li>");
    echo "<br>";
    unset($value);
 

    }
    ?>
    

</div>

</body>
</html>