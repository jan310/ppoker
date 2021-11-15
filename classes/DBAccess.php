<?php

class DBAccess
{

    private $conn = NULL;
     
    function __construct() {
        $this->conn = new PDO('mysql:host=localhost;dbname=mustermann', "root", "") or die("db-error");
    }

    private function execute($SQL, $params){
        // dynamic sql values in form ":name"
        // $params in format [":name" => value, ...]
        $stmt = $this->conn->prepare($SQL);
        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $value);
        }
        $stmt->execute();
        return $stmt;
    }

    private function executeFetchAll($SQL, $params){
        return $this->execute($SQL, $params)->fetchAll();
    }

    private function executeFetchOne($SQL, $params){
        return $this->execute($SQL, $params)->fetch();
    }

    private function executeNoFetch($SQL, $params){
        $this->execute($SQL, $params)
    }

    public function getThing($param=""){
        return $this->executeFetchAll("SELECT vorname, nachname FROM team WHERE vorname LIKE :name OR bereich LIKE :name",
            [":name" => $param]
        );
    }

    private function getPasswordBy($id){
        return $this->executeFetchOne("SELECT password FROM Users WHERE id = :id",
            [":id" => $id]
        )["password"];
    }

    public function passwordIsValid($id, $password){
        $hash = $this->getPasswordBy($id);
        return password_verify('mypassword', $hash);
    }

    public function createUser($id, $firstName, $lastName, $password){
        $hash = $this->hashPassword($password);
    }

    private function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
}