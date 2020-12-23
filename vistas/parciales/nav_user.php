
<!-- La barra del perfil -->
<nav  id="nav_user" class="navbar navbar-expand-lg navbar-light bg-light container f_varela">
  <a class="navbar-brand" href="#">Alki Code Tracker</a>

  <button id="trigger_menu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul id="barra_nav_user" class="navbar-nav ml-auto">
       <!-- fin de lista de componentes -->
       <li class="nav-item">
            <a class="nav-link link-panel" href="panel.php?display=lista">Trackers <span id="nTrackers"></span> </a>
         </li>
         <li class="nav-item">
            <a class="nav-link link-crear" href="crear.php">Crear</a>
         </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img id="imagen_user" src="/public/img/pic.png" alt="pic"/>
           <?php echo $id; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/controladores/salir.php">Salir</a>
        </div>
      </li>
      <!-- fin del item -->
    </ul>
 </div>
 <!-- fin de la barrad e navegacion -->

</nav>
