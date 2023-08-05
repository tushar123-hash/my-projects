<?php
  session_start();
  require("../db_con.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ($_POST["sbm"] == "submitted") {

  $extquestfrmquiztbl = "SELECT * FROM quiztbl WHERE q_no =".$_SESSION['tblid'];
  $resultextquestfrmquiztbl = mysqli_query($dbcon, $extquestfrmquiztbl);
  if (mysqli_num_rows($resultextquestfrmquiztbl) > 0) {
    $val = 1;
    $numofques = 1;
    $ques = [];
    $cans = [];
    $yans = [];
    $cresults = [];
    while ($rowextquest = mysqli_fetch_assoc($resultextquestfrmquiztbl)) {
      $_SESSION['numofques'] = $numofques;
      $numofques++;
      array_push($cresults, $rowextquest['answer']);
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
    $allcans = implode(", ", $cresults);
    $updateResultquizenrl = "UPDATE quizenrollments SET results = '".htmlspecialchars($allans)."', cresults =
    '".htmlspecialchars($allcans)."', cans =".htmlspecialchars($_SESSION['attq']).", attendstat = 'yes', noq =".$_SESSION["numofques"]."
    WHERE userid =".$_SESSION['id']." AND q_no =".$_SESSION['tblid'];

    if(mysqli_query($dbcon, $updateResultquizenrl)){
      header("Location: ../feedback.php");
    }
  }
}
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Start Quiz</title>
    <style media="screen">
      *{
        font-family: arial;
        line-height: 1.3em;
        letter-spacing: 0.1rem;
        text-align: justify;
        box-sizing: border-box;
        font-family: cursive;
      }

      body{
        padding: 0;
        margin: 0;
        background: rgba(204, 204, 204, 0.5);
      }

      #quiztitle{
        text-align: center;
      }

      .quizquestionBox{
        margin-top: 40px;
        padding: 1vw 2vw 1vw 2vw;
        font-size: 1.3rem;
      }

      a{
        text-decoration: none;
        margin-left: 5px;
        text-align: center;
        padding: 2px 5px 2px 5px;
        border: 2px solid rgba(204, 204, 204, 0.8);
        /* background: linear-gradient(to right, #ff35da, #ff3232, #8b00ef); */
        /* background: linear-gradient(to right, #ff3ff2, #fc2062); */
      }

      h3{
        padding: 10px 0px 10px 0px;
        margin: 0;
      }

      #livequizBox{
        width: 70%;
        background: #fff;
      }

      #questNumBox{
        display: flex;
        justify-content: space-evenly;
        background: #fff;
        width: 30%;
        position: relative;
        align-self: stretch;
        padding-top: 10px;
      }

      #qnumb{
        position: fixed;
        background: #fff;
      }

      main{
        display: flex;
        justify-content: center;
        align-items: flex-start;
        margin: 0 auto;
        overflow: hidden;
      }

      .ques{
        padding: 10px 0px 10px 0px;
      }

      .qimg{
        width: 100%;
      }

      .qimg img{
        width: 100%;
        height: auto;
      }

      .opt{
        padding: 10px 0px 10px 0px;
      }

      #btnbox{
          text-align: center;
      }

      #quizBtn{
        background: #000;
        border: none;
        color: #fff;
        padding: 10px;
        text-align: center;
        margin: 10px;
      }

    </style>
  </head>
  <body>


<main>
<section id="livequizBox">

<form method="POST">

<?php
 $_SESSION['tblid'] = ($_GET['nm']-5)/9955447752;

$extquestquiz = "SELECT title, startstat FROM quizdtl WHERE q_no= ".$_SESSION['tblid']." LIMIT 1";
$resultextquestquiz = mysqli_query($dbcon, $extquestquiz);
if (mysqli_num_rows($resultextquestquiz) > 0) {
  $row = mysqli_fetch_assoc($resultextquestquiz);
  if ($row["startstat"] === "yes") {

    //quiz title
    echo "<h1 id='quiztitle'>".$row['title']."</h1>";

    $extquestfrmquiztbl = "SELECT * FROM quiztbl WHERE q_no =".$_SESSION['tblid'];
    $resultextquestfrmquiztbl = mysqli_query($dbcon, $extquestfrmquiztbl);
    if (mysqli_num_rows($resultextquestfrmquiztbl) > 0) {
      $x = 1;
      $idnum = 1;
      $qnum = 1;
      while ($rowextquest = mysqli_fetch_assoc($resultextquestfrmquiztbl)) {

    ?>


<div id="<?php echo 'quizquestionBoxid'.$idnum++; ?>" class="quizquestionBox">

    <h3>Question <?php echo $x++; ?></h3>

    <div class="ques">
      <?php echo $rowextquest['quest']; ?>

      <?php if (!empty($rowextquest['questi'])) { ?>
      <div class="qimg">
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rowextquest['questi']); ?>" />
      </div>
      <?php } ?>
    </div>

    <div class="opt">
      <label>
          <input type="radio" name="sopt<?php echo $rowextquest['q_id']; ?>" value="A">
          <?php echo $rowextquest['optA']; ?>

      <?php if (!empty($rowextquest['optai'])) { ?>
      <div class="qimg">
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rowextquest['optai']); ?>" />
      </div>
      <?php } ?>
    </label>

    </div>

      <div class="opt">
        <label>
            <input class="rdo" type="radio" name="<?php echo 'sopt'.$rowextquest['q_id']; ?>" value="B">
            <?php echo $rowextquest['optB']; ?>

        <?php if (!empty($rowextquest['optai'])) { ?>
        <div class="qimg">
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rowextquest['optai']); ?>" />
        </div>
        <?php } ?>

      </label>
      </div>

        <div class="opt" style="display: <?php echo empty($rowextquest['optC'])?'none':'block'; ?>">
          <label>
              <input class="rdo" type="radio" name="<?php echo 'sopt'.$rowextquest['q_id']; ?>" value="C">
              <?php echo $rowextquest['optC']; ?>

          <?php if (!empty($rowextquest['optai'])) { ?>
          <div class="qimg">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rowextquest['optai']); ?>" />
          </div>
          <?php } ?>
        </label>
        </div>

          <div class="opt" style="display: <?php echo empty($rowextquest['optD'])?'none':'block'; ?>">
            <label>
                <input class="rdo" type="radio" name="<?php echo 'sopt'.$rowextquest['q_id']; ?>" value="D">
                <?php echo $rowextquest['optD']; ?>

            <?php if (!empty($rowextquest['optai'])) { ?>
            <div class="qimg">
              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rowextquest['optai']); ?>" />
            </div>
            <?php } ?>
          </label>
          </div>
</div>


<?php
echo "<style>#noquiz{display:none;}</style>";

}
}
}else{
  echo "<style>main{display:none;}</style>";
  echo "<style>#noquiz{display:block;}</style>";
}
} else {
  header("Location: ../index.php");
}

?>
<div id="btnbox">
  <input type="hidden" name="sbm" value="submitted">
<input id="quizBtn" type="submit" value="Submit Quiz">
</div>
</form>
</section>

<section id="questNumBox">
  <div id="qnumb">
  <?php
  for ($z=1; $z<$x; $z++) {
    ?>

    <a href="#<?php echo 'quizquestionBoxid'.$z; ?>"><?php echo $z; ?></a>
  <?php
}
   ?>
</div>
</section>
</main>

<section id="noquiz">
  <h1>This Quiz is not yet started. Please wait until quiz gets started</h1>
</section>
  </body>
</html>
