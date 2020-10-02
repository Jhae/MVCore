<?php require 'view/tool/viewTools.php';?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h1>MVCORE</h1>
<h2></h2>

<br>
<h2>Variables GET adicionales</h2>
<br>
<?php var_dump($_GET)?>
<?='<br>------------------<br>'?>
<h2>Variables POST adicionales</h2>
<br>
<?php var_dump($_POST)?>

<br><a href="<?=url('/cliente') ?>"><?=url('/cliente') ?></a>

<br>

<a href="<?=route('verificacion',['var1'=>1,'var2'=>2,'var3'=>3]) ?>" target='_blank'> 
	<?=route('verificacion',['var1'=>1,'var2'=>2,'var3'=>3])?>
</a>
<br>

</body>
</html>