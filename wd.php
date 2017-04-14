<?php 
class Hola{
	public $var1 = 2;
	public function recibir($id)
	{
		$this->id = $id;
		
	}
	public function geter()
	{
		return "Luis\011Ponce";
	}
		
}

$hola = new Hola();
echo $hola->geter();

?>