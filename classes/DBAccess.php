<?php
require "Status.php"

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
    
    public function passwordIsValid($id, $password){
        $hash = $this->getPasswordBy($id);
        return password_verify($password, $hash);
    }


    public function inviteUserToGame($userId, $gameId){
        $this->executeNoFetch("INSERT INTO participation(userid, gameid, date, status) VALUES(:userId, :gameId, CURDATE(), :status)",
            [
                ":userId"->$userId,
                ":gameId"->$gameId,
                ":status"->Status::INVITED->value
            ]
        );
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