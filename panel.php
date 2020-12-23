<?php 
    include('vistas/parciales/cabeza.php');
    session_start();  // inciamos la session
    // probamos
    if ( !isset($_SESSION['nombre']) || !isset($_SESSION['email']) || !isset($_SESSION['id']) )
    {
      header('Location: /error.php?mensaje=vital_info_lacking', true, 301);
       die();
    }
     // parseamos si todo va bien
      $nombre = $_SESSION['nombre']; 
      $email  = $_SESSION['email']; 
      $id     = $_SESSION['id']; // actualizamos

      // deseteamos la session
      unset($_SESSION['id_tracker']);
      include('vistas/parciales/nav_user.php');
 ?>

   <!-- aqui va los modos de l disaplayd e los grids -->
  <div class="container">
      <div class="btn-group" role="group">
        <a  href="panel.php?display=lista"  type="button" class="bMode btn btn-primary">
           <span class="fa fa-list-ul"></span>
        </a>
        <a  href="?display=grid"  type="button" class="bMode btn btn-primary">
          <span class="fa fa-th"></span>
        </a>
      </div>
  </div>

  <?php 
  // incluimos la conexion y las funciones
  include('controladores\conexion.php');
  include('controladores\funciones.php');

    $sql  = "SELECT * FROM trackers WHERE usuario=? ORDER BY id DESC;";  // el query
    $buff =  secureSQL( $conn ,$sql , [$id] );  // hacemos 
    $_SESSION['cnt'] = 0; // contador

       // parseamos
       $display = $_GET['display'];

       // swithc para ver si agregamo la clase derow o no al panel
       switch($display){
          case 'lista':
            echo '<div id="panel"  class="container bg f_ubuntu">';
          break;
          default:
            echo '<div id="panel" class="row bg f_ubuntu">';
       }

       //While there is something to assoc
       while( $row = mysqli_fetch_assoc($buff) )
       {          
          $_SESSION['cnt']++; //add to count

          // el display en modo lista
          switch($display){
             case 'lista':
              echo ' <!-- <hr> -->
                    <div class="row item_lista">
                            <div class="col-sm-3 col-md-3 col-lg-3 mayo">
                               <a href="/vertracker.php?id='. $row['id'] .'">
                                  <h2 class="titulo_tracker">'.$row['titulo'].'</h2>
                               </a>
                             </div>
                             <div class="col-sm-2 col-md-2 col-lg-2 mayo">
                               <!-- <img class="ususario_foto"  src="/public/img/' .$row['usuario'] .'/user_pic.png" alt="user"> -->
                               <img class="ususario_foto"  src="/public/img/pic.png" alt="creador">
                               <span class="usuario_lista" >'.$row['usuario'].'</span>
                             </div>
                             <div class="col-sm-1 col-md-1 col-lg-1 mayo">';
                               if($row['limite'] == '' )
                                 {
                                    echo 'N/A';
                                 } else {
                                    echo $row['limite'];
                                 }
                    echo '    </div>
                             <div class="col-sm-2 col-md-2 col-lg-2 mayo"> ';
                                 if($row['estado'] == 'resuelto' )
                                 {
                                     echo $row['estado'].' <span class="fa fa-check"></span>';
                                 } else {
                                     echo $row['estado'].' <span class="fa fa-circle-o"></span>';
                                 }
              echo '         </div>';
 
                 // el condicional para el tup
                 switch ($row['typo']) {
                   case 'alta':
                       echo '<div class="col-sm-2 col-md-2 col-lg-2 mayo alta">';
                       break;
                   case 'media':
                       echo '<div class="col-sm-2 col-md-2 col-lg-2 mayo media">';
                       break;
                   case 'baja':
                       echo '<div class="col-sm-2 col-md-2 col-lg-2 mayo baja">';
                       break;
                 }
                           // add the tipe
                            echo  $row['typo'] . '</div>
                             <div class="col-sm-2 col-md-2 col-lg-2">
                                       <span><strong>Replicable </strong></span>
                             </div>
                         <!-- fin de lalisa -->
                </div>
                <!-- fin de la row      -->';
             break;

             case 'grid':
              echo '<div class="col-sm-12 col-md-4 col-lg-4">';
              switch ($row['typo']) {
                    case 'alta':
                        echo '<div class="card tracker alta">';
                        break;
                    case 'media':
                        echo '<div class="card tracker media">';
                        break;
                    case 'baja':
                        echo '<div class="card tracker baja">';
                        break;
                }
                  echo '<div class="card-body cuerpo_tracker row">
                  

                    <div class="col-sm-5 col-md-5 col-lg-5">
                      <!-- <img class="ususario_foto"  src="/public/img/' .$row['usuario'] .'/user_pic.png" alt="user"> -->
                      <img class="ususario_foto"  src="/public/img/pic.png" alt="creador">
                      <p class="card-text usuario">' . $row['usuario']. '</p> 
                    </div>
                    <div class="col-sm-7 col-md-7 col-lg-7">
                      <a href="/vertracker.php?id='. $row['id'] .'" class="link_tracker">
                        <h5 class="card-title titulo_tracker">'. $row['titulo'] .'</h5>
                      </a>
                      <span class="card-text tipo"> Pr : ('.$row['typo'].')</span>
                    </div>';
                          
                          if($row['estado'] == 'resuelto' )
                          {
                              // echo '<br>';
                              echo  '<span class="estado" >'.$row['estado'].' <span class="fa fa-check"></span>';
                              echo  '<span class="card-text fecha">'.$row['fecha_close'].'</span>';
                          } else {
                              echo  '<span class="estado" >'.$row['estado'].' <span class="fa fa-circle-o"></span></span>';
                          }
                          echo'<p class="card-text fecha">Inicio :  '.$row['fecha_on'] .'</p>
                               <p class="card-text fecha">Limite :' . $row['limite']. '</p>';
                         
                      echo'
                        </div>
                      </div>
                      <!-- fin de la atrgeta -->
                   </div>
                   <!-- fin del grid -->';
                  // fin ed la coplumna
             break;
             default:
             header('Location: /vertracker.php?display=lista', true, 301);  // cabezeras
          }
       }
       // fin 
  ?>
</div>
<!-- fin del panel -->
  <!-- // al final ejecutamos un  javascript para actualizar el numeord e tarckers -->
  <script> 
        document.getElementById('nTrackers').textContent = '(<?php echo $_SESSION['cnt'];?>)'; 
  </script>

<?php include('vistas/parciales/pie.php'); ?>