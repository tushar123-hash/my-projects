<?php

require("../db_con.php");

session_start();

if (!array_key_exists('id', $_SESSION)) {

  header("Location: ../index.php");

}

$dec_link = ($_GET['rpersult_12x21']+80)/547878454578;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
  </head>
  <body>

<?php
echo $dec_link;
$selectfromenrls = "SELECT * FROM quizenrollments WHERE q_no =".$dec_link." AND userid =".$_SESSION["id"]." LIMIT 1";
$resultenrls = mysqli_query($dbcon, $selectfromenrls);

if (mysqli_num_rows($resultenrls) > 0) {
  $rowextenrls = mysqli_fetch_assoc($resultenrls);
  $ycoptsans = explode(', ', $rowextenrls["results"]);
  $coptsans = explode(', ', $rowextenrls["cresults"]);
?>

<h3>Quiz Name</h3>
<div class="">
  <?php echo $rowextenrls["title"]; ?>
</div>

<h3>Quiz Score</h3>
<div class="">
<?php
for($zi = 0; $zi<count($ycoptsans); $zi++){
?>
<div class="">
  <p>Your Answer <span><?php echo $ycoptsans[$zi]; ?></span> </p>
  <p>Correct Answer <span><?php echo $coptsans[$zi]; ?></span> </p>
</div>
<?php
}
?>
</div>

<h3>Attende</h3>
<table>
  <tr>
    <th>Number of question</th>
    <td><?php echo $rowextenrls["noq"]; ?></td>
  </tr>

  <tr>
    <th>Correct Answers</th>
    <td><?php echo $rowextenrls["cans"]; ?></td>
  </tr>
</table>

<?php

} else{
  echo mysqli_error($dbcon);
}

?>

  </body>
</html>
