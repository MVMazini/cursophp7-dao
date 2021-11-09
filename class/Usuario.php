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

public function setData($data){

	$this->setIdusuario($data['idusuario']);
  $this->setLogin($data['login']);
	$this->setSenha($data['senha']);
	$this->setDtcadastro( new DateTime($data['dtcadastro']));
}

public function loadById($id){
	$sql = new Sql();
	$results = $sql->select("SELECT * FROM usuario where idusuario = :ID ", array(
        ":ID"=>$id
	));

	if(count($results)>0){

        $this->setData($results[0]);
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

     $this->setData($results[0]);       
	}
	else {
		throw new Exception("Login ou senha invalidos");
		
	}

}
//insert recuperando o usuario inserido
// public function insert(){
//   $sql = new Sql();
// 	$results = $sql->select("CALL sp_usuario_insert(:login, :senha)",array(
// 			':login'=>$this->getLogin(),
// 			':senha'=>$this->getSenha()
// 	));

// 	if (count($results)>0){
// 		$this->setData($results[0]);
// 	}	
//}

public function insert($login, $senha){
	$this->setLogin($login);
  $this->setSenha($senha);

	$sql = new Sql();

	$sql->executeQuery("INSERT INTO usuario(login, senha)VALUES(:login,:senha)",array(

		':login'=>$login,
		':senha'=>$senha
	));
}

public function update($login,$senha){
  $this->setLogin($login);
  $this->setSenha($senha);

	$sql = new SQL();

	$sql->executeQuery("UPDATE usuario set login = :login, senha = :senha where idusuario = :id",array(
			':login'=>$this->getLogin($login),
			':senha'=>$this->getSenha($senha),
			':id'=>$this->getIdusuario()

	));
}

public function delete(){

	$sql = new Sql();

	$sql->executeQuery("DELETE FROM usuario where idusuario = :id",array(

		':id'=>$this->getIdusuario()
	));

	$this->setIdusuario(0);
	$this->setLogin("");
	$this->setSenha("");
	$this->setDtcadastro(new DateTime());
}


}

?>