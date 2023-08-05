<!-- background: url(https://d8it4huxumps7.cloudfront.net/uploads/images/d2c-images/organiser-list.jpg?d=1600x1420);
    background-size: auto;
background-size: 80%;
-webkit-animation-name: rotate-bg;
animation-name: rotate-bg;
-webkit-animation-duration: 60s;
animation-duration: 60s;
-webkit-animation-iteration-count: infinite;
animation-iteration-count: infinite;
-webkit-animation-fill-mode: forwards;
animation-fill-mode: forwards;
-webkit-animation-timing-function: linear;
animation-timing-function: linear; -->

<?php
    session_start();
    if(!array_key_exists("id", $_SESSION)){
        header("Location: ../index.php");
    }
    echo "<br>".$_SESSION['id'];
    require("../db_con.php");


    $nmq = filter_var($_POST["nmq"], FILTER_SANITIZE_STRING);
    $qprc = filter_var($_POST["qprc"], FILTER_SANITIZE_STRING);
    $qcrt = filter_var($_POST["qcrt"], FILTER_SANITIZE_STRING);
    $qcate = filter_var($_POST["qcate"], FILTER_SANITIZE_STRING);
    $qaud = filter_var($_POST["qaud"], FILTER_SANITIZE_STRING);
    $qabt = filter_var($_POST["qabt"], FILTER_SANITIZE_STRING);
    $qhlp = filter_var($_POST["qhlp"], FILTER_SANITIZE_STRING);
    $qdesc = filter_var($_POST["qdesc"], FILTER_SANITIZE_STRING);


    if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(isset($_POST["nmqBtn"])){

    if(empty($nmq)){

        echo "Name Field must not be and cannot include symbols";

    } else {
      echo "<br>".$nmq;
      $insertToQuizDtl = "INSERT INTO quizdtl (q_no, userid, title, price, creator, category, audience";
      $insertToQuizDtl .= ", about, helpful, remark, q_start, q_created)";
      $insertToQuizDtl .= "VALUES(' ', ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), Now())";
      $queryToQDtl = mysqli_stmt_init($dbcon);
      mysqli_stmt_prepare($queryToQDtl, $insertToQuizDtl);
      mysqli_stmt_bind_param($queryToQDtl, 'issssssss', $_SESSION['id'], $nmq, $qprc, $qcrt, $qcate, $qaud, $qabt, $qhlp, $qdesc);
      mysqli_stmt_execute($queryToQDtl);
      if (mysqli_stmt_affected_rows($queryToQDtl) > 0) {

        echo "<br>do";

        $_SESSION['qno'] = mysqli_insert_id($dbcon);
        header("Location: quiz_adm.php");

        // $insertToQuiztbl = "INSERT INTO quiztbl (q_no, userid,";
        // $insertToQuiztbl .= " title)";
        // $insertToQuiztbl .= "VALUES(?, ?, ?)";
        // $queryToQtbl = mysqli_stmt_init($dbcon);
        // mysqli_stmt_prepare($queryToQtbl, $insertToQuiztbl);
        // mysqli_stmt_bind_param($queryToQtbl, 'iis', $_SESSION['qid'], $_SESSION['id'], $nmq);
        // mysqli_stmt_execute($queryToQtbl);
        // if (mysqli_stmt_affected_rows($queryToQtbl) > 0) {
        //   echo "<br>dno";
        //   echo mysqli_error($dbcon);
        // }

      } else {
      echo mysqli_error($dbcon);
      }


    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Name</title>
    <link rel="stylesheet" href="quizStyle.css">
</head>
<body>
    <section id="quizTitleSec">
        <form method="POST">
        <div id="titleBox">

            <h4>Quiz Name <sup>*</sup> </h4>
            <div>
              <input type="text" name="nmq" placeholder="Name your quiz">
            </div>

            <h4>Creator Name <sup>*</sup> </h4>
            <div class="">
              <input type="text" name="qcrt" placeholder="Cretor Name (e.i. person, organization..)">
            </div>

            <h4>Category <sup>*</sup> </h4>
            <div class="">
              <input type="text" name="qcate" placeholder="category">
            </div>

            <h4>Description <sup>*</sup> </h4>
            <div class="">

              <ol>
                <li><h5>Who is your target Audiance?</h5></li>
                <input type="text" name="qaud" placeholder="Who is your target Audiance?">

                <li><h5>What this quiz is about?</h5></li>
                <input type="text" name="qabt" placeholder="What this quiz is about?">

                <li><h5>How this quiz will be helpful?</h5></li>
                <input type="text" name="qhlp" placeholder="How this quiz will be helpful?">

                <li><h5>Important remarks</h5></li>
                <input type="text" name="qdesc" placeholder="Detailed description">
              </ol>

            </div>

            <h4>Price <sup>*</sup> </h4>
            <div class="">
              <input type="text" name="qprc" placeholder="Price">
            </div>

            <div><input type="submit" name="nmqBtn" value="set"></div>
        </div>
        </form>
    </section>
</body>
</html>
