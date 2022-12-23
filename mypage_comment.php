<?php
include_once 'db.php';
//$mysqli = new mysqli('localhost:3306','root','rootroot','events_calendar') or die(mysqli_error($mysqli));
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
?>

<style type="text/css">

#clicked{
    padding-top: 1px;
    padding-bottom: 1px;
    text-align: center;
    width: 100%;
    background-color: #ecb21f;
    border-color: #a88734 #9c7e31 #846a29;
    color: black;
    border-width: 1px;
    border-style: solid;
    border-radius: 13px; 
}

#post{
    margin: 10px;
    padding: 6px;
    padding-top: 2px;
    padding-bottom: 2px;
    text-align: center;
    background-color: #ecb21f;
    border-color: #a88734 #9c7e31 #846a29;
    color: black;
    border-width: 1px;
    border-style: solid;
    border-radius: 13px;
    width: 50%;
}

body{
    background-color: black;
}
.comments{
    margin-top: 5%;
    margin-left: 20px;
  }

.darker{
    border: 1px solid #ecb21f;
    background-color: black;
    float: right;
    border-radius: 5px;
    padding-left: 40px;
    padding-right: 30px;
    padding-top: 10px;

}

.comment{
    border: 1px solid rgba(44, 65, 252, 1);
    background-color: rgba(44, 65, 252, 0.973);
    float: left;
    border-radius: 5px;
    padding-left: 40px;
    padding-right: 30px;
    padding-top: 10px;
    padding-bottom: 10px;
    margin-bottom: 10px;
}
.comment h4,.comment span,.darker h4,.darker span{
    display: inline;
}

.comment p,.comment span,.darker p,.darker span{
    color: rgb(184, 183, 183);
}
h1{
  color:black;
  font-weight: bold;
}
h4{
    color: white;
    font-weight: bold;
}
label{
    color: rgb(212, 208, 208);
}

#align-form{
    margin-top: 20px;
}
.form-group p a{
    color: white;
}


.form-group input,.form-group textarea{
    background-color: black;
    border: 1px solid rgba(16, 46, 46, 1);
    border-radius: 12px;
}

form{
    border: 1px solid rgba(16, 46, 46, 1);
    background-color: rgba(16, 46, 46, 0.973);
    border-radius: 5px;
    padding: 20px;
 }
</style>
<!-- Main Body -->
<!DOCTYPE html>
<html lang="ko">
<header>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</header>
<body>
    
<section>
    <?php
    $sql = "(
    SELECT content AS content FROM post WHERE id = '$userID' 
    UNION ALL 
    SELECT review AS content FROM review WHERE id = '$userID')";
    $result = $conn->query($sql); 
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 pb-4">
                <h1>Comments</h1>
                <?php while($row = mysqli_fetch_array($result)){
                ?>
                <div class="comment mt-4 text-justify float-left">
                    <p><?php echo $row['content']; ?></p>
                </div>
                </div>     
            </div>
            <?php } ?> 
          </div>
        </div>
        <?php mysqli_close($conn);?>
</section>
</body>
</html>