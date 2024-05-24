<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La tua Pagina</title>
    <style>
     body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 150vh;
    margin: 0;
    color: white;
    font-family: system-ui;
    background-color: rgb(2, 21, 20);
        }
        button 
{
    
  background-color: rgb(43, 127, 113);
    color : black;
    border:color(from color srgb r g b);
    border-radius: 20px;
    cursor: pointer;
    border-width: 5px;
    box-shadow: 10px 10px 10px  rgba(0,0,0,0.5);
    transition :  width 2s,opacity 2s,background-color 2s, color 2s;}
  



button:hover
  {

opacity: 0.8;
background-color: rgb(4, 46, 43);

color : white;
}
</style>
    </head>
    <body>
    
<?php 

session_start(); 
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $database );
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['newusername']) && isset($_POST['newpassword'])) 
{
  $newusername = mysqli_real_escape_string($conn, $_POST['newusername']);
  $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
  $HTMLusername =  $_POST['newusername'];
  $_SESSION['username'] =  $HTMLusername;
  $query = "SELECT * FROM `users` WHERE users.username like '$newusername' ";
  
  // Esegui la query
  $result = $conn->query($query);

  // Verifica se ci sono risultati
  if ($result->num_rows >0) {
  
     echo "<button style = 'color:white;font-size:30px;margin-left:10%; width:  300px;
    height: 300px;'> <a href='forma.html'> Ops... Der Username wurde bereits vergeben,Sie müssen einen neuen Username eingeben Click hier!</a>.</button>";
  }
    
  else 
  {

    $query2 = "INSERT INTO users (username, password) VALUES ('$newusername','$newpassword')";
     $conn->query($query2);
    echo "<button style =style= 'color:white;font-size:30px; margin-left:10%; width:  300px;
    height: 300px;'> <a href='forma.html'> Sie wurden erfolgreich registriert Click hier!</a>.</button>";

  }








}

else{

echo "<p>Passwort oder Username wurden nicht eingegeben</p>";


}

?>
</body>
</html>