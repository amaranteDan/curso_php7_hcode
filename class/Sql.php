<?php

class Sql extends PDO {

    private $conn;
    //metodo construtor
    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "daniel", "1234");

    }

    private function setParams($statment, $parameter = array()){
        foreach ($parameter as $key => $value){
            $this->setParam($key, $value);
        }

    
    }
    private function setParam($statment, $key, $value){
        $statment->bindParam($key, $value);

    }

    public function query($rawQuery, $params = array()){

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParam($stmt, $params);
        $stmt->execute();

        return $stmt; 

    }

    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

}

?>