<?php 
session_start();
include_once "./db.php";


$name = "";
$club_id = 0;

if(isset($_POST['update'])){
	$name=$_POST['name'];
	$club_id=$_POST['club_id'];

  
	$sql = "UPDATE club SET name='$name' WHERE id='$club_id'";
    $result = $conn->query($sql);

	$_SESSION['message']="Record has been updated!";
	$_SESSION['msg_type'] ='warning';
	header("location:club_list.php");
  
  }
?>
<h1><?php echo $name ?></h1>