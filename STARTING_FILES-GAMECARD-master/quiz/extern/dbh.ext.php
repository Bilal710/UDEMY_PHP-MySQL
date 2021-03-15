<?php 

    // Connection à la Base de Données avec mysqli_connect()
    
    $servername = "localhost"; // nom du serveur local 
    $username = "root";
    $password = "";
    $dbName = "dbgamecard";  // Nom de la BDD

    $conn = mysqli_connect($servername,$username,$password,$dbName);

    if(!$conn){
        die("Connection Failed".mysqli_connect_error());
    }

?>