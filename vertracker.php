<?php 
 session_start();  // inciamos la session
    // includes
    include('vistas/parciales/cabeza.php');
    include('controladores\conexion.php');
    include('controladores\funciones.php');

        // parse id  
        $id_tracker  = mysqli_real_escape_string($conn , $_GET['id']);
        $id     = $_SESSION['id'];  // includes
        $nombre = $_SESSION['nombre']; 
        $email  = $_SESSION['email']; 

    // nav usert
    include('vistas/parciales/nav_user.php');

    // el sql como un limite de uno
    $query = "SELECT * FROM trackers WHERE id=? LIMIT 1;"; // make query
    $res = secureSQL( $conn , $query , [$id_tracker]); // run query
    if( $res ) { 
        $row = mysqli_fetch_assoc($res); // asociamos a partis del resultado
        $_SESSION['id_tracker'] = $row['id']; // add to session

        // replace breaks
        function replaceLB( $str)
        {
             $buff =  str_replace('\r\n' , '<br>',  $str);
             $buff =  str_replace( '\\r\\n' , '<br>' ,  $buff);
             return $buff;
        }
        // parseamos la descripcion y reemplazamos los caracteres tales
        $descripcion = replaceLB($row['descripcion']);
        $solucion    = replaceLB($row['solucion']);
?>
<!-- construismo el layout a parti de los asociados-->

<section id="display_tracker" class="container">

        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5">
              <!-- <img class="ususario_foto"  src="/public/img/<?php //echo $row['usuario']; ?>/user_pic.png" alt="user"> -->
             <img class="ususario_foto" src="/public/img/pic.png" alt="responsable">
           
             </div>

             <div class="col-sm-12 col-md-7 col-lg-7">
              <h4 class="titulo"><?php echo $row['titulo']; ?></h4>
              <span  class="fecha">Iniciado: ( <?php echo $row['fecha_on']; ?> )</span>
              <br>
              <span class="fecha">Limite : ( <?php echo $row['limite']; ?> )</span>
              <?php 
              // probamos si estamos resueltos             
                  if( $row['estado'] == 'resuelto' )
                  {
                    echo '</br>';
                    echo '<span class="solucion">( '. $row['fecha_close'] .' )</span>';
                    echo '<strong><span class="estado">' . $row['estado'] . '</span></strong>';
                    echo '<span class="fa fa-check"></span>'; 
                  }         
                ?>
             </div>
          </div>
        </div> 
        <!-- fin de la row     -->

        <br>
        
      <div class="row">
        <div class="col">
            <span class="bug" ><strong>Descripcion del Bug</strong></span>
            <p  class="decripcion"><?php echo $descripcion; ?></p>
        </div>
      </div>

      <div class="row">
        <div class="col">
         <?php 
              // probamos si estamos resueltos             
             if( $row['estado'] == 'resuelto' )
             {
              echo '<span class="res" ><strong>Solucion</strong></span>';
              echo '<p class="solucion">'.  $solucion  .'</p>';
             }         
         ?>
       </div>
    </div>

    
    <div class="row">
        <?php 
              // probamos si estamos resueltos             
             if( $row['estado'] == 'resuelto' )
             {
              echo '<button type="button" id="btn_solucion" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Actualizar solucion</button>';
             } else {
              echo '<button type="button" id="btn_solucion" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Ofrecer solucion</button>';
             }
         ?>
        <!-- fin de la btn group -->
    </div>
       
    <!-- // aqui va la captura de la resolucoin si aplica -->
        <?php 
             
            // check capura
             if( strlen(trim($row['captura']))  > 1  )
             {
                // probamos si esta vacio la captura
                // si la captura esta vacia
                if( $row['captura'] == '' || !isset($row['captura']) )
                {
                  echo '';
                } else {
                  echo '<div class="row">
                        <div class="col">
                          <h5>Archivos</h5>
                        </div>
                      </div>';
      
                  // ponemos la imagen de la captura
                  echo ' <div class="row" style="margin : 23px 0;" >
                           <a  href="'. $row['captura'].'" target="__blank">  
                             <img src="/public/img/pic.png"  style=" width: 30%; " alt="imagen"> 
                           </a> 
                         </div>';
                }

              
             }         
         ?>

    <!-- // es una forma dentro de otra forma -->
    <!-- fin de la row -->

    
    <div class="row">
      <form id="forma_up_img" action="/controladores/uploader.php" method="post" enctype="multipart/form-data">
      <input style="display : none;" id="img_selector"  type="file" name="archivo">
      <button class="btn btn-primary" type="button" id="btn_subir_img">Seleccionar Archivo</button>
            <button class="btn" type="submit" name="subir">
                Subir archivo
             </button>
      </form>
    </div>
  
</section>

<!-- aqui va la ventana modal para solucionar el bug -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar solucion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- // este el cuerpo de la modal -->
      <div class="modal-body">
        <form action="/controladores/resolutor.php" method="post">
         <textarea name="resolucion" id="resolucion" cols="50" rows="10"><?php 
          if( $row['estado'] == 'resuelto' )
          {
             echo replaceLB(trim($row['solucion'])); // agregamos al solucion sie xiste con un trim
          }   
          ?></textarea>
             <button type="submit" class="btn primary">Subir solucion</button>   
              <a href="/controladores/eliminador.php" type="button" class="btn btn-secondary">
                  Eliminar Post
              </a>
         </form>
         <!-- fin de la forma -->
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button> -->
      </div>

    </div>
  </div>
</div>

<script>
  // el javascript para subir la imagen
   document.getElementById('btn_subir_img').addEventListener('click', function(e){
    document.getElementById('img_selector').click();  // cliekamso el boton escondido
   });
            document.getElementById('nTrackers').textContent = '(<?php echo $_SESSION['cnt'];?>)'; 
            // el clici con el boton alternativa
            document.getElementById('tFoto').addEventListener('click', function(e){
                        document.getElementById('dFoto').click();
            });

</script>

<?php
} else {
   echo 'problemas';
}
include('vistas/parciales/pie.php');  // el pie con el php
?>