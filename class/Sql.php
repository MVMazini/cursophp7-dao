<?php

class Sql extends PDO {

    private $conn;

    public function __construct() {

        $this->conn = new PDO("mysql:host=localhost;dbname=db_teste", "root", "");

    }
   // 3º           recebo o estado da minha query  e os paramentro
    private function setParams($statment, $parameters = array()) {
        //  para cada paramentro eu tenho um chave e valor
        foreach ($parameters as $key => $value) {
              //cada parametro eu passo a chave e o valor
            $this->setParam($statment, $key, $value);    
        }


    }
   //4º
    private function setParam($statment, $key, $value){
       
        $statment->bindParam($key, $value);
        
    }
     
    //2º                    receber minha querey e os parametros
    public function executeQuery($rawQuery, $params = array()) {
                //preparo minha query 
        $stmt = $this->conn->prepare($rawQuery);
               //passo o estado da minha e os parametros para o 2º
         $this->setParams($stmt, $params);
    

        $stmt->execute(); 
       
        return $stmt;
    }
    //1º                  query bruta  , nenhum parametro ainda
    public function select($rawQuery, $params = array()):array
    {   
       // var_dump($rawQuery,$params);
       // exit;
        $stmt = $this->executeQuery($rawQuery, $params);
        

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>
