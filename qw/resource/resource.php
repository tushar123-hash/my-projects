<?php
session_start();
include("../db_con.php");
// session_destroy();

include("../navbar.php");

error_reporting(0);

$getquiznoid = ($_GET["ab12d3_21"]-22)/856456;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST["enrl"]) == "Enroll"){



  if (isset($_SESSION["add_tocart"])) {

    $add_this_item_id = array_column($_SESSION["add_tocart"], "quiz_id");
    if (!in_array($getquiznoid, $add_this_item_id)) {

      $count = count($_SESSION["add_tocart"]);
      $quiz_as_item_array = array(
        'quiz_id' => $getquiznoid,
        'quiz_ttl' => $_POST["qttl"],
				'quizcosts' => $_POST["qprc"]
      );
			$_SESSION["add_tocart"][$count] = $quiz_as_item_array;
    }
  } else {
		$quiz_as_item_array = array(
			'quiz_id' => $getquiznoid,
			'quiz_ttl' => $_POST["qttl"],
			'quizcosts' => $_POST["qprc"]
		);
			$_SESSION["add_tocart"][0] = $quiz_as_item_array;
	}
}

if (isset($_POST['removequiz']) == "Remove") {
	foreach ($_SESSION["add_tocart"] as $keys => $values) {
		if ($values["quiz_id"] == $getquiznoid) {
			unset($_SESSION["add_tocart"][$keys]);
		}
	}

}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Resources</title>
	<link rel="stylesheet" type="text/css" href="resources.css">
</head>
<body>

	<?php if (!empty($_SESSION["add_tocart"])) {
		?>
		<form action="cart.php" method="post">

    <a href="cart.php">
	   <div id="cartbtnbox">
		     &#128722;<input type="submit" id="cartbtn" name="noi_in_cart" value="<?php echo isset($_SESSION["add_tocart"])?count($_SESSION["add_tocart"]):"0"; ?>">
	   </div>
   </a>

  </form>

  <?php
    }
  ?>

<h1>Resource</h1>

<section id="quiz_section">

<?php
$extallquiz = "SELECT q_no, title, q_start, price FROM quizdtl WHERE onsale = 'yes'";
$rsltallquiz = mysqli_query($dbcon, $extallquiz);
if (mysqli_num_rows($rsltallquiz) > 0) {

while ($rowextallquiz = mysqli_fetch_assoc($rsltallquiz)) {
?>
<form action="<?php echo 'resource.php?ab12d3_21='.$rowextallquiz['q_no']*(856456+22); ?>" method="post">

<a href="resource.php?ab12d3_21=<?php echo $rowextallquiz['q_no']*856456+22; ?>">

<div class="quizDtlBox">

	<div class="">
		<input type="hidden" name="qttl" value="<?php echo $rowextallquiz['title']; ?>">
	<?php echo $rowextallquiz['title']; ?>
	</div>



	<div class="">
		<input type="hidden" name="qprc" value="<?php echo $rowextallquiz['price']; ?>">
		<?php
     echo $rowextallquiz['price'] == 0?'Free':"&#8377 ".$rowextallquiz['price'];
     ?>
	</div>

<?php

  $showenrls = "SELECT * FROM quizenrollments WHERE userid = ".$_SESSION["id"]." AND title = '".$rowextallquiz["title"]."'";
  $resultenrls = mysqli_query($dbcon, $showenrls);
  if (mysqli_num_rows($resultenrls) > 0) {
    while($fetchenrls = mysqli_fetch_assoc($resultenrls)){
                    // echo "<input id='enrlbtn' type='submit' name='enrl' value='Enroll'>";
  ?>

  <a class="gtcBtn" href="../dashboard/userpage.php">Back To Quiz</a>
  <?php
    }
  } else{

?>
<div class="">
  <input class="enrlbtn" type="submit" name="enrl" value="enroll">
</div>

<?php
}
?>

<!-- <div class="">
  <input class="enrldtl" type="submit" name="" value="Details">
</div> -->

  <?php

  if (isset($_SESSION["add_tocart"])) {
  	foreach ($_SESSION["add_tocart"] as $keys => $values) {
  		if ($values['quiz_id'] == $rowextallquiz["q_no"]) {
  ?>
    <div class="">
      <input type="submit" class="rmvbtn" name="removequiz" value="Remove">
    </div>
  <?php
  		}
  	}
  }
  ?>

</div>
</a>

</form>

<?php
}
}
?>
</section>

<script type="text/javascript">
	var rsc = document.querySelector("#rsc");
	rsc.classList.add("hoveff");
</script>

</body>
</html>
