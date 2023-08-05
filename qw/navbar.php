<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="navbar.css">
    <style media="screen">
    body{
      padding: 0;
      margin: 0;
    }

    #navbar{
      background: #000;
      display: flex;
      justify-content: center;
    }

    #navbar a{
      text-decoration: none;
      color: #fff;
    }

    .navitem{
      color: #fff;
      margin: 0px 5px 0px 5px ;
      padding: 15px;
    }

.hoveff{
  background: #fff;
  color: #000;
}

    </style>
  </head>
  <body>

    <nav id="navbar">
      <a href="../index.php"> <div class="navitem"> Home </div> </a>
      <a href="#"> <div class="navitem"> Blogs </div> </a>
      <a href="#"> <div id="rsc" class="navitem"> Resources </div> </a>
      <a href="#">
        <?php

					if(array_key_exists("id", $_SESSION)){
						echo "<a href='../index.php?logout=1'><div class='navitem'>Log Out</div></a>";
					} else {
						echo "<a href='../getregister.php'><div class='navitem'>Sign Up / Sign In</div></a>";
					}

				?>
       </a>
    </nav>

  </body>
</html>
