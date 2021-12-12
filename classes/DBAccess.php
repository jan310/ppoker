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

    public function createPlanningGame($taskName, $taskDescription, $userID) {
        $this->executeNoFetch("INSERT INTO planninggame(creatorId, userStory, description, creationDate, finished) VALUES(:creatorId, :userStory, :description, CURDATE(), 0)",
            [
                ":creatorId" => $userID,
                ":userStory" => $taskName,
                "description" => $taskDescription
            ]
        );
        $gameID = $this->conn->lastInsertId();
        
        $this->executeNoFetch("INSERT INTO participation(userId, gameId, card, date) VALUES(:userId, :gameId, 0, CURDATE())",
            [
                ":userId" => $userID,
                ":gameId" => $gameID
            ]
        );
    }

    public function getAllCreatedNotFinishedGamesByUserId($userID){
        $array = $this->executeFetchAll("SELECT id, userStory FROM planninggame WHERE creatorId = :userID AND finished = 0", [":userID" => $userID]);
        return $array;
    }

    public function getAllFinishedGames() {
        $array = $this->executeFetchAll("SELECT id, creatorId, userStory, description, creationDate FROM planninggame WHERE finished = 1", []);
        return $array;
    }

    public function setGameFinishedByGameId($gameID) {
        $this->executeNoFetch("UPDATE planninggame SET finished = 1 WHERE id = :gameID", [":gameID" => $gameID]);
    }

    public function getGameById($id) {
        return $this->executeFetchOne("SELECT id, creatorId, userStory, description, creationDate FROM planninggame WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

    public function isGameFinishedById($id) {
        $finished = $this->executeFetchOne("SELECT finished FROM planninggame WHERE id = :id", [":id" => $id]);
        return $finished["finished"];
    }

    public function getAllCardValuesByGameId($id) {
        $cardValues = $this->executeFetchAll("SELECT card FROM participation WHERE gameId = :id", [":id" => $id]);
        return $cardValues;
    }

    public function getCardValue($gameId,$userId){
        $cardValue = $this->executeFetchOne("SELECT card FROM participation WHERE userId = :userId AND gameId = :gameId",
            [
                ":userId" => $userId,
                ":gameId" => $gameId
            ]
        );
        return $cardValue['card'];
    }

    public function setCardValue($gameId,$userId,$cardValue){
        $this->executeNoFetch("UPDATE participation SET card = :card WHERE userId = :userId AND gameId = :gameId",
            [
                ":card" => $cardValue,
                ":userId" => $userId,
                ":gameId" => $gameId
            ]
        );
    }

    public function getAllParticipationsByGameId($gameId){
        $array = $this->executeFetchAll("SELECT userId, gameId, card FROM participation WHERE gameId = :gameId", [":gameId" => $gameId]);
        return $array;
    }

    public function getUserInformationByUserId($userId){
        return $this->executeFetchOne("SELECT firstName, lastName, email FROM user WHERE id = :id", [":id" => $userId]);
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