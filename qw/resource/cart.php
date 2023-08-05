<?php
session_start();
// session_destroy();
error_reporting(0);
if (!array_key_exists("id", $_SESSION)) {
	header("Location: ../index.php");
}

include("../db_con.php");

$getquiznoid = ($_GET["ab12d3_21"]-22)/856456;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST['removequiz']) == "Remove") {

	foreach ($_SESSION["add_tocart"] as $keys => $values) {

		if ($values["quiz_id"] == $getquiznoid) {
			unset($_SESSION["add_tocart"][$keys]);
		}
	}
}

if (isset($_POST["pay"])) {
	foreach ($_SESSION["add_tocart"] as $keys => $values) {

		$insertToenrollinquiz = "INSERT INTO 	quizenrollments (en_id, userid, q_no,";
		$insertToenrollinquiz .= "title, pstatus, paid, pdate)";
		$insertToenrollinquiz .= "VALUES(' ', ?, ?, ?, ?, ?, NOW())";
		$querytoenrquiz = mysqli_stmt_init($dbcon);
		mysqli_stmt_prepare($querytoenrquiz, $insertToenrollinquiz);
		mysqli_stmt_bind_param($querytoenrquiz, 'iisss', htmlspecialchars($_SESSION["id"]), htmlspecialchars($values["quiz_id"]),
		htmlspecialchars($values["quiz_ttl"]), htmlspecialchars("yes"),htmlspecialchars($values["quizcosts"]));
		mysqli_stmt_execute($querytoenrquiz);
		if (mysqli_stmt_affected_rows($querytoenrquiz) > 0) {
			unset($_SESSION["add_tocart"][$keys]);
			$paysuccess = "You have paid successfully";
		}
		}
}
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cart</title>
  </head>
	<link rel="stylesheet" href="resources.css">
  <body>

<!--
#00264C
#3550A0
-->
		<a href="resource.php">
		<div id="backbtn">
			Back
		</div>
	</a>

		<?php
			if (empty($_SESSION["add_tocart"])) {
				$cartMessageBox = "Your cart is empty";
			}
		 ?>

<h1>Cart</h1>

<main id="mainContainer">

<section id="quizdtlcart">

<?php
	foreach ($_SESSION["add_tocart"] as $keys => $values) {
?>
 <form action="cart.php?ab12d3_21=<?php echo $values['quiz_id']*856456+22; ?>" method="post">

	<div class="quizDtlcartBox">

		<div class="">
			<?php echo $values['quiz_ttl']; ?>
		</div>

		<div class="">
			<?php echo $values['quizcosts'] ==0?'Free':"&#8377 ".$values['quizcosts']; ?>
		</div>

		<input type="submit" class="rmvbtn" name="removequiz" value="Remove">

	</div>
</form>

<?php } ?>

    </section>

		<section id="paybox">
			<?php
			if (!empty($_SESSION["add_tocart"])) {
				$sum = 0;
				foreach ($_SESSION["add_tocart"] as $keys => $values) {
					$sum += $values["quizcosts"];
				}
							echo "&#8377 ".$sum;
?>

<form method="post">
	<div id="paybtnbox">
		<input type="submit" id="paybtn" name="pay" value="Pay">
	</div>
</form>

<?php }  else {
	header("Location: resource.php");
 } ?>

		</section>

</main>

  </body>
</html>
