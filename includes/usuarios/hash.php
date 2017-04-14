<?php
  include('../../class/usuarios/hash.php');
  $objetoHash = new Hash();

  echo "Mi hash generado para 15856585 es: ".$objetoHash->convertirHash('M9a7r5s3A.,2017')."</br></br>";

  if ($objetoHash->verificarHash('111111', '$2y$12$fOVuhjq1WSC4DvAO0g.ejue6iBIbFlGc9tQCgMOU9W7bZFZ.bfmLK'))
    echo '¡La contraseña es válida!';
  else
    echo 'La contraseña no es válida.';

?>
