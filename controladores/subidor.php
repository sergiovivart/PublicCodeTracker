<?php 


// fuincion para subri archivos
function subirArchivo( $archivo, $nombre , $destino, $extenciones , $limite )
{
   // parseamo lso datos de los archivos
   $nFile  = $archivo['name']; 
   $tnFile = $archivo['tmp_name'];
   $sFile  = $archivo['size'];
   $eFile  = $archivo['error'];
   $tyFile = $archivo['type'];

  //extension del dato del  jnombre dle arhcivoi
  $xFile = explode('.' , $nFile);
  //vemos la extencion, el ultimo parte dl array
  $acFileEx = strtolower(end($xFile));
   // vemos si la extencion esta en el array de permitidas
   if( in_array( $acFileEx , $extenciones) )
   {
     // si no hay errores en ela archivo
      if( $eFile === 0)
      {
           // si el tamañao es menor que el  limite
           if( $sFile < $limite )
           {
              // hacemos el nombre con la extencion
              $fNombre  = $nombre . '.' . $acFileEx;
              // el destino final, ruta + nombre + extencion
              $fDestino = $destino . '/' . $fNombre;  
              // movemos el archivos del temporal al destino final
               $gate = move_uploaded_file( $tnFile ,  $fDestino );
               // si el uplaod fue bueno
               if( $gate )
               {
                  return $fDestino;  // devolvemos verdad si todo va bien
               } else {
                   return 'error subiendo archivo';
               }
             return 'el arhcivo es demasiado grande';
           }
           return 'error en archivo';
      }
      return 'la extencion no es correcta';
   }
}
// fin de la funciones

?>