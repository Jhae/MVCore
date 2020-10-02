<?php require 'view/tool/viewTools.php';?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
	<style>
			th,td{
			border:solid 3px black;
		}
		table{
			border-collapse: collapse;
		}
	</style>
<h1>MVCore</h1>
<h2>vista: view/indexView.php</h2>
<h2>Variables de URL</h2>
	<table>
		<tr>
			<td>VARIABLE</td>
			<td>VALOR</td>
		<?php foreach ($urlVars as $urlVar => $urlValue): ?>
			<tr>
				<td><?=$urlVar ?></td>
				<td><?=$urlValue ?></td>
			</tr>
		<?php endforeach ?>
		</tr>
	</table>
<br>
<h2>Parámetros GET adicionales</h2>
<br>
<?php var_dump($_GET)?>
<?='<br>------------------<br>'?>
<h2>Parámetros POST adicionales</h2>
<br>
<?php var_dump($_POST)?>

<br>
<a href="<?=route('verificacion',['var1'=>1,'var2'=>2,'var3'=>3]) ?>" target='_blank'> 
	<?=route('verificacion',['var1'=>1,'var2'=>2,'var3'=>3])?>
</a>

<br>
<a href="<?=url('/cliente') ?>"><?=url('/cliente') ?></a>

<br>

</body>
</html>