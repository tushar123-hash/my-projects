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
	<title>Transaction History</title>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;1,300&family=Roboto:wght@300&display=swap" rel="stylesheet">

	<style type="text/css">
		
		body{
			padding: 0;
			margin: 0;
			font-family: 'Roboto', sans-serif;
		}

		* {
			letter-spacing: 2px;
			line-height: 1.5;
			box-sizing: border-box;
			color: rgba(0, 0, 0, 0.6);
		}

		header{
			background: white;
			padding: 10px;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
		}

		header a{
			text-decoration: none;
			padding: 10px;
		}


		section{
			margin: 60px auto;
			width: 100%;
		}

		table{

			box-shadow: 1px 1px 5px #CCCCCC;
			border-radius: 10px;
			margin: 0 auto;
			width: 70%;
		}

		table, tr, th, td{
			border-collapse: collapse;
			padding: 1em;
		}

		th{
			border-bottom: 2px solid #CCCCCC;
		}

		@media(max-width: 1000px){
			table{
				width: 100%;
				border-radius: 0px;
			}
			table, tr, th, td{
				padding: 10px;
			}
		}
		@media(max-width: 800px){
			table, tr, th, td{
				padding: 2px;
				text-align: left;
			}
		}

	</style>

</head>
<body>

<!-- navigation Bar -->
<header>
	<a href="index.php">Home | Spark Foundation</a>
</header>


<section>
		<!-- main heading -->
		<h1 align="center">Transaction History</h1>

		<table>

			<tr>
				<th>Transfered To</th>
				<th>Recieved From</th>
				<th>Amount</th>
				<th>Date</th>
			</tr>

			<?php  

			$msg = "";
			//Extract transaction history into table
			$sql = "SELECT * FROM transactionhistory";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>
					<td><?php echo htmlspecialchars($row['sentt']); ?></td>
					<td><?php echo htmlspecialchars($row['recievef']); ?></td>
					<td><?php echo htmlspecialchars($row['ramount']); ?></td>
					<td><?php echo htmlspecialchars($row['date']); ?></td>
				</tr>	
			<?php	}	} else { $msg = "No Transactions";}	?>

				<tr>
					<td colspan="4"><span align="center"><?php echo $msg; ?></span></td>
				</tr>			
		</table>
</section>

</body>
</html>