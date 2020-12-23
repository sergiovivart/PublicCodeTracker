<?php 
include('conexion.php'); // conectamos

$email = mysqli_real_escape_string($conn,$_POST['email']);
$pass  = mysqli_real_escape_string($conn,  $_POST['pass']);

// si alguno falla
if( !isset($email) || !isset($pass))
{
    header("Location : /error.php"); // redirecccionamos
    die(); // kill
}

include('funciones.php');           // incluimos 
$buff = checkEmail($email , $conn); // chekeamos el email
$test = mysqli_num_rows($buff);     // numero filas

// no encontramos
if ( $test == 0)
{
    header('Location: /error.php?usuario_no_encontrado', true, 301); // redireccionamos
} 
      /// de otra forma
      $row   = mysqli_fetch_assoc($buff);
      //verificamos el pasword 
      $llave = password_verify( $pass , $row['pass']); 
      if( $llave == 1)
      { // si es correcto
          session_start(); // iniciamos session
          // parse the session
          $_SESSION['nombre'] = $row['nombre'];
          $_SESSION['email']  = $row['email']; 
          $_SESSION['id']     = $row['id'];
           header('Location: /panel.php?display=lista', true, 301);  // redireccinamos
      } else { // si no lo es
        header('Location: /error.php?failed_login', true, 301); 
      }

?>