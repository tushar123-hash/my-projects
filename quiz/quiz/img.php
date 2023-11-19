<?php
require("../db_con.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="fp">
      <input type="submit" name="upl" value="upload">
    </form>
      <?php
      if ($_POST["upl"]) {
        $filename = addslashes($_FILES['fp']['name']);
        $sql = "UPDATE quiztbl SET image = '".$filename."' WHERE q_id = 32";
        if(mysqli_query($dbcon, $sql)){
          echo "string";
        }else{
        echo mysqli_error($dbcon);
      }
      }

      ?>
  </body>
</html>
