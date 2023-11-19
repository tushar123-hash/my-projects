<?php
require("../db_con.php");

session_start();
if (!array_key_exists('id', $_SESSION)) {
  header("Location: ../index.php");
}

if (isset($_POST["unenrl"])) {
   $delval = ($_GET["d_12_e221_l"]-5)/9955447752;
  $deletefromquizenrl = "DELETE FROM quizenrollments WHERE en_id = ".$delval;
  mysqli_query($dbcon, $deletefromquizenrl);
}

if (isset($_POST["dltmyquiz"])) {
$delmqval = ($_GET["d_12_e221_lmq"]-5)/9955447752;
echo $delmqval;
$deletefrommyquizdtl = "DELETE FROM quizdtl WHERE q_no = ".$delmqval." AND userid = ".$_SESSION["id"];
mysqli_query($dbcon, $deletefrommyquizdtl);
echo mysqli_error($dbcon);
}
?>

<!-- purple orange -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashb.css">
  </head>

  <body>

<header>
  <a href="../index.php">back</a>
</header>

    <div id="mainContainer">

      <?php
        $selectfromusers = "SELECT name FROM user WHERE userid = ".$_SESSION["id"]." LIMIT 1";
        $resultfromusers = mysqli_query($dbcon, $selectfromusers);
        if (mysqli_num_rows($resultfromusers) > 0) {
          while ($fetchfromusers = mysqli_fetch_assoc($resultfromusers)) {

      ?>
      <div id="udtl" class="containerBox">
        <h3>Your Details</h3>

          <p>
            <b>Name </b> <br>
            <input type="text" name="" value="<?php echo $fetchfromusers["name"]; ?>">
          </p>

          <p>
            <b>Old Password: </b> <br>
            <input type="password" name="" value="" placeholder="Old Password">
          </p>

          <p>
            <b>New Password: </b> <br>
            <input type="password" name="" value="" placeholder="New Password">
          </p>

          <p>
            <input class="btnblack" type="submit" name="" value="Update">
          </p>

      </div>
      <?php
        }
      }
      ?>
<!--
<div class="">
      <h4>Live Quiz</h4>
      <?php

      $selectQuizDtl = "SELECT * FROM quizenrollments WHERE userid =".$_SESSION['id'];
      $resultQuizDtl = mysqli_query($dbcon, $selectQuizDtl);
      if (mysqli_num_rows($resultQuizDtl)>0) {
        while($fetchquizdtl = mysqli_fetch_assoc($resultQuizDtl)){

      ?>

      <?php
        $linkval = ($fetchquizdtl['q_no']* 9955447752+5);
      ?>

      <form action="../quiz/goinglive.php?nm=<?php echo $linkval; ?>" method="post">

        <div class="coursedtl">
          <div class=""> <?php echo $fetchquizdtl['title']; ?> </div>
          <div class=""> <input type="submit" name="attnd" value="Attend"> </div>
        </div>

      </form>

    <?php
        }
      }
    ?>
  </div> -->

      <div id="mypurchasesblock" class="containerBox" onclick="drpdwn">
        <h3> My Purchases </h3>

        <?php
        $selectMypurchases = "SELECT * FROM quizenrollments WHERE userid =".$_SESSION['id']." AND pstatus = 'yes'";
        $resultmypurchases = mysqli_query($dbcon, $selectMypurchases);
        if (mysqli_num_rows($resultmypurchases)>0) {
          while($fetchmypurchases = mysqli_fetch_assoc($resultmypurchases)){
            $linkval = ($fetchmypurchases['q_no']* 9955447752+5);
            $dellinkval = ($fetchmypurchases['en_id']* 9955447752+5);
        ?>
            <b> <?php echo $fetchmypurchases['title']; ?> </b>
            <div class="coursedtl">
            <form action="../quiz/goinglive.php?nm=<?php echo $linkval; ?>" method="post">
              <div class=""> <input class="attnbtn" type="submit" name="attnd" value="Attend"> </div>
            </form>
            <form action="userpage.php?d_12_e221_l=<?php echo $dellinkval; ?>" method="post">
              <div class=""> <input class="btnblack" type="submit" name="unenrl" value="Un-enroll"> </div>
            </form>
          </div>
      <?php
          }
        }
      ?>

      </div>

      <div id="myquizblock" class="containerBox" onclick="drpdwn">
        <h3>My Quiz </h3>

        <?php
        $selectQuizDtl = "SELECT * FROM quizdtl WHERE userid =".$_SESSION['id'];
        $resultQuizDtl = mysqli_query($dbcon, $selectQuizDtl);
        if (mysqli_num_rows($resultQuizDtl)>0) {
          while($fetchquizdtl = mysqli_fetch_assoc($resultQuizDtl)){
            $delmqlinkval = ($fetchquizdtl['q_no']* 9955447752+5);
          ?>
        <form  action="userpage.php?d_12_e221_lmq=<?php echo $delmqlinkval; ?>" method="post">
          <div class="coursedtl">
            <b> <?php echo $fetchquizdtl['title']; ?> </b>
            <div class=""> <?php echo $fetchquizdtl['price']==0?'Free':"&#8377 ".$fetchquizdtl['price']; ?> </div>
          </div>
            <div class=""> <input class="btnblack" type="submit" name="dltmyquiz" value="Delete"> </div>
      </form>

      <?php
          }
        } else {
          echo "Nothing to show";
        }
      ?>
      </div>

      <div class="containerBox">
        <h3>My Blogs</h3>

        <div class="coursedtl">
          Nothing to show
        </div>

      </div>

      <div class="containerBox">
        <h3>Quiz Attended</h3>
        <div id="attntags">
          <?php
          $selectMypurchases = "SELECT * FROM quizenrollments WHERE userid =".$_SESSION['id']." AND attendstat = 'yes'";
          $resultmypurchases = mysqli_query($dbcon, $selectMypurchases);
          if (mysqli_num_rows($resultmypurchases)>0) {
            while($fetchmypurchases = mysqli_fetch_assoc($resultmypurchases)){
              ?>
              <form method="post">
              <span class="attntags"> <?php echo $fetchmypurchases['title']; ?> </span>
              </form>
          <?php
              }
            }
           ?>
        </div>

      </div>

    </div>
  </body>
</html>
