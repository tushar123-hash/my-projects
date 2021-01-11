<!DOCTYPE html>
<html>
<head>
	<title>SPF Bank</title>

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;1,300&family=Roboto:wght@300&display=swap" rel="stylesheet">

	<style type="text/css">

	body{
		font-family: 'Open Sans', sans-serif;
		letter-spacing: 2px;
		line-height: 1.5;
	}

	*{
		padding: 0;
		margin: 0;
		color: rgba(0, 0, 0, 0.5);
	}

	a{
		text-decoration: none;
	}

	header{
		padding: 1em;
		box-shadow: 0px 0px 5px #CCCCCC;
		display: flex;
		justify-content: space-between;
		align-items: center;
		align-content: center;
		border-bottom-left-radius: 5px;
		border-bottom-right-radius: 5px;
	}


	section{
		display: flex;
		justify-content: space-evenly;
		align-items: center;
		align-content: center;
		margin-top: 50px;
	}

	aside{
		flex-basis: 50%;
	}


	#aside1{
		display: flex;
		justify-content: space-evenly;
		align-items: center;
		align-content: center;
	}

	.contentBox img{
		width: 300px;
		height: 300px;
	}


	.contentBox{
		padding: 10px;
		border-radius: 10px;
		box-shadow: 0px 0px 15px #CCCCCC;
		text-align: center;
		opacity: 0.7;
		transition-duration: 0.75s;
	}

	.contentBox:hover{
		opacity: 1;
		color: rgba(0, 0, 0, 0.6);
	}

	#aside2{
		text-align: center;
	}

	#aside2 img{
		width: 80%;
	}

	footer{
		text-align: center;
		position: fixed;
		bottom: 0;
		left: 0;
		right: 0;
		padding: 10px;
		box-shadow: 0px 0px 5px #CCCCCC;
	}

	@media(max-width: 1300px){
		section{
			flex-direction: column;
		}
		#aside1{
			flex-direction: column;
		}

		#aside2{
			display: none;
		}
		.contentBox{
			margin-top: 20px;
			margin-bottom: 40px;
		}
		footer{
			position: relative;
		}
	}

	</style>
</head>
<body>

	<!-- navigation bar -->
	<header>
		<h1>SPF Bank</h1>
		<h2><a href="https://www.thesparksfoundationsingapore.org/">GRIP Task</a></h2>
	</header>
	
	<section>

		<!-- view all user and transaction history box container -->
		<aside id="aside1">
			<!-- view all user option -->
			<a href="transaction.php">
			<div class="contentBox">

				<img src="02_image.png">
				
				<h2>View all user</h2>
			
			</div>
			</a>

			<!-- transaction history option -->
			<a href="transactionHistory.php">
			<div class="contentBox">

				<img src="03_image.png">
				
				<h2>Transaction History</h2>
			
			</div>
			</a>

		</aside>

		<!-- Bank Image -->
		<aside id="aside2">
			
			<img src="01_image.png">

		</aside>

	</section>

	<!-- Footer -->
	<footer>
		<address>
			<!-- Spark Foundation website Link -->
			<a href="https://www.thesparksfoundationsingapore.org/"><h4>The Spark Foundation</h4></a>
			<h4>Banking System Made By Tushar Mathur</h4>
		</address>
	</footer>

</body>
</html>