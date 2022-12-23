<meta charset="utf-8" />
<?php
	session_start();

	$mysqli=new mysqli('localhost:3306','root','rootroot','events_calendar') or die(mysqli_error($mysqli));


	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	// Select a database
	$dbname = "events_calendar";
	
	$id = $_POST['id'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$birthday = $_POST['birthday'];
	$grade = $_POST['grade'];
	$department = $_POST['department'];

$mysqli->query("INSERT INTO user (id,email,password,full_name,birthdate,grade,department) VALUES('$id','$email','$password','$name','$birthday','$grade','$department')") or die($mysqli->error);



?>
<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>