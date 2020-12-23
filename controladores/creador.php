<?php 

session_start(); // session

// utilities
include('conexion.php');
include('funciones.php');

// parse and secure trackers info
$usuario     = mysqli_real_escape_string( $conn, $_POST['nombre_tracker']);
$typo        = mysqli_real_escape_string( $conn, $_POST['typo_tracker']);
$titulo      = mysqli_real_escape_string( $conn, $_POST['titulo_tracker']); 
$descripcion = mysqli_real_escape_string( $conn, $_POST['descripcion_tracker']);
$fechatope   = mysqli_real_escape_string( $conn, $_POST['fechalimite_tracker']);

// if some is missing
if(!isset($typo)||!isset($typo)||!isset($titulo)||!isset($descripcion)||!isset($fechatope))
{
    header('Location: /crear.php?mensaje=falta_informacion', true, 301); // redireccionamos
}

 // Hacemos la fecha
 $date = getdate();
 $fecha =  $date['mday'] .'/'. $date['mon']  .'/'.  $date['year'];
// el query
$query = "INSERT INTO trackers (fecha_on,estado,usuario,typo,titulo,descripcion,limite) VALUES (?,?,?,?,?,?,?);";
//hacemos el query
secureSQL( $conn , $query, [$fecha,'pendiente',$usuario,$typo,$titulo,$descripcion,$fechatope]); 
header('Location: /panel.php?display=lista', true, 301); // redireccionamos