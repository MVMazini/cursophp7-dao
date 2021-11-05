<?php 

require_once("config.php");

$root  = new Usuario();

$root->loadById(12);

echo $root;
 ?>