<?php
//$mysqli = new mysqli('localhost:3306','root','rootroot','events_calendar') or die(mysqli_error($mysqli));
include_once 'db.php';
error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
  //$_SESSION['id'] = 1;
  if(!isset($_SESSION['ID'])){
    echo "<script>alert('로그인 하세요.');
    history.back();</script>";
  }
  else {
    $userID = $_SESSION['ID'];
  }

 $months = array();
 $months[0] = 0;
 $months[1] = 0;
 $months[2] = 0;
 $months[3] = 0;
 $months[4] = 0;
 $months[5] = 0;
 $months[6] = 0;
 $months[7] = 0;
 $months[8] = 0;
 $months[9] = 0;
 $months[10] = 0;
 $months[11] = 0;
 $months[12] = 0;


 $i = 1;
 

 $sql = "SELECT CONCAT(YEAR(event.date),'-',MONTH(event.date)) AS d, Count(*) c
        FROM event, participants
        WHERE event.id = participants.event_id AND YEAR(event.date) = 2022 AND participants.user_id = $userID
        GROUP BY d
        ";
 $result = $conn->query($sql); 

 if($result->num_rows>0){
  while($row = $result->fetch_assoc())
  {
    $months[$i] = $row["c"];
    $i = $i + 1;
  }
 }
?>
<header>
</header>
<body>
<div>
  <canvas id="myChart"></canvas>
</div>
</body>
<footer>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var c1 = <?php echo $months[1] ?>;
  var c2 = <?php echo $months[2] ?>;
  var c3 = <?php echo $months[3] ?>;
  var c4 = <?php echo $months[4] ?>;
  var c5 = <?php echo $months[5] ?>;
  var c6 = <?php echo $months[6] ?>;
  var c7 = <?php echo $months[7] ?>;
  var c8 = <?php echo $months[8] ?>;
  var c9 = <?php echo $months[9] ?>;
  var c10 = <?php echo $months[10] ?>;
  var c11 = <?php echo $months[11] ?>;
  var c12 = <?php echo $months[12] ?>;
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['1', '2', '3', '4', '5', '6','7','8','9','10','11','12'],
      datasets: [{
        label: 'Number of event participated 2022',
        data: [c1, c2, c3, c4, c5, c6,c7,c8,c9,c10,c11,c12 ],
        borderWidth: 0.5
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</footer>