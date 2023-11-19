<?php
session_start();
require("../db_con.php");
if(!array_key_exists("id", $_SESSION)){
    header("Location: ../index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $dId = filter_var(($_GET['sdjfjasnef']/1259)-5, FILTER_SANITIZE_NUMBER_INT);

  if(isset($_POST["dtbl"])){
    $getTbl = "SELECT title FROM quizdtl WHERE q_no =".$dId;
    $resultgetTbl = mysqli_query($dbcon, $getTbl);
    if(mysqli_num_rows($resultgetTbl)>0){
      // $row1 = mysqli_fetch_assoc($resultgetTbl);
      // $_SESSION['dtblNm'] = $row1["name"];

      $deleteFromQuiz = "DELETE FROM quizdtl WHERE q_no =".$dId;
      if(mysqli_query($dbcon, $deleteFromQuiz)){
        echo "<br>Deleted";
        // $dropTbl = "DROP TABLE ".$_SESSION["dtblNm"];
        // if(mysqli_query($dbcon, $dropTbl)){
        //   unset($_SESSION['tblNm']);
        // }
      }

    }
  }

  if(isset($_POST["editquiz"])){
    $_SESSION['qno'] = $dId;
    header("Location: quiz_adm.php");
  }

}


$selectAllQuiz = "SELECT * FROM quizdtl WHERE userid =".$_SESSION['id'];
$resultQuiz = mysqli_query($dbcon, $selectAllQuiz);

if(!(mysqli_num_rows($resultQuiz) > 0)){
    header("Location: name_quiz.php");
}
else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Quizes</title>
    <link rel="stylesheet" href="quizStyle.css">
</head>

<body>
    <section id="quizHistorySec" class="flexProp">
      <h1>Your Quiz History</h1>
      <div id="newqz">
          <a href="name_quiz.php">New Quiz</a>
      </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Created</th>
            </tr>


<?php

while($row = mysqli_fetch_assoc($resultQuiz)){
?>
<form method="POST" action="existq.php?sdjfjasnef=<?php echo ($row["q_no"]+5)*1259; ?>">
            <tr>
                <td><?php echo $row["title"]; ?></td>
                <td>
                  <?php echo date('d/m/y', strtotime($row["q_created"])); ?>
                  <p style="display: flex;">
                    <input type="submit" name="editquiz" value="Edit">
                  <input type="submit" name="dtbl" value="Delete">
                </p>

                </td>
            </tr>
  </form>
<?php
}
}
?>
        </table>
    </section>
</body>
</html>
