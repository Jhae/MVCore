<?php

namespace MVCore\Http\Controller;


use MVCore\Model\Usuario;
use MVCore\Http\Router;


class UsuarioController extends Controller {

    const GET_OPERATIONS = ['index'];
    const POST_OPERATIONS = ['create'];
    const DEFAULT_OPERATION = 'index';

    function index() {
        $usuarios = Usuario::all();
        $cantidad_usuarios = $usuarios->count();
        $hay_usuarios = ($cantidad_usuarios > 0);
        $this->view("usuarioView", [
            'clientes' => $usuarios,
            'cantidad_clientes' => $cantidad_usuarios,
            'hay_clientes' => $hay_usuarios,
                ]
        );
    }

    function create() {
        if (isset($_POST["nombre"])) {
            $usuario = new Usuario();
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellido($_POST["apellido"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword(sha1($_POST["password"]));
            $save = $usuario->save();
        }
        $this->Router::redirectToRoute('cliente.index');
    }

    public function destroy() {
        if (isset($_GET["id"])) {
            $id = (int) $_GET["id"];

            $usuario = new Usuario();
            $usuario->deleteById($id);
        }
        Router::redirect('/cliente');
    }

}

?>
