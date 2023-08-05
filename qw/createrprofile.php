<?php
session_start();

if (!array_key_exists('id', $_SESSION)) {
  header("Location: index.php");
}
require("db_con.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ($_POST['sbmcrtrdtl'] == 0) {

    $creatorName =  filter_var($_POST["crname"], FILTER_SANITIZE_STRING);
    $crtrdesc = filter_var($_POST["cpdesc"], FILTER_SANITIZE_STRING);

    if (empty($creatorName) || !is_string($creatorName)) {
      echo "Name can not be empty";
    } else if(empty($_POST["cprfurl"])) {
      echo "Profile Link can not be empty";
    } else if (empty($crtrdesc)) {
      echo "Description can not be empty";
    } else {
      $insertintocrtrprf = "INSERT INTO creatorprofile(crt_id, userid, name, ";
      $insertintocrtrprf .= "aboutme, profileurl, c_date)";
      $insertintocrtrprf .= "VALUES('', ?, ?, ?, ?, NOW())";
      $querytocrtrprf = mysqli_stmt_init($dbcon);
      mysqli_stmt_prepare($querytocrtrprf, $insertintocrtrprf);
      mysqli_stmt_bind_param($querytocrtrprf, 'isss', htmlspecialchars($_SESSION["id"]), htmlspecialchars($creatorName), htmlspecialchars($crtrdesc), htmlspecialchars($_POST["cprfurl"]));
      mysqli_stmt_execute($querytocrtrprf);
      if(mysqli_stmt_affected_rows($querytocrtrprf) > 0) {
        echo "string";
      }

    }

  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <section>

  <?php

  $checkcrtrregis = "SELECT * FROM creatorprofile WHERE userid = ".$_SESSION["id"]." LIMIT 1 ";
  $resultcrtrregis = mysqli_query($dbcon, $checkcrtrregis);
  if ((mysqli_num_rows($resultcrtrregis) > 0)) {
    echo "string";
    header("Location: tutor.php");
  } else{
    ?>

    <form method="post">

      <div id="">

        <h3>Name</h3>
        <?php
          $selectcrtrnmfrmuser = "SELECT name FROM user WHERE userid = ".$_SESSION["id"]." LIMIT 1";
          $resultcrtnmfrmuser = mysqli_query($dbcon, $selectcrtrnmfrmuser);
          if (mysqli_num_rows($resultcrtnmfrmuser) > 0) {
            $fetchcrtnmfrmuser = mysqli_fetch_assoc($resultcrtnmfrmuser);
          }
        ?>
        <input type="text" name="crname" value="<?php echo $fetchcrtnmfrmuser["name"]; ?>">

        <h3>Enter your Linkedin/Github profile Link</h3>
        <input type="text" name="cprfurl" value="<?php echo $_POST["cprfurl"]; ?>">

        <h3>Tell us something about you ?</h3>
        <textarea name="cpdesc" ><?php echo $_POST["cpdesc"]; ?></textarea>

        <div class="">
          <input type="submit" name="sbmcrtdtl" value="Submit">
          <input type="hidden" name="sbmcrtrdtl" value="0">
        </div>

      </div>

    </form>


    <?php
      }
    ?>
  </section>

  </body>
</html>
