<?php
	require('db_con.php');
  session_start();

  echo $_SESSION["tblid"];
  if (!array_key_exists("id", $_SESSION) || !array_key_exists("tblid", $_SESSION)) {
    header("Location: index.php");
  }

  // $selectfromfdb = "SELECT * FROM feedback WHERE u_id =".$_SESSION["id"];
  // $resultfdb = mysqli_query($dbcon, $selectfromfdb);
  //
  // if (mysqli_num_rows($resultfdb) > 0) {
  //   header("Location: dashboard/fullanalysis.php");
  // }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$enc_link = ($_SESSION["tblid"]*547878454578)-80;
    $feedback = filter_var($_POST["fb"], FILTER_SANITIZE_STRING);

      $instofedb = "INSERT INTO feedback(f_no, q_id, ";
        $instofedb .= "u_id, feedback)";
        $instofedb .= "VALUES('', ?, ?, ?)";
        $querytoinstofdb = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($querytoinstofdb, $instofedb);
        mysqli_stmt_bind_param($querytoinstofdb, 'sss', htmlspecialchars($_SESSION["id"]), htmlspecialchars($_SESSION["tblid"]), htmlspecialchars($feedback));
        mysqli_stmt_execute($querytoinstofdb);

        if (mysqli_stmt_affected_rows($querytoinstofdb) > 0) {
					unset($_SESSION["tblid"]);
          header("Location: dashboard/fullanalysis.php?rpersult_12x21=".$enc_link."");
        } else {
          header("Location: dashboard/fullanalysis.php?rpersult_12x21=".$enc_link."");
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

    <div id=""> How was your experience? </div>

    <p>We need your valuable feedback to improve our content quality. Please leave a feedback before getting the result. </p>

    <form method="post">
      <input type="submit" name="fb" value="Good">
      <input type="submit" name="fb" value="Up to the mark">
      <input type="submit" name="fb" value="Not Good">
    </form>

  </body>
</html>
