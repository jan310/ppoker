<?php


class DBAccess
{

    private $conn = NULL;
     
    function __construct() {
        $this->conn = new PDO('mysql:host=localhost;dbname=ppoker', "root", "") or die("db-error");
    }

    // dynamic sql values in form ":name" or "?"
    // $params in format [":name" => value, ...] or [$values, ...] respectively
    private function executeFetchAll($SQL, $params){
        return $this->execute($SQL, $params)->fetchAll();
    }

    private function executeFetchOne($SQL, $params){
        return $this->execute($SQL, $params)->fetch();
    }

    private function executeNoFetch($SQL, $params){
        $this->execute($SQL, $params);
    }

    public function emailInUse($email){
        $emailInUse = $this->executeFetchOne("SELECT email from ppoker.user where email = :email", [":email" => $email]);
        if(!$emailInUse) return false;
        else return true;
    }

    public function getIdByEmail($email){
        $idFitsEmail = $this->executeFetchOne("SELECT id from ppoker.user where email = :email", [":email" => $email]);
        $idFitsEmail = $idFitsEmail["id"];
        return $idFitsEmail;
    }
    
    public function passwordIsValid($id, $password){
        $hash = $this->getPasswordBy($id);
        return password_verify($password, $hash);
    }
    
    public function createUser($firstName, $lastName, $email, $password){
        $hash = $this->hashPassword($password);
        $this->executeNoFetch("INSERT INTO user(firstName, lastName, email, password, registrationDate) VALUES(:firstName, :lastName, :email, :password, CURDATE())",
            [
                ":firstName" => $firstName,
                ":lastName" => $lastName,
                ":email" => $email,
                ":password" => $hash
            ]
        );
    }
    
    private function getPasswordBy($id){
        return $this->executeFetchOne("SELECT password FROM user WHERE id = :id",
            [
                ":id" => $id
            ]
        )["password"];
    }

    private function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function execute($SQL, $params){
        $stmt = $this->conn->prepare($SQL);
        $stmt->execute($params);
        return $stmt;
    }
    
}