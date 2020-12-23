


<?php 
     include('vistas/parciales/cabeza.php');
     session_start();  // inciamos la session

      // parseamos la session
      $nombre = $_SESSION['nombre']; 
      $email  = $_SESSION['email']; 
      $id     = $_SESSION['id'];

      // if some is missing
    if ( !isset($nombre) || !isset($email) || !isset($id)  )
    {
      header('Location: /error.php?mensaje=algo_falta', true, 301);
       die();
    }
      // incluimos
      include('vistas/parciales/nav_user.php');
 ?>

<div id="panel">


    <form class="form forma container" id="forma_crear" method="post" action="/controladores/creador.php"  >

     <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="titulo_tracker">Titulo tracker</label>
            <input type="input" class="form-control verified" name="titulo_tracker" id="titulo_tracker" placeholder="">
          </div>
        </div>

        <div class="col">
        <div class="form-group">
            <label for="fechalimite_tracker">Fecha Limite</label>
            <input type="input" class="form-control verified" name="fechalimite_tracker" id="fechalimite_tracker" placeholder="dd/mm/year">
          </div>
        </div>
     </div>
     <!-- fin de la row -->

    <div class="row">
      
      <div class="col">
        <div class="form-group">
          <label for="typo_tracker">Prioridad</label>
          <select class="form-control verified" name="typo_tracker" id="typo_tracker">
            <option value="baja" selected> Baja </option>
            <option value="media"> Media </option>
            <option value="alta"> Alta </option>
          </select>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="nombre_tracker">Usuario</label>
          <select class="form-control verified" name="nombre_tracker" id="nombre_tracker">
            <option value="<?php echo $nombre; ?>" selected> <?php echo $nombre; ?> </option>
          </select>
        </div>
      </div>

    </div>
    <!-- fin de la row -->

      <div class="form-group">
        <label for="descripcion_tracker">Descripcion</label>
        <textarea class="form-control verified" name="descripcion_tracker" id="descripcion_tracker" rows="3"></textarea>
      </div>

      <div class="row containere">
          <button id="crear_tracker" type="submit" class="btn btn_perfil">Crear tracker</button>
      </div>

    </form>
    <!-- fin forma -->
</div>

<script> 
            // update
            document.getElementById('nTrackers').textContent = '(<?php echo $_SESSION['cnt'];?>)'; 
            
            // la verificacion de la forma 
            var forma_crear = document.getElementById('forma_crear');
            var test = forma_crear.querySelectorAll('.verified');

            // Chek if inputs are empty or undefined
            document.getElementById('crear_tracker').addEventListener('click', function(e){
              test.forEach( function(ele){
                    if( ele.value.trim() === '' || ele === undefined)
                    {
                        ele.style.border = '1px solid red';
                        e.preventDefault(); // prevenimos la subida
                    } else {
                      ele.style.border = '1px solid #444';
                    }
                  });
            });
</script>

<?php include('vistas/parciales/pie.php'); ?>