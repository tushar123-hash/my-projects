<?php
    session_start();
    require("../db_con.php");
    if(!array_key_exists("tblnm", $_SESSION) && !array_key_exists("id", $_SESSION)){
        header("Location: ../index.php");
    }
    echo $_SESSION['qno'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      if (isset($_POST['previwqbtn'])) {
        $linkval = ($_SESSION['qno'] * 9955447752+5);
        header("Location: goinglive.php?nm=".$linkval."");
      }

      //insert questions to table
        if(isset($_POST["UpdateQA"])){

          $quest = filter_var($_POST["quest1"], FILTER_SANITIZE_STRING);
          $op1 = filter_var($_POST["opt1"], FILTER_SANITIZE_STRING);
          $op2 = filter_var($_POST["opt2"], FILTER_SANITIZE_STRING);
          $op3 = filter_var($_POST["opt3"], FILTER_SANITIZE_STRING);
          $op4 = filter_var($_POST["opt4"], FILTER_SANITIZE_STRING);

          $image = file_get_contents($_FILES['image']['tmp_name']);
          $option1 = file_get_contents($_FILES['option1']['tmp_name']);
          $option2 = file_get_contents($_FILES['option2']['tmp_name']);
          $option3 = file_get_contents($_FILES['option3']['tmp_name']);
          $option4 = file_get_contents($_FILES['option4']['tmp_name']);

          // if (empty($quest)) {
          //   echo "question cant be empty";
          // } else if (empty($op1)) {
          //   echo "opt a can not be empty";
          // } else if (empty($op2)) {
          //   echo "opt b can not be empty";
          // } else
          // if(empty($_POST['copt'])){
          //   echo "string";
          // }else {
            $insertToquizTbl = "INSERT INTO quiztbl (q_no, userid, title, quest, optA, ";
              $insertToquizTbl .= "optB, optC, optD, answer, questi, optai, optbi, optci, optdi)";
              $insertToquizTbl .= "VALUES(?, ?, ?, ?, ?, ";
              $insertToquizTbl .= "?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $queryToquizTbl = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($queryToquizTbl, $insertToquizTbl);
              mysqli_stmt_bind_param($queryToquizTbl, 'ssssssssssssss', $_SESSION['qno'], $_SESSION['id'], $_SESSION['ttl'],
              $quest, $op1, $op2, $op3, $op4, $_POST['copt'], $image, $option1, $option2, $option3, $option4);
              mysqli_stmt_execute($queryToquizTbl);
              if (mysqli_stmt_affected_rows($queryToquizTbl)>0) {
                echo "<br>Added";
                header("Location: quiz_adm.php");
              } else {
                echo "none";
                echo mysqli_error($dbcon);
              }
          // }
        }
        //insert question to table end

        //update time and title
        if (isset($_POST["updtSv"])) {
          $qtitle = filter_var($_POST["qtitle"], FILTER_SANITIZE_STRING);
          $qsdate = filter_var($_POST["qsdate"], FILTER_SANITIZE_STRING);
          $qstat = filter_var($_POST["qstat"], FILTER_SANITIZE_STRING);
          $qlaunch = filter_var($_POST["qlaunch"], FILTER_SANITIZE_STRING);

          if (empty($qtitle) && is_string($qtitle)!= 1) {
            echo "Title can not be empty";
          } else {

            $updateQuizDtl = "UPDATE quizdtl SET title= '".htmlspecialchars($qtitle)."', startstat= '".htmlspecialchars($qstat)."',
            q_start= '".htmlspecialchars($_POST["qsdate"])."', onsale ='".htmlspecialchars($qlaunch)."'
             WHERE q_no = ".$_SESSION['qno'];

            if(mysqli_query($dbcon, $updateQuizDtl)){
              $updateQuizTbl = "UPDATE quiztbl SET title= '".$qtitle."' WHERE q_no = ".$_SESSION['qno'];
              if(mysqli_query($dbcon, $updateQuizTbl)){
                $updateQuizenrl = "UPDATE quizenrollments SET title= '".$qtitle."' WHERE q_no = ".$_SESSION['qno'];
              }
            }
            //  else{
            //   echo mysqli_error($dbcon);
            // }
          }
        }
        //update time and title end

        if ($_POST["questUpdate"]) {

          $question = filter_var($_POST["question"], FILTER_SANITIZE_STRING);
          $optionA = filter_var($_POST["optionA"], FILTER_SANITIZE_STRING);
          $optionB = filter_var($_POST["optionB"], FILTER_SANITIZE_STRING);
          $optionC = filter_var($_POST["optionC"], FILTER_SANITIZE_STRING);
          $optionD = filter_var($_POST["optionD"], FILTER_SANITIZE_STRING);
          $answer = filter_var($_POST["answer"], FILTER_SANITIZE_STRING);

          $updtqa = "UPDATE quiztbl SET quest ='".htmlspecialchars($question, ENT_SUBSTITUTE)."',
          optA ='".htmlspecialchars($optionA, ENT_SUBSTITUTE)."', optB ='".htmlspecialchars($optionB, ENT_SUBSTITUTE)."',
          optC ='".htmlspecialchars($optionC, ENT_SUBSTITUTE)."', optD ='".htmlspecialchars($optionD, ENT_SUBSTITUTE)."', answer ='".$answer."'
          WHERE q_id =".$_POST["qaid"];
          if(mysqli_query($dbcon, $updtqa)){
            echo "ddsds";
          }else{
            echo mysqli_error($dbcon);
          }
        }

        if (isset($_POST["questDelete"])) {
          $delQuest = "DELETE FROM quiztbl WHERE q_id =".$_POST["qaid"];
          if(mysqli_query($dbcon, $delQuest)){
            echo "Question Deleted";
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
    <title>Control</title>
    <link rel="stylesheet" href="quizStyle.css">
</head>
<body>

  <form method="POST" enctype="multipart/form-data">

    <section id="quizCreationSec">
        <h1>Create quiz</h1>
        <div id="note">
          <h4>Note:</h4>
          <ul type="square">
            <li>
              Once you added a question to your quiz, an link will
               be generated for your quiz. You can share the link with you
               students and they can access the quiz via there computer devices.
            </li>
          </ul>
        </div>

        <div id="prevBtn">
          <input type="submit" name="previwqbtn" value="Preview Quiz">
        </div>

      <div id="detailupdatebox">
      <h2>Update Quiz Schedule</h2>
      <table>
            <?php
            $selectQuizDtl = "SELECT * FROM quizdtl WHERE q_no =".$_SESSION['qno']." LIMIT 1";
            $resultQuizDtl = mysqli_query($dbcon, $selectQuizDtl);
            if (mysqli_num_rows($resultQuizDtl) > 0 ) {
              $fetchQuizDtl = mysqli_fetch_assoc($resultQuizDtl);
              $_SESSION['ttl'] = $fetchQuizDtl['title'];
            ?>

            <tr>
              <th>Update Title</th>
              <td><input type="text" name="qtitle" placeholder="Update Title" value="<?php echo $fetchQuizDtl['title']; ?>"></td>
            </tr>

            <tr>
              <th>Update Title</th>
              <td><input type="text" name="qcreator" placeholder="Update Title" value="<?php echo $fetchQuizDtl['creator']; ?>"></td>
            </tr>

            <tr>
              <th>Set Start Date</th>
                <td><input type="date" name="qsdate" placeholder="Start Date" value="<?php echo date('Y-m-d', strtotime($fetchQuizDtl['q_start'])); ?>"></td>
            </tr>

            <tr>
              <th>Start Quiz</th>
              <td>
                <label><input type="radio" name="qstat" value="yes" <?php echo $fetchQuizDtl['startstat'] === "yes"?"checked":"unchecked"; ?> >YES</label>
                <label><input type="radio" name="qstat" value="no" <?php echo $fetchQuizDtl['startstat'] === "no"?"checked":"unchecked"; ?>>NO</label>
              </td>
            </tr>

            <tr>
              <th>Launch for sale</th>
              <td>
                <label><input type="radio" name="qlaunch" value="yes" <?php echo $fetchQuizDtl['onsale'] === "yes"?"checked":"unchecked"; ?> >YES</label>
                <label><input type="radio" name="qlaunch" value="no" <?php echo $fetchQuizDtl['onsale'] === "no"?"checked":"unchecked"; ?>>NO</label>
              </td>
            </tr>

            <tr>
              <th>Price</th>
              <td> <input type="number" name="" value="<?php echo $fetchQuizDtl['price']; ?>" min="0" max="5000"> </td>
            </tr>

            <tr>
              <th></th>
              <td><input type="submit" name="updtSv" value="update and save"></td>
            </tr>

        </table>
      </div>
<?php
}
// echo mysqli_error($dbcon);
?>


<div id="addQuestionBox">
  <h2>ADD QUESTION</h2>

  <div id="ques">
    <h3>Question</h3>
    <textarea name="quest1" id="" placeholder="Enter QuestionHere" onkeyup="adjustHeight(this)" ></textarea>
    <input type="file" accept=".jpg, .png, .jpeg" name="image">
  </div>

  <div class="opt">
    <label><h3><input type="radio" name="copt" value="A"> A</h3></label>
    <textarea name="opt1" class="insQues" placeholder="Option A" onkeyup="adjustHeight(this)"></textarea>
    <input type="file" accept=".jpg, .png, .jpeg" name="option1">
  </div>

  <div class="opt">
    <label><h3><input type="radio" name="copt" value="B"> B</h3></label>
    <textarea name="opt2" class="insopt" placeholder="Option B" onkeyup="adjustHeight(this)"></textarea>
    <input type="file" accept=".jpg, .png, .jpeg" name="option2">
  </div>

  <div class="opt">
    <label><h3><input type="radio" name="copt" value="C"> C</h3> </label>
    <textarea name="opt3" class="insopt" placeholder="Option C" onkeyup="adjustHeight(this)"></textarea>
    <input type="file" accept=".jpg, .png, .jpeg" name="option3">
  </div>

  <div class="opt">
    <label><h3><input type="radio" name="copt" value="D"> D</h3> </label>
    <textarea name="opt4" class="insopt" placeholder="Option D" onkeyup="adjustHeight(this)"></textarea>
    <input type="file" accept=".jpg, .png, .jpeg" name="option4">
  </div>
  <input type="submit" name="UpdateQA" value="Add Question">
</div>
    </section>
  </form>

      <section id="questEditor">

      <h2>Edit Question</h2>
        <?php
        $extquiz = "SELECT * FROM quiztbl WHERE q_no =".$_SESSION['qno'];
        $resultextquiz = mysqli_query($dbcon, $extquiz);
        $num = 1;
        if (mysqli_num_rows($resultextquiz) > 0 ) {
          while($fetchextquiz = mysqli_fetch_assoc($resultextquiz)){
            ?>

      <div id="QpBox">
      <form method="POST">
        <h3>Question <?php echo $num++; ?></h3>
        <textarea class="extques" name="question" onkeyup="adjustHeight(this)"><?php echo $fetchextquiz['quest']; ?></textarea>

        <?php if(!empty($fetchextquiz['questi'])) { ?>
        <div class="qdimg">
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($fetchextquiz['questi']); ?>" alt="Image">
       </div>
       <?php } ?>

        <div>
          <h3>A</h3>
          <textarea class="extopt" name="optionA" onkeyup="adjustHeight(this)"><?php echo $fetchextquiz['optA']; ?></textarea>

          <?php if(!empty($fetchextquiz['optai'])) { ?>
          <div class="qdimg">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($fetchextquiz['optai']); ?>" alt="Image">
          </div>
          <?php } ?>
        </div>

        <div>
          <h3>B</h3>
          <textarea class="extopt" name="optionB" onkeyup="adjustHeight(this)"><?php echo $fetchextquiz['optB']; ?></textarea>

          <?php if(!empty($fetchextquiz['optbi'])) { ?>
          <div class="qdimg">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($fetchextquiz['optbi']); ?>" alt="Image">
          </div>
          <?php } ?>
        </div>

        <div style="display: <?php echo empty($fetchextquiz['optC'])?'none':'block'; ?>">
          <h3>C</h3>
          <textarea class="extopt" name="optionC" onkeyup="adjustHeight(this)" ><?php echo $fetchextquiz['optC']; ?></textarea>

          <?php if(!empty($fetchextquiz['optci'])) { ?>
          <div class="qdimg">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($fetchextquiz['optci']); ?>" alt="Image">
          </div>
          <?php } ?>
        </div>

        <div style="display: <?php echo empty($fetchextquiz['optD'])?'none':'block'; ?>">
          <h3>D</h3>
          <textarea class="extopt" name="optionD" onkeyup="adjustHeight(this)"><?php echo $fetchextquiz['optD']; ?></textarea>

          <?php if(!empty($fetchextquiz['optdi'])) { ?>
          <div class="qdimg">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($fetchextquiz['optdi']); ?>" alt="Image">
          </div>
          <?php } ?>

        </div>
        <div id="answerBox" class="answerBox">
          <h3>Correct Answer</h3>
          <input type="text" name="answer" value="<?php echo $fetchextquiz['answer']; ?>" class="answeField">

        </div>

      <input type="hidden" name="qaid" value="<?php echo $fetchextquiz['q_id']; ?>">
      <input type="submit" name="questUpdate" value="Update">
      <input type="submit" name="questDelete" value="Delete">
    </form>
  </div>
    <?php }} else {echo mysqli_error($dbcon);} ?>
    </section>

<script type="text/javascript">

var txtarea = document.querySelectorAll('.extques');
for (var i = 0; i < txtarea.length; i++) {
  txtarea[i].style.height = "1px";
  txtarea[i].style.height = (25 + txtarea[i].scrollHeight) + "px";
}

var opt = document.querySelectorAll('.extopt');
for (var i = 0; i < opt.length; i++) {
  opt[i].style.height = "1px";
  opt[i].style.height = (25 + opt[i].scrollHeight) + "px";
}

function adjustHeight(txtsize){
  txtsize.style.height = "1px";
  txtsize.style.height = (25 + txtsize.scrollHeight) + "px";
}

</script>

</body>
</html>
