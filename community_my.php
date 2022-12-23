<!doctype html>
<!-- navbar: https://getbootstrap.com/docs/4.0/components/navbar/  -->

<head>
  <title>My Community</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
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
	        <li class="nav-item dropdown active">
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
<!-- Club header section -->
  <div class="list-group">
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">

<?php
include_once 'dbconfig.php';
$dbname = "events_calendar";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}else{
  // echo "Connection successful!<br>";	
}


// get club name
$sql_club_name = "
	SELECT name
	FROM club_community
	WHERE id = 1
";
$result_club_name = $conn->query($sql_club_name);
$row_club_name = mysqli_fetch_array($result_club_name);


echo "<h5 class='mb-1'><strong>Club name: </strong>" .$row_club_name["name"]. "</h5>";
echo "</div>";


// get manager
$sql_manager = "
	SELECT full_name
	FROM user
	JOIN club
	ON user.id = club.manager_id
	WHERE club.id = 1
";
$result_manager = $conn->query($sql_manager);
$row_manager = mysqli_fetch_array($result_manager);

echo "<p class='mb-1'><strong>Club manager: </strong>" .$row_manager["full_name"]. "</p>";


// get amount of members
$sql_count = "
	SELECT COUNT(*) as count_user
	FROM user
	JOIN user_and_community
	ON user.id = user_and_community.user_id
	WHERE community_id = 1
	";

$result_count = $conn->query($sql_count);
$row_count = mysqli_fetch_array($result_count);


// get members
$sql_member = "
	SELECT full_name
	FROM user
	JOIN user_and_community
	ON user.id = user_and_community.user_id
	WHERE community_id = 1
	";
$result_member = $conn->query($sql_member);
$row_member = mysqli_fetch_array($result_member);

echo "<strong>Club members (" . $row_count['count_user'] . "):</strong> ";
if($result_member->num_rows > 0){
	// output data of each row
	while($row_member = $result_member->fetch_assoc()){
	echo $row_member["full_name"] . ", ";
	}
}else{
	echo "0 results";
}

// ## Comments section ## 

// get authors and comments
$sql_comment = "
	SELECT full_name, content
	FROM user, post
	WHERE user.id = post.author
	AND community_id = 1
";

$result_comment = $conn->query($sql_comment);
$row_comment = mysqli_fetch_array($result_comment);


// echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">';
// echo '<div class="d-flex w-100 justify-content-between">';

if($result_comment->num_rows > 0){
	// output data of each row
	while($row_comment = $result_comment->fetch_assoc()){
	echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">';
	echo '<div class="d-flex w-100 justify-content-between">';
	echo '<h5 class="mb-1"><strong>Author:</strong> ' .$row_comment["full_name"]. '</h5>';
	echo '</div>';
	echo '<p class="mb-1"><strong>Comment:</strong> <br>' .$row_comment["content"]. '</p>';
	echo '</p>';
	}
}
echo '</a>';
echo '</div>';
mysqli_close($conn);
?>    



  <form method="post" action="my_community_action.php">
    <div class="form-group">
      <br><h5><label for="exampleFormControlTextarea1"><strong>Type your comment here:</strong></label></h5>
      <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
    </div>

    <div class="text-center">
        <input class="btn btn-primary" type="submit" value="Add comment">
    </div>

  </form>
</body>
