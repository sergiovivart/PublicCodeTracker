<?php 



//sql seguro
function secureSQL( $hook , $sql, $arr )
{   
    if( $stmt  = $hook->prepare($sql) ) // probamos
    { 
      $types   = str_repeat('s', count($arr));  // hacemos la cantidad de 's'
      $stmt->bind_param($types, ...$arr); //bindeamos los parametros y pasamos el array como si fueran argumentos con '...'
      $stmt->execute();  // ejecutamos
      $resultado = $stmt->get_result(); //obtenemos los resultados
      $stmt->close();  // cerramos
      return $resultado; //retornamos el resutlado de la ejecucion
   }
   return FALSE;   // retornamos
}

// get everythign from user
 function getConfirmacion( $id, $email , $hook)
 {
   $sql  = "SELECT * FROM usuarios WHERE id=? OR email=? LIMIT 1;"; 
   return  secureSQL( $hook , $sql , [$id,$email]);  
 }

// insert new password
 function inUser( $id,$nombre,$email,$pass , $hook)
 {
    $hPass =  password_hash(  $pass, PASSWORD_DEFAULT ); // hacemos el hash
    $sql  = "INSERT INTO usuarios SET id=?,nombre=?,email=?,pass=?;"; //el query
    return  secureSQL( $hook , $sql , [$id,$nombre,$email,$hPass]);  
 }

 // chekeamos el email
 function checkEmail( $email, $hook)
 {
    // selesccionamos segun el email
    $sql  = "SELECT * FROM usuarios WHERE email=? LIMIT 1;"; 
    return  secureSQL( $hook , $sql , [$email]);  
 }

?>