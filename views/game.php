<?php session_start() ?>

<?php

require "../classes/DBAccess.php";
$dbAccess = new DBAccess();

$gameId = $_REQUEST["gameID"];
$game = $dbAccess->getGameById($gameId); //evtl zu gameInfos bzw gameArray nennen

if(isset($_REQUEST['storyPoints'])){
    $storyPoints = htmlspecialchars($_REQUEST['storyPoints']);
    $dbAccess->setCardValue($gameId,$_SESSION['userID'],$storyPoints);
}

$cardValue = $dbAccess->getCardValue($gameId,$_SESSION['userID']);

?>

<!doctype html>
<html lang="en">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Template wurde aus Bootstrap vorlagen kopiert -->

    <title>GameInterface</title>

    

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="homepage.php">Startseite</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="createGame.php">Spiele erstellen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="showMyGames.php">Meine erstellten Spiele</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Beigetretene Spiele</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Abgeschlossene Spiele</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Einladungen</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container">
  <div class="bg-dark p-5 rounded whiteText">
      <h2><?php echo $game['userStory']; ?></h2><br>
      <h3>Beschreibung der Aufgabe:</h3>
      <p><?php echo $game['description']; ?></p><br>

      <?php
      if ($cardValue == "0") {
          echo "<form method='post' action='game.php' id='form'>
      <label for='storyPoints'>Wahle deine StoryPoints</label>
        <select class='form-select' name='storyPoints' required>
          <option value='1'>1</option>
          <option value='2'>2</option>
          <option value='3'>3</option>
          <option value='5'>5</option>
          <option value='8'>8</option>
          <option value='13'>13</option>
          <option value='21'>21</option>
          <option value='34'>34</option>
          <option value='55'>55</option>
          <option value='89'>89</option>
        </select>
        <input type='hidden' name='gameID' value='" . $gameId . "'>
        <button class='w-100 btn btn-lg btn-primary' type='submit'>Auswahl bestätigen</button>
      </form>";
      }else{
        $array = $dbAccess->getAllParticipationsByGameId($gameId);

        foreach($array as $entry){
          
          $userInfo = $dbAccess->getUserInformationByUserId($entry['userId']);
          echo"<p>{$userInfo['firstName']} {$userInfo['lastName']}, hat folgende Anzahl Story Points gewählt: &emsp; {$entry['card']}</p></br>";

        }  
      }
      ?>

  </div>
</main></br>


<?php

// mit $_SESSION["variablenname"] können die Sessionvariablen aufgerufen werden
// echo $_SESSION["userEmail"];
// echo $_SESSION["userID"];

?>

      
  </body>
</html>
