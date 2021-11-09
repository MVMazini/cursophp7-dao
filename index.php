<?php 

require_once("config.php");

//carrega 1 usuario
// $root  = new Usuario();
// $root->loadById(1);
// echo $root;


//carrega uma lista de usuarios
// $lista = Usuario::getList();
// echo json_encode($lista);

//carrega pelo login
// $login = Usuario::search("m");
// echo json_encode($login);

//Autentica Usuario
// $usuario = new Usuario();
// $usuario->login('i@i','321');
// echo $usuario;

//insert recuperando o usuario inserido
// $novo = new Usuario();
// $novo->setLogin("w@w");
// $novo->setSenha("111");
// $novo->insert();
// echo $novo;

//insert
// $usuario = new Usuario();
// $usuario->insert("beatriz@beatriz","666");

//update usuario
// $usuario = new Usuario();
// $usuario->loadById(3);
// $usuario->update("ciro@ciro","7777");
// echo $usuario;

//deletar usuario

$usuario = new Usuario();
$usuario->loadById(5);
$usuario->delete();
echo $usuario;
 ?>