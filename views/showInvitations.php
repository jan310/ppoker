<?php session_start() ?>
<!doctype html>
<html lang="en">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Template wurde aus Bootstrap vorlagen kopiert -->

    <title>Meine Einladungen</title>

    

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
          <a class="nav-link active" aria-current="page" href="showJoinedGames.php">Beigetretene Spiele</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="showFinishedGames.php">Abgeschlossene Spiele</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="showInvitations.php">Einladungen</a>
        </li>
      </ul>
      <button type="button" class="btn btn-primary" onclick="window.location.href='signin.php'">Abmelden</button>
    </div>
  </div>
</nav>

<main class="container">
  <div class="p-5 rounded">
      <h2>Einladungen</h2>
  </div>
</main></br>



<?php
    require "../classes/DBAccess.php";
    $dbAccess = new DBAccess();
    
    if (isset($_SESSION["userID"])){

      
      $userId = $_SESSION["userID"];
      
      function refreshPage(){
        header("Refresh:0; url='showInvitations.php'");
      }
      
      function acceptInvitation($gameId){
        $dbAccess->acceptInvitation($userId, $gameId);
        refreshPage();
      }
      
      function declineInvitation($gameId){
        $dbAccess->declineInvitation($userId, $gameId);
        refreshPage();
      }
      
      if (isset($_POST["declineId"])){
        $dbAccess->declineInvitation($userId, $_POST["declineId"]);
        refreshPage();
      }
      
      if (isset($_POST["acceptId"])){
        $dbAccess->acceptInvitation($userId, $_POST["acceptId"]);
        refreshPage();
      }

      foreach($dbAccess->getInvitations($userId) as $game){
        echo
        "<div class='container bg-dark p-5 rounded'>
          <h2 class='whiteText'>" . $game['userStory'] . "</h2>
          <div class='row'>
            <div class='col-sm'>
              <form method='post' action='#'>
                <input type='hidden' name='acceptId' value='" . $game['gameId'] . "'>
                <button type='submit' class='btn btn-primary mb-3'>Akzeptiere</button>
              </form>
            </div>
            <div class='col-sm'>
              <form method='post' action='#'>
                <input type='hidden' name='declineId' value='" . $game['gameId'] . "'>
                <button type='submit' class='btn btn-primary mb-3'>Ablehnen</button>
              </form>
            </div>
          </div>
        </div>";
      }
      
    }
      
  ?>




<?php


// mit $_SESSION["variablenname"] können die Sessionvariablen aufgerufen werden
// echo $_SESSION["userEmail"];
// echo $_SESSION["userID"];

?>

      
  </body>
</html>
