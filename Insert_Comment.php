
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<style>
  body {
    align-items: center; 
    background-color: rgb(2, 21, 20);

  }
#startpage{

  margin-left: 20%;
   margin-top: 20%;
  background-color: rgb(43, 127, 113);
    color : black;
    border:color(from color srgb r g b);
    border-radius: 20px;
    cursor: pointer;
    border-width: 5px;
    box-shadow: 10px 10px 10px  rgba(0,0,0,0.5);
    transition :  width 2s,opacity 2s,background-color 2s, color 2s;}
  



    #startpage:hover
  {

opacity: 0.8;
background-color: rgb(4, 46, 43);

color : white;
}
#startPageBtn{
  height: 30px ;
  width:100px;
  margin-left: 45%;
   margin-top: 20%;
  background-color: rgb(43, 127, 113);
    color : black;
    border:color(from color srgb r g b);
    border-radius: 20px;
    cursor: pointer;
    border-width: 5px;
    box-shadow: 10px 10px 10px  rgba(0,0,0,0.5);
    transition :  width 2s,opacity 2s,background-color 2s, color 2s;}


    #startPageBtn:hover
  {

opacity: 0.8;
background-color: rgb(4, 46, 43);}


</style>
</head>
<body>
    <p></p>
    <p id= "startPageBtn"> <a id= "startpage" href="forma.html">Click hier</a>.</p>
</body>
</html>
<?php 
session_start(); 
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "test";
error_reporting(0);
ini_set('display_errors', 0);

// Create connection
$conn = new mysqli($servername, $username, $password, $database );

global $_SESSION;
$user = $_SESSION['username'];

$comment =  $_POST['comment'];

$punkte = isset($_GET['punkte']) ? $_GET['punkte'] : '';

$currentDate = date("Y-m-d");




$query = "SELECT id FROM `users` WHERE users.username like '$user'; ";

  // Esegui la query
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row['id'];

    $controllaCommento =  "SELECT * FROM comments WHERE comments.userid like '$userId' ";
    $result2 = $conn->query($controllaCommento);
    if ($result2->num_rows > 0){
      $updateCommento =  "UPDATE comments
      SET comment = '$comment',
      date = '$currentDate'
      WHERE userid = $userId;";
    $conn->query($updateCommento);

    } 
    else {
   $sql = "INSERT INTO comments (userid, comment,date) 
   VALUES ('$userId','$comment','$currentDate');";
    $conn->query($sql);
  }
  $sql2 = "UPDATE users
  SET points = $punkte
  WHERE id = '$userId' ";
  $conn->query($sql2);
  
 

  }

  $conn->close();
?>
  </body>


</html>