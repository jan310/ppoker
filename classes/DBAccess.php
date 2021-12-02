<?php
require "Status.php";

$c = new DBAccess();
echo var_dump($c->acceptInvitation(5, 3));


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

    public function getParticipationId($userId, $gameId){

        $result = $this->executeFetchOne(
            "SELECT participationId FROM participation WHERE userId=:userId AND gameId=:gameId",
            [
                ":userId" => $userId,
                ":gameId" => $gameId
            ]
        );

        if ($result){
            return $result["participationId"];
        }
        else{
            return false;
        }

    }

    public function invitationExists($userId, $gameId){
        $result = $this->executeFetchOne(
            "SELECT status FROM participation WHERE userId=:userId AND gameId=:gameId",
            [
                ":userId"=>$userId,
                ":gameId"=>$gameId
            ]
        );

        if ($result){
            return $result["status"] == Status::INVITED->value;
        }
        else{
            return false;
        }

    }

    public function acceptInvitation($userId, $gameId){
        if ($this->invitationExists($userId, $gameId)){
            $this->executeNoFetch(
                "UPDATE participation SET status=:status WHERE userId=:userId AND gameId=:gameId",
                [
                    ":userId"=>$userId,
                    ":gameId"=>$gameId,
                    ":status"=>Status::JOINED->value
                ]
            );
        }
        else{
            return false;
        }
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