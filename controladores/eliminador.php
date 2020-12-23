    <?php 
    
    session_start();
    include('conexion.php'); // la conexion

      // some is mnissing
    if( !isset($_SESSION['id']) || !isset($_SESSION['id_tracker']))
    {
        header('Location: ../error.php?falta_informacion'); // redireccionamos
    }
    // simple query
     $query = "DELETE FROM trackers WHERE id='". $_SESSION['id_tracker'] ."';";
    
     // execute and test
    if($conn->query($query))
    {
        header('Location: ../panel.php'); // redireccionamos
    } else {
       header('Location: ../panel.php?error_eliminando_trackers'); // redireccionamos
    }    
?>