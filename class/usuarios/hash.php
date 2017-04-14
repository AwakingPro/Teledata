<?php
/*
  * Esta clase solo funciona en PHP 5 >= 5.5.0, PHP 7
*/
class Hash
{
  /*
    * verifica si el password y hash coinciden
  */
  public function verificarHash($password, $hash)
  {
    if (password_verify($password, $hash))
      return $isValid = true;
    else
      return $isValid = false;
  }

  /*
    * convierte un password en hash
    * si el cost viene vacio tomara por defecto el valor 10
  */
  public function convertirHash($password)
  {
    $hash = password_hash($password, PASSWORD_BCRYPT);
    return $hash;
  }

}
?>
