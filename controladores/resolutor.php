<?php
session_start(); // iniciamos la session

// cargamos
include('conexion.php');
include('funciones.php')

 // estas verificamos el input
 $id         =  mysqli_real_escape_string($conn, $_SESSION['id_tracker']); // el id actual
 $resolucion =  mysqli_real_escape_string($conn, $_POST['resolucion']);

// probamos si la resolucion tiene algo
if( strlen(trim($resolucion)) < 1 ) 
{
     header('Location: /vertracker.php?id='.$id . '&mensaje=' . 'resolucion_vacia', true, 301); 
     die();  // kill
} 

// get and make date
$date = getdate();
$fecha_close = $date['mday'] .'/'. $date['mon']  .'/'.  $date['year'];

// el query que usaremos para los trackers
$query = "UPDATE trackers SET fecha_close=?,solucion=?,estado='resuelto' WHERE id=?  LIMIT 1;";
    secureSQL( $conn , $query , [$fecha_close,$resolucion,$id]);  // actuzlizamos
    header('Location: /vertracker.php?id='.$id, true, 301);  // cabezeras
?>