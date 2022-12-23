<!doctype html>
<head>
  <title>Event List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
<!-- Club header section -->
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
	        <li class="nav-item active">
	          <a class="nav-link" href="event_list.php">Event</a>
	        </li>
	        <li class="nav-item dropdown">
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
  <div class="list-group">
    
    
<?php
	include_once 'dbconfig.php';
	$dbname = "events_calendar";
	mysqli_select_db($conn, $dbname) or die('DB selection failed');
	if(isset($_GET['delete'])){
		$eid=$_GET['delete'];
		$sql="DELETE FROM event WHERE id=$eid";
		$result = $conn->query($sql);
	
		
		header("location:event_list.php");
	}

	$sql = "
		SELECT id, name, date
		FROM event
		ORDER BY date
	";
	$result = $conn->query($sql);
	while($row = mysqli_fetch_array($result)) {
	echo '<a href="./event.php?id='.$row["id"].'" class="list-group-item list-group-item-action flex-column align-items-start">';
	echo '<div class="d-flex w-100 justify-content-between">';
	
	echo '<h5 class="mb-1">' . $row["name"] . '</h5><br>';
	echo '</div>';	
	
	echo '<div class="d-flex w-100 justify-content-between">';
	echo '<h5 class="mb-1">' . $row["date"] . '</h5><br>';
	$eid = $row["id"];
	$sql2 = "
		SELECT c.name cname
		FROM event AS e, host AS h, club AS c
		WHERE e.id = $eid
		AND e.id = h.event_id
		AND h.club_id = c.id
		";
	$result2 = $conn->query($sql2);
	echo '<h5 class="mb-1"><strong>Club : </strong>';
	while($row2 = mysqli_fetch_array($result2)) {
		echo $row2["cname"].'&nbsp&nbsp&nbsp';
	}
	echo '</h5></div>';
	echo '<a href="event_list.php?delete='.$eid.'"class="btn">DELETE</a>';
	}

mysqli_close($conn);
?>    

</body>