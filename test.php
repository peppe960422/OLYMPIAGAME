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
if (isset($_POST['username']) && isset($_POST['password'])) 
{
  // Pulizia dei dati per prevenire SQL injection
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $HTMLusername =  $_POST['username'];
  $_SESSION['username'] =  $HTMLusername;
  $query = "SELECT * FROM `users` WHERE users.username like '$username' AND users.password like '$password'";
  
  // Esegui la query
  $result = $conn->query($query);}

  // Verifica se ci sono risultati
  if ($result->num_rows < 1) {
    die("!!!I ´ll sell ur password on the darkweb :O !!! " . $conn->connect_error);
    
  

  }
  else{ echo"<title>Olympia2024</title>";  ?>

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

    
      body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 150vh;
        margin: 0;
        font-size: 25;
        color: white;
         font-family: system-ui;
         background-color: rgb(2, 21, 20);


        }
        table {
            opacity: 1;
         
            border: 1px solid;
            border-color: #333
            ;
            color: black ;background-color: rgb(4, 46, 43); ;
            border-image: linear-gradient(to right,#3f5f5f ,  rgb(2, 21, 20)) 1;
            border-image-slice: 1;
}
p{

margin-left: 5%;
padding: 0px;
text-shadow: 0 0 740px #91ff91 ;

}

table, th, td {
            border: 1px solid black;  } th, td {
            padding: 2px; }
                          
       
        

        form {
            display: flex;
            flex-direction: column;
            width: 500px;
            padding: 40px;
        }

  
        @keyframes glow {
    0% { text-shadow: 0 0 545px #91ffde; top: 2px ;left: 50px;} 
    50% { text-shadow: 0 0 740px #91ff91 ;top: 2px ;left: 950px; }
    100% { text-shadow: 0 0 545px  #a791ff ;top: 2px ;left: 50px; }}


        #h1 {
              position: absolute;
          	  color: rgb(141, 168, 164);
              text-shadow: 2px 2px 4px #333;
               animation:glow 240s infinite; 
              font-size:70px;
              padding-top: 0px;
           }
           #BtnSpielen {
        margin-left: 5%;
        width: 300px;
        height: 100px;
        padding: 0;
        word-wrap: break-word; 
       
        color: white;
        font-size: 25px;
        
    }
            
        
    </style>
    </style>
</head>

<body>
<h1 id="h1">Hallo, <?php echo $HTMLusername; ?>!</h1>

<p>Mitarbeiter im IT-Bereich zeichnen sich meist nicht durch eine natürliche Neigung zur Leichtathletik aus. 
    Das bedeutet nicht, dass wir das Recht haben, an unseren Olympischen Spielen teilzunehmen</p>


    <button id="BtnSpielen">
    <a style = "color: white ;font-size: 15px" href="indey.html">an der Olympiade teilnehmen!</a>
</button>
    <p></p>
<script>

</script>



 <?php

  $sql = "SELECT users.username,users.points,comments.comment,comments.date FROM `users` 
  INNER JOIN comments ON users.id = comments.userid ORDER BY users.points DESC
        LIMIT 10";


    $result = $conn->query($sql);
    echo "<table style=' margin-top: 150px;margin-left:0'>
      <tr>
      <th style= 'border: 1px solid white;color:rgb(141, 168, 164);;'>Username</th>
      <th style= 'border: 1px solid white;color:rgb(141, 168, 164);;'>Points</th>
      <th style= 'border: 1px solid white;color:rgb(141, 168, 164);;'>Commento</th>
      <th style= 'border: 1px solid white;color:rgb(141, 168, 164);;'>Date</th>
    
  </tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td style= 'border: 1px solid white;color:white;'>" . $row["username"] . "</td>
            <td style= 'border: 1px solid white;color:white;'>" . $row["points"] . "</td>
            <td style= 'border: 1px solid white;color:white;'>" . $row["comment"] . "</td>
            <td style= 'border: 1px solid white;color:rgb(141, 168, 164)'>" . $row["date"] . "</td>
        </tr>";
}


echo "</table>";

} 
 ?>

 


  </body>


</html>

<?php
// Chiudi la connessione dopo aver completato tutte le operazioni
$conn->close();
?>


