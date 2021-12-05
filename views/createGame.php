<?php session_start() ?>
<!doctype html>
<html lang="en">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Template wurde aus Bootstrap vorlagen kopiert -->

    <title>Spiel erstellen</title>

    

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
          <a class="nav-link active" aria-current="page" href="showFinishedGames.php">Abgeschlossene Spiele</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Einladungen</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container">
  <div class="bg-dark p-5 rounded">
      <h2 class="whiteText">Spiel erstellen</h2>
      <br>
      <form>
          <div class="mb-3">
              <label for="taskName" class="form-label whiteText">Task Name</label>
              <input type="text" class="form-control" id="taskName" name="taskName" required>
          </div>
          <div class="mb-3">
              <label for="taskDescription" class="form-label whiteText">Task Beschreibung</label>
              <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary mb-3">Bestätigen</button>
      </form>
  </div>
</main></br>

<?php
    if(isset($_REQUEST['taskName']) && isset($_REQUEST['taskDescription'])) {
        $taskName = htmlspecialchars($_REQUEST['taskName']);
        $taskDescription = htmlspecialchars($_REQUEST['taskDescription']);

        require "../classes/DBAccess.php";
        $dbAccess = new DBAccess();

        $dbAccess->createPlanningGame($taskName, $taskDescription, $_SESSION["userID"]);
    }
?>


<?php


// mit $_SESSION["variablenname"] können die Sessionvariablen aufgerufen werden
// echo $_SESSION["userEmail"];
// echo $_SESSION["userID"];

?>

      
  </body>
</html>
