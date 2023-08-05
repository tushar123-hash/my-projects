<?php
include("../db_con.php");
session_start();

$extquestfrmquiztbl = "SELECT * FROM quiztbl WHERE q_no =".$_SESSION['tblid'];
$resultextquestfrmquiztbl = mysqli_query($dbcon, $extquestfrmquiztbl);
if (mysqli_num_rows($resultextquestfrmquiztbl) > 0) {
  $val = 1;
  $numofques = 1;
  $ques = [];
  $cans = [];
  $yans = [];

  while ($rowextquest = mysqli_fetch_assoc($resultextquestfrmquiztbl)) {
    $_SESSION['numofques'] = $numofques;
    $numofques++;

  if(!empty($_POST['sopt'.$rowextquest['q_id']])){

      if ($_POST['sopt'.$rowextquest['q_id']] === $rowextquest['answer']) {
       $_SESSION['attq'] = $val;
       $val++;
       array_push($yans, $_POST['sopt'.$rowextquest['q_id']]);
       // array_push($yans, $_POST['sopt'.$rowextquest['q_id']]);
       // array_push($ques, $rowextquest['q_id']);
       // array_push($cans, $rowextquest['answer']);
      } else{
         array_push($yans, $_POST['sopt'.$rowextquest['q_id']]);
      }

  } else {
    array_push($yans, "NOT");
  }

}

  $allans = implode(", ", $yans);
  $updateResultquizenrl = "UPDATE quizenrollments SET results = '".htmlspecialchars($allans)."', cans =".htmlspecialchars($_SESSION['attq']).", noq =".$_SESSION["numofques"]." WHERE userid =".$_SESSION['id']." AND q_no =".$_SESSION['tblid'];
  if(mysqli_query($dbcon, $updateResultquizenrl)){
    $_SESSION["quizDone"] = "done123";
    unset($_SESSION["tblid"]);
  }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Result</title>
  </head>
  <body>
    <h1>Result</h1>
    <div class="">
      <b>Number Of Question</b>
      <p><?php echo $_SESSION["numofques"]; ?></p>
    </div>

    <div class="">
      <b>Questions Attended</b>
      <p><?php echo $_SESSION['attq']; ?></p>
    </div>

    <a href="..\dashboard\fullanalysis.php">View Detailed Result</a>
  </body>
</html>
