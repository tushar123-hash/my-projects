
<?php
session_start();

if(array_key_exists("logout", $_GET)){
	session_unset();
	if(session_destroy()){
		header("Location: index.php");
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Gradili</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>

<!-- ========================SECTION-1==================== -->

	<section id="section_1">

		<header id="header">

		<!-- LOGO IMAGE -->
		<div id="logo">
			<span class="logoD gcolor">G</span>
			<span class="logoD rcolor">R</span>
			<span class="logoD acolor">A</span>
			<span class="logoD dcolor">D</span>
			<span class="logoD icolor">I</span>
			<span class="logoD lcolor">L</span>
			<span class="logoD icolor">I</span>
		</div>

		<!-- Navigation Bar -->
			<nav>
				<ul>
					<a href="#">
						<li> Home</li>
					</a>

					<a href="blog/blog.html">
						<li>Blogs</li>
					</a>

					<a href="resource/resource.php">
						<li>Resources</li>
					</a>

				<?php

					if(array_key_exists("id", $_SESSION)){

						echo "<a href='createrprofile.php'><li>Creator</li></a>";

						echo "<a href='dashboard/userpage.php'><li>Dashboard</li></a>";

						echo "<a href='index.php?logout=1'><li>Log Out</li></a>";
					} else {
						echo "<a href='getregister.php'><li> Sign Up / Sign In</li></a>";
					}

				?>

				</ul>

			</nav>

		</header>

		<div id="top_course_box">

			<div id="effectText"></div>

			<a href="#">
				<div id="topCourse">

					<video autoplay muted loop>
						<source src="image/crs1.mp4" type="video/mp4">
					</video>

					<ul>
						<li>Well Explained</li>
						<li>Self Paced course</li>
						<li>Resources and references</li>
					</ul>

					<div id="bottomLine">Let's Start !</div>

				</div>

			</a>

		</div>

	</section>

<!-- ========================SECTION-1 END==================== -->


<!-- ========================SECTION-2=============================-->

<section id="section_2">

		<div id="wspcr">


			<div class="wspcrFlex">
				<img src="image/bkImg.png" alt="">
				<ul>
					<li>Learn at your own pace</li>
					<li>Less Time, More Learning</li>
					<li>No time exhausting videos</li>
					<li>
						<span>#Self-paced</span>
						<span>#course</span>
						<span>#LearnFaster</span>
					</li>
				</ul>
			</div>


			<div class="wspcrFlex" id="wscprFlex2">

				<ul>
					<li>Stay updated about new technologies</li>
					<li>Learn from other people experiences</li>
					<li>Be job ready</li>
					<li>
						<span>#Self-paced</span>
						<span>#course</span>
						<span>#LearnFaster</span>
					</li>
				</ul>
				<img src="image/vr.png" alt="">

			</div>

		</div>

	</section>

<!-- ========================SECTION-2 END=============================-->



<!-- ========================SECTION-3=============================-->

<section id="section_3">

		<div id="recommedCourse">
			<!-- image of book -->
			<img src="bookImg.png" id="bookImg">

			<div id="courseList">

				<div id="clb1" class="courseListBox clb1">
					<img src="image/networkC.png" class="CLBimg">
					<p class="CLtitle">Take a tour</p>
				</div>

				<div id="clb2" class="courseListBox clb2">
					<img src="image/nodec.png" class="CLBimg">
					<p class="CLtitle">Coding is fun.</p>
				</div>

				<div id="clb3" class="courseListBox clb3">
					<img src="image/gitc.png" class="CLBimg">
					<p class="CLtitle">Coding is fun.</p>
				</div>

				<div id="clb4" class="courseListBox clb4">
					<img src="image/phpc.png" class="CLBimg">
					<p class="CLtitle">Coding is fun.</p>
				</div>


			</div>
		</div>
	</section>

<!-- ========================SECTION-3 END=============================-->


<!-- ========================SECTION-4=============================-->

<section id="section_4">

		<div id="graph">
			<table>
				<tr>
					<th>React</th>
					<td>
						<div id="p_bar1" class="bar"></div>
					</td>
				</tr>

				<tr>
					<th>Angular</th>
					<td>
						<div id="p_bar1" class="bar"></div>
					</td>
				</tr>


				<tr>
					<th>Vue</th>
					<td>
						<div id="p_bar1" class="bar"></div>
					</td>
				</tr>

				<tr>
					<th>JQuery</th>
					<td id="lstd">
						<div id="p_bar1" class="bar"></div>
					</td>
				</tr>

			</table>
		</div>

		<div id="quiz">
			<div id="quizBox">
				<h4>Which technology brought you here? </h4>
				<form>
					<p><label> <input type="radio" name="vote1"> React </label></p>
					<p><label> <input type="radio" name="vote1"> Angular </label></p>
					<p><label> <input type="radio" name="vote1"> Vue </label></p>
					<p><label> <input type="radio" name="vote1"> JQuery </label></p>
					<p><input type="submit" id="voteBtn" name="vote" value="Vote"></p>
				</form>
			</div>
		</div>

	</section>

<!-- ========================SECTION-4 END=============================-->



<!-- ========================SECTION-5=============================-->

	<section id="section_5">

		<div id="blogBox">
			<h2>Blogs</h2>
			<a href="#">
				<div class="blogsTitle">
					<h5>JavaScript is about to rock the web </h5>
					<h6>Dec 2021</h6>
				</div>
			</a>

			<a href="#">
				<div class="blogsTitle">
					<h5> No more frustating codes </h5>
					<h6>Dec 2021</h6>
				</div>
			</a>

			<a href="#">
				<div class="blogsTitle">
					<h5> coding a habit to develop</h5>
					<h6>Dec 2021</h6>
				</div>
			</a>

			<a href="#">
				<div class="blogsTitle">
					<h5> Never use this function </h5>
					<h6>Dec 2021</h6>
				</div>
			</a>

			<a href="#">
				<div class="blogsTitle">
					<h5> Learning to code in the fastest world </h5>
					<h6>Dec 2021</h6>
				</div>
			</a>

			<a href="#">
				<div class="blogsTitle">
					<h5> Making a dynamic website in php </h5>
					<h6>Dec 2021</h6>
				</div>
			</a>

			<a href="#">
				<div id="moreBlogBtn">
					<h5> Show All </h5>
				</div>
			</a>

			<h5 id="msg">- Happy Reading</h5>
		</div>

	</section>

<!-- ========================SECTION-6 END=============================-->


<!-- ========================SECTION-7=============================-->

	<section id="section_7">

		<div id="otherContact">
			<div>
				<table>
					<tr>
						<td>Gradili21@gmail.com</td>
					</tr>

					<tr>
						<td>India</td>
					</tr>

					<tr>
						<td>8098980890</td>
					</tr>

				</table>
			</div>


			<div id="socialConnect">
				<h5>Join Us</h5>
				<div id="socialConBox">
					<a href="#"><span>Facebook</span></a>
					<a href="#"><span>Twitter</span></a>
					<a href="#"><span>Instagram</span></a>
					<a href="#"><span>Telegram</span></a>
				</div>
			</div>

			<div>
				<ul type="none">
					<li>Product</li>
					<li>Career</li>
					<li>News</li>
					<li>Services</li>
					<li><a href="about/index.html"> About </a></li>
				</ul>
			</div>

		</div>
	</section>

<!-- ========================SECTION-7 END=============================-->

	<script type="text/javascript" src="index.js"></script>

</body>

</html>
