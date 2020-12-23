<?php
 //empezamos la session
 session_start();

 // cargamos utilidades
 include('conexion.php');
 include('funciones.php');
 include('subidor.php'); 


 // 
  if(isset($_POST['subir'])) { //verificamos que clikearon el boton para subir la forma
                   
                    // get file
                    $archivo = $_FILES["archivo"]; 
                    $uNombre = uniqid('', true);  // make name
                    // make path
                    $destino = '../public/img/'.$_SESSION['id'].'/';
                    // upload file
                    $res = subirArchivo( $archivo , $uNombre, $destino, ['jpg','png','pdf'], 5000000);
                   // test if true
                    if( $res ) 
                    {
                        $fDestino = substr($res,2);   // fix string
                        $sql  = "UPDATE trackers SET captura=? WHERE id=? LIMIT 1;";  // sql query
                        secureSQL( $conn , $sql , [$fDestino , $_SESSION['id_tracker']]); // update capture
                        header('Location: ../vertracker.php?id='.$_SESSION['id_tracker'] . '&res=' . $res); // redirect
                    } else { 
                        header('Location: ../perfil.php?mensaje=error_subiendo_archivo&res=' . $res);
                    }
                    // fin condicional
}
// end of function

?>