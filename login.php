<?php 
  //  los incluidos
    include('vistas/parciales/cabeza.php');
    include('vistas/parciales/navbar.php');
 ?>

  <!-- la forma para logear -->
  <form id="formaLogin" method="post" action="/controladores/logeador.php" class="container form forma">
    <input type="email" class="form-control" name="email" id="email_user" aria-describedby="emailHelp" placeholder="Enter email">
    <input type="password" class="form-control" name="pass" id="pass_user" placeholder="Password">
    <button type="submit" class="btn btn-primary">Log In</button>
  </form>

<?php include('vistas/parciales/pie.php'); ?>