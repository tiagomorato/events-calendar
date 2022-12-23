<?php 
include_once "./db.php";
require_once 'club_update.php';

if(!isset($_SESSION['ID'])){
    $UID = 0;
  }
  else {
	$UID = $_SESSION['ID'];
  }

if (isset($_GET['edit'])){
	$edit = 1;
	$club_id = $_GET['edit'];
}else 
{
	$edit = 0;
	$club_id = $_GET['id'];
}

?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Club Info</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body class="is-preload">

		<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
	    <a class="navbar-brand" href="#">CBNU Events Calendar</a>
	    <button class="navbar-toggler" type="button" data-toggle="colla	pse" data-target="#navbarSupportedContent"
	      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav mr-auto">
	        <li class="nav-item">
	          <a class="nav-link" href="./index.php">Home <span class="sr-only"></span></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="event_list.php">Event</a>
	        </li>
	        <li class="nav-item dropdown active">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
	            aria-haspopup="true" aria-expanded="false">
	            Club
	          </a>
	          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <a class="dropdown-item" href="./club_list.php">Club list</a>
	            <a class="dropdown-item" href="./club_create.php">Create club</a>
	          </div>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
	            aria-haspopup="true" aria-expanded="false">
	            Community
	          </a>
	          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <a class="dropdown-item" href="./community_my.php">My community</a>
	            <a class="dropdown-item" href="#">Create community</a>
	          </div>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
	            aria-haspopup="true" aria-expanded="false">
	            My page
	          </a>
	          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <a class="dropdown-item" href="./mypage_participatedLog.php">My profile</a>
	            <a class="dropdown-item" href="./mypage_comment.php">My comments</a>
	            <a class="dropdown-item" href="./log_in.php">Login</a>
				<a class="dropdown-item" href="./sign_in.php">Sign Up</a>
	          </div>
	        </li>
	      </ul>
	      <!--
	            <form class="form-inline my-2 my-lg-0">
	                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	            </form>
	            -->
	    </div>
	  </nav>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">
						<!-- Banner -->
							<section id="banner">
								<div class="content">
								<?php
									//include_once 'dbconfig.php';
									$dbname = "events_calendar";
									//$club_id = $_GET['id'];
									mysqli_select_db($conn, $dbname) or die('DB selection failed');
									$sql = " SELECT *
									FROM club
									WHERE id = $club_id
									";
									$sql2 = " SELECT u.full_name name, u.email
									FROM user AS u, club AS c
									WHERE c.id = $club_id
									AND u.id = c.manager_id
									";
									$result = $conn->query($sql);
									$result2 = $conn->query($sql2);
									$row = mysqli_fetch_array($result);
									$row2 = mysqli_fetch_array($result2);
									$name = $row["name"];
									echo '<header>';
									if ($edit == 1) {
										echo '<form action="club_update.php" method = "POST">';

										echo '<input type = "text" name = "name" value="'.$name.'">';
										echo '<input type = "hidden" name = "club_id" value="'.$club_id.'">';

										
									}else {
									echo '<h1>'.$row["name"].'</h1>';
									}
									echo '</header>';
									echo 'Manager : '.$row2["name"].'<br><br>';
									echo '<p>Open date : '.$row["open_date"].'<br><br>';
									echo 'Contact Us : ';
									echo $row2["email"].'<br>';
									echo '</p>';
									?>
									<ul class="actions">
										<li><a href=<?php echo 'club_members.php?id='.$club_id; ?> class="button big">Club Members</a></li>
									</ul>
									<?php if ($UID == $row['manager_id'] && $edit == 0) { ?>
									<ul class="actions">
										<li><a href="club.php?edit=<?php echo $row['id']; ?>" button class="button big" type = "submit" name = "edit">EDIT</a></li>
									</ul>
									<?php } ?>
									<?php if ($edit == 1) { ?>
									<ul class="actions">
										<li><button class="button big" type = "submit" name = "update">UPDATE</a></li>
									</form>
									</ul>
									<?php } ?>
								</div>
								<span class="image object">
									<img src="images/club<?php echo $club_id;?>.png" alt="" style="width:500px; height:500px;"/>
								</span>
							</section>
							<!-- Section -->
							<?php
								include_once 'dbconfig.php';
								$dbname = "events_calendar";
								mysqli_select_db($conn, $dbname) or die('DB selection failed');
								$sql = "
								SELECT *
								FROM clubHostEvent
								WHERE cid = $club_id
								";
								$result = $conn->query($sql);
							?>
								<section>
									<header class="major">
										<h2>Club's Event</h2>
									</header>
									<div class="features">
										<?php
										while($row = mysqli_fetch_array($result)) {
											echo '<article>';
											echo '<a href ="./event.php?id='.$row["cid"].'">';
											echo '<span class="image object"><img src="images/event'.$row["cid"].'.png" alt="" style="width:100px; height:100px;"/></span>';
											echo '<div class="content">';
											echo '<h3>'.$row["ename"].'</h3>';
											echo '<p>'.$row["edate"].'</p>';
											echo '</div>';
											echo '</a>';
											echo '</article>';	
										}
										?>
									</div>
								</section>

						</div>
					</div>


			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>