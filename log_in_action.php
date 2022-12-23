<meta charset="utf-8" />
<?php
	session_start();

	$mysqli=new mysqli('localhost:3306','root','rootroot','events_calendar') or die(mysqli_error($mysqli));


	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	// Select a database
	$dbname = "events_calendar";
	$id = $_POST['id'];
	$password = $_POST['password'];

	if($id == "" || $password == ""){
		echo '<script> alert("아이디나 패스워드 입력하세요"); history.back(); </script>';
	}else{

		$result = $mysqli->query("SELECT * FROM user WHERE id ='$id'");
		$row=$result->fetch_array();
		
		if($row['password'] == $password)
		{
			$_SESSION["ID"]=$id;
			echo "<script>alert('로그인되었습니다.'); location.href='./index.php';</script>";
		}
		else{
			echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
		}
	
	}
?>
