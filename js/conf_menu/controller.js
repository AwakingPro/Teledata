$(document).ready(function() {

	$('.listaIntems').html('<div class="spinner loading"></div>');
	$('.listaIntems').load('../ajax/conf_menu/listMunu.php');

});