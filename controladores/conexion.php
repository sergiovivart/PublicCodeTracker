
<!-- conexcion a la abse de datos mysql -->
<?php 

     // databse conection
     $dbServer  = "127.0.0.1";
     $dbUsuario = "root";
     $dbPass    = "";
     $dbNombre  = "bugtracker";

     //conectamos
     $conn = mysqli_connect($dbServer, $dbUsuario, $dbPass, $dbNombre);
?>
