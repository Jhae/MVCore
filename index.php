<?php
//Ruta de prueba "MVCore/var1/mama/var2/papa?param=familia"

use MVCore\Http\Router;

require_once 'vendor/autoload.php';
foreach (glob('boot/config/*.php') as $configFile) {
  require_once $configFile;
}
require_once 'routes/web.php';
#Para validar el correcto funcionamiento de Middlewares para la ruta nombrada "verificacion"en "routes/web.php"
 	$_REQUEST['usuario'] = 'usuario@gmail.com';
	$_REQUEST['admin'] = true;
	$_REQUEST['activo'] = true;

$controller=Router::parseURL($_SERVER['REQUEST_URI']);
if ($controller !== null) {
    $controller->launchOperation();
    #Ejecucion de middlewares en el controlador.
    $middlewares =$controller->middlewares;
    $controller->performMiddlewares();
} else
    echo 'NOT DEFINED:'.explode('?', $_SERVER['REQUEST_URI'])[0].'<br>Controller not found or route not defined  :c';

?>
