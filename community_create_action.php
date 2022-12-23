
<meta charset="utf-8" />
<?php

include_once 'dbconfig.php';

// Select a database
$dbname = "events_calendar";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

$name=$_POST['name'];

// Insert a record
$sql = "INSERT INTO club_community (name, opening_date) VALUES('$name', CURRENT_DATE())";

if($conn->query($sql) === TRUE){
	echo "New record created successfully";
	echo "<br/><a href='community_create.php'>Click to go back to the last page !</a>";
}else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
