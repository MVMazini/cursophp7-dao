<?php 

require_once("config.php");

//carrega 1 usuario
// $root  = new Usuario();
// $root->loadById(12);
// echo $root;


//carrega uma lista de usuarios
// $lista = Usuario::getList();
// echo json_encode($lista);

//carrega pelo login
// $login = Usuario::search("m");
// echo json_encode($login);

//Autentica Usuario
$usuario = new Usuario();
$usuario->login('i@i','321');
echo $usuario;

 ?>