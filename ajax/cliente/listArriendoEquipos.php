<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	arriendo_equipos_datos.IdArriendoEquiposDatos,
	mantenedor_modelo_producto.nombre,
	mantenedor_marca_producto.nombre,
	mantenedor_tipo_producto.nombre
	FROM
	arriendo_equipos_datos
	INNER JOIN inventario_ingresos ON arriendo_equipos_datos.IdProducto = inventario_ingresos.id
	INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id
	INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id
	INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id
	WHERE
		arriendo_equipos_datos.IdServivio = ".$_POST['id'];
	$run = new Method;
	$lista = $run->listView($query);
	echo $lista;
 ?>