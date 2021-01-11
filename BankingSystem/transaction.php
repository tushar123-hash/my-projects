<?php  
//connecting to database
	$servername = "servername";
	$username = "username";
	$dbname = "databasename";
	$password = "password";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Transaction</title>	

	<!-- Google fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">	
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;1,300&family=Roboto:wght@300&display=swap" rel="stylesheet">

	<!-- CSS style -->
	<style type="text/css">

		body{
			padding: 0;
			margin: 0;
			background: #DB1D4B;
			font-family: 'Roboto', sans-serif;
		}

		*{
			letter-spacing: 1px;
			line-height: 1.5;
			box-sizing: border-box;
			color: rgba(0, 0, 0, 0.6);
		}

		header{
			background: white;
			padding: 1.5em 0em 1.5em 0em;
		}

		header a{
			text-decoration: none;
			padding: 10px;
		}

		section{
			display: flex;
			justify-content: center;
			align-items: center;
			align-content: center;
			margin: 40px auto;
			width: 95%;
		}

		section div{
			flex-basis: 50%;
			width: 100%;
		}

		table{
			margin: 0 auto;
			background: white;
			border-radius: 10px;
			box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.6);
			width: 95%;
		}

		table, tr, th, td{
			border-collapse: collapse;
			padding: 1em;
		}

		th{
			border-bottom: 2px solid #CCCCCC;
		}

		#transactionBox{
			padding: 1em;
		}

		form{
			box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.6);
			border-radius: 10px;
			width: 100%;
			margin: 0 auto;
			padding: 1em;
			background: #FFF;
		}

		h2{
			text-align: center;
		}

		input{
			width: 100%;
			padding: 1em;
			border: none;
			border-radius: 5px;
			box-shadow: 0px 0px 5px #CCCCCC;
		}

		[type="submit"]{
			background: #DB1D4B;
			color: #FFF;
		}

		@media(max-width: 1000px){
			section{
				flex-direction: column;
			}
			form{
				margin-top: 40px;
			}
			table, tr, th, td{
				padding: 0.5em;
			}
		}

	</style>
</head>
<body>

<!-- navigation bar -->
<header>
	<a href="index.php">Home | Spark Foundation</a>
	<a href="#transactionBox">Transaction</a>
</header>


<section>

<!-- Users List -->
<div id="user-tbl">
	<table>
		<tr>
			<th>S No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Current Balance</th>
		</tr>

			<?php 
				//Extracting user information from database 
				$sql = "SELECT id, name, email, currentBalance FROM transactions";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)){
	
			?>
			<tr>		
				<td><?php echo htmlspecialchars($row['id']); ?></td>
				<td><?php echo htmlspecialchars($row['name']); ?></td>
				<td><?php echo htmlspecialchars($row['email']); ?></td>
				<td><?php echo htmlspecialchars($row['currentBalance']); ?></td>
			</tr>
		
		<?php }} ?>
		
	</table>
</div>

<!-- Transfer Amount -->
<div id="transactionBox">
<?php  

	$uname1 = $uname2 = $amt = $alert = ""; 
	//validation on submit
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$uname1 = test_input($_POST['eml1']);
		$uname2 = test_input($_POST['eml2']);
		$amt = test_input($_POST['amt']);

		if($uname1 !== "" && $amt !== "" && $uname2 !== "") {
			
			// Extract current balance of sender
			$sql1 = "SELECT currentBalance FROM transactions WHERE email='$uname1' LIMIT 1";
			$result1 = mysqli_query($conn, $sql1);

			if(mysqli_num_rows($result1) > 0){
			
				while ($row = mysqli_fetch_assoc($result1)) {
					if (htmlspecialchars($row['currentBalance']) <= 0) {
						$alert = "Sorry you don't have balance for this transaction";
					} else {
						//caluculate new amount
						$newAmt = htmlspecialchars($row['currentBalance']) - $amt;
						// update current balance of sender
						$sql2 = "UPDATE transactions SET currentBalance='$newAmt' WHERE email='$uname1'";
						$result2 = mysqli_query($conn, $sql2);
					}
									
				}			
			}

			// Extract current balance of reciever
			$sql3 = "SELECT currentBalance FROM transactions WHERE email='$uname2' LIMIT 1";
			$result3 = mysqli_query($conn, $sql3);

			if(mysqli_num_rows($result3) > 0){
			
				while ($row = mysqli_fetch_assoc($result3)) {

				//calculate new amount
				$uptAmt = htmlspecialchars($row['currentBalance']) + $amt;
				// update current balance of reciever			
				$sql4 = "UPDATE transactions SET currentBalance='$uptAmt' WHERE email='$uname2'";
				$result4 = mysqli_query($conn, $sql4);	
				}			
			}
			// success transmission message
			$alert = "Amount Rs.$amt has been transfered from $uname1 to $uname2"." <a href='transaction.php' id='btn'>refresh</a>";

		// Inserting transaction in transaction history table
		$sql5 = "INSERT INTO transactionhistory (sentt, ramount, recievef) VALUES('$uname2', '$uname1', '$amt')";
		mysqli_query($conn, $sql5);
		} 	
	}

	// validate input
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


?>	

	<!-- Tranfer amount form -->
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">
	 
	 <h2>Trasnfer Amount</h2>			
 	 <h5>Transfer from:</h5> 
	 <p><input type="email" name="eml1" placeholder="email of sender" required="required"></p>
	 <p><input type="number" name="amt" placeholder="Amount" min="1000" max="40000" required="required"></p>

	 <h5>Transfer to:</h5> 
	 <p><input type="email" name="eml2" placeholder="email of reciever" required="required"></p>

	 <p><input type="submit" name="sbm" value="Transfer"></p>
	 <p id="message"> <?php echo $alert; ?> </p>

	</form>	
</div>

</section>


</body>
</html>