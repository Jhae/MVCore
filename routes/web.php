<?php
use MVCore\Http\Router;

#Agregar todas las rutas.

Router::get('/var1/{var1}/var2/{var2}', 'HomeController@index')->name('verificacion')->middleware('auth','admin','activo');
Router::get('/cliente', 'UsuarioController@index')->name('cliente.index');
Router::post('/cliente/add', 'UsuarioController@create')->name('cliente.post');

?>
