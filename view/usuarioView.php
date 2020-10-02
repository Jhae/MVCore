<?php require 'view/tool/viewTools.php';?>

<!DOCTYPE html>
<html>
<head>
	<title>CLIENTES </title>
	<style type="text/css">
		th,td{
			border:solid 3px green;
		}
		table{
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<?php if ($hay_clientes): ?>
	<h2>Cantidad de clientes encontrados: <?=$cantidad_clientes ?></h2>
	<table>
		<tr>
			<th>ID</th>
			<th>NOMBRES</th>
			<th>DNI</th>
			<th>APELLIDOS</th>
			<th>PPPOE USUARIO</th>
			<th>DIREECIÓN</th>
			<th>REFERENCIA</th>
			<th>GMAP</th>
			<th>ESTADO</th>
			<th>DISTRITO</th>
			<th>LATITUD</th>
			<th>LONGITUD</th>
		</tr>
		<?php foreach ($clientes as $cliente): ?>
			<tr>
				<td><?=$cliente->id ?></td>
				<td><?=$cliente->nombres ?></td>
				<td><?=$cliente->apellidos ?></td>
				<td><?=$cliente->dni ?></td>
				<td><?=$cliente->pppoe_usuario ?></td>
				<td><?=$cliente->direccion ?></td>
				<td><?=$cliente->referencia ?></td>
				<td>
					<a href="<?=(isset($cliente->gmap) && $cliente->gmap !== '') ? $cliente->gmap : ''?>" target='_blank'>
					<?=(isset($cliente->gmap) && $cliente->gmap !== '') ? 'Ir a mapa' : ''?>
					</a>
				</td>
				<td><?=$cliente->id_cliente_estado ?></td>
				<td><?=$cliente->id_distrito ?></td>
				<td><?=$cliente->gmap_latitud ?></td>
				<td><?=$cliente->gmap_longitud ?></td>
			</tr>
		<?php endforeach ?>
	</table>
	<?php else: ?>
		<h2>No se encontrador registros de clientes.</h2>
	<?php endif ?>
	
</body>
</html>