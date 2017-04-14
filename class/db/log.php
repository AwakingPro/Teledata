<?php
class Log
{
  public function insertarLog()
  {
    $db = new Db();
    $SqlInsertRecord = "insert into logSistema (Usuario, Telefono) values('".$this->Filename."','".$this->Date."','".$this->Cartera."','".$this->User."','".$this->Phone."')";
    $InsertRecord = $db -> query($SqlInsertRecord);
    if($InsertRecord !== false){
        $ToReturn = true;
    }else{
        $ToReturn = false;
    }
    return $ToReturn;
  }
}
?>
