 <?php
$servername = "localhost:3306";
$username = "root";
$password = "rootroot";

// Create connection
$conn = new mysqli($servername, $username, $password,"events_calendar");

// Check connection
if($conn->connect_error){
  die("Connection failed: " + $conn->connect_error);
}
?>
