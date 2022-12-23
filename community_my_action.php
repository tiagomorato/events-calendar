<meta charset="utf-8" />
<?php

include_once 'dbconfig.php';

// Select a database
$dbname = "events_calendar";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

$content = $_POST["content"];

// Insert a record
$sql =	"INSERT INTO post(author, content, community_id) 
		VALUES(1, '$content', 1)";

if($conn->query($sql) === TRUE){
	echo "New record created successfully";
	echo "<br/><a href='my_community.php'>Click to go back to the last page !</a>";
}else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
