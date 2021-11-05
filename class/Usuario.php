<?php 

class Usuario{

	private $idusuario;
	private $login;
	private $senha;
	private $dtcadastro;


public function getIdusuario(){
	return $this->idusuario;
}

public function setIdusuario($idusuario){
	$this->idusuario = $idusuario;
}

public function getLogin(){
	return $this->login;
}

public function setLogin($login){
	$this->login = $login;
}

public function getSenha(){
	return $this->senha;
}

public function setSenha($senha){
	$this->senha = $senha;
}

public function getDtcadastro(){
	return $this->dtcadastro;
}

public function setDtcadastro($dtcadastro){
	$this->dtcadastro = $dtcadastro;
}


public function __toString(){
	return json_encode(array(

		"idusuario"=>$this->getIdusuario(),
		"login"=>$this->getLogin(),
		"senha"=>$this->getSenha(),
		"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y m:i:s"),
	));
}

public function loadById($id){
	$sql = new Sql();
	$results = $sql->select("SELECT * FROM usuario where idusuario = :ID ", array(
        ":ID"=>$id
	));

	if(count($results)>0){

       $row  = $results[0];

       $this->setIdusuario($row['idusuario']);
       $this->setLogin($row['login']);
       $this->setSenha($row['senha']);
       $this->setDtcadastro( new DateTime($row['dtcadastro']));
	}
}


public static function  getList(){

	$sql = new Sql();

	return $sql->select("SELECT * FROM usuario ORDER BY login;");
}

public static function search($login){
	
	$sql = new Sql();

    return $sql->select("SELECT * FROM usuario where login LIKE :login ORDER BY login",array(
          
          ":login"=>"%".$login."%"
    ));
}

public function Login($login, $senha){

$sql = new Sql();
	$results = $sql->select("SELECT * FROM usuario where login = :login and senha = :senha", array(
        ":login"=>$login,
        ":senha"=>$senha
	));

	if(count($results)>0){

       $row  = $results[0];

       $this->setIdusuario($row['idusuario']);
       $this->setLogin($row['login']);
       $this->setSenha($row['senha']);
       $this->setDtcadastro( new DateTime($row['dtcadastro']));
	}
	else {
		throw new Exception("Login ou senha invalidos");
		
	}

}

}

?>