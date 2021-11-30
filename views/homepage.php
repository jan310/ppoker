<?php session_start() ?>
<!doctype html>
<html lang="en">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Template wurde aus Bootstrap vorlagen kopiert -->

    <title>Startseite</title>

    

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
          <a class="nav-link active" aria-current="page" href="#">Meine Spiele</a>
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
  <div class="p-5 rounded">
    <h1>Startseite</h1>
    <p class="lead">Dies ist die Startseite unseres Planning Poker Spiels. Hier können Sie über die Navigationsleiste am oberen Rand des Bildschirms zu 
      allen möglichen Seite dieser Website kommen. Auch können Sie durch betätigen der einzelnen Button durch die Website navigieren.
    </p>
  </div>
</main></br>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h2>Spiele erstellen</h2>
    <p class="lead">Auf der Seite "Spiele erstellen" können Sie durch angabe eines Tasknamens, einer Taskbeschreibung und der zu einladenen Spieler ein Spiel 
      erstellen.
    </p>
    <a class="btn btn-lg btn-primary" href="createGame.php" role="button">Spiele erstellen &raquo;</a>
  </div>
</main></br>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h2>Meine Spiele</h2>
    <p class="lead">Unter "Meine Spiele" finden Sie alle Spiele die Sie jemals eröffnet haben, außer Sie haben diese gelöscht oder die Spiele sind bereits abgeschlossen.
    </p>
    <a class="btn btn-lg btn-primary" href="../components/navbar/" role="button">Meine Spiele &raquo;</a>
  </div>
</main></br>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h2>Beigetretene Spiele</h2>
    <p class="lead">Auf der Seite "Beigetretene Spiele" finden Sie alle Spiele denen Sie jemals beigetreten sind, außer Sie haben diese gelöscht oder diese sind bereits abgeschlossen.
    </p>
    <a class="btn btn-lg btn-primary" href="../components/navbar/" role="button">Beigetretene Spiele &raquo;</a>
  </div>
</main></br>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h2>Abgeschlossene Spiele Spiele</h2>
    <p class="lead">Auf der Seite "Abgeschlossene Spiele" finden Sie alle Spiele denen Sie jemals beigetreten sind und bereits abgeschlossen wurden.
    </p>
    <a class="btn btn-lg btn-primary" href="../components/navbar/" role="button">Abgeschlossene Spiele &raquo;</a>
  </div>
</main></br>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h2>Einladungen</h2>
    <p class="lead">Auf der Seite "Einladungen" werden Ihnen die Spiele angezeigt zu denen Sie eingeladen wurden. Diese können Sie annehmen oder ablehnen.
    </p>
    <a class="btn btn-lg btn-primary" href="../components/navbar/" role="button">Einladungen &raquo;</a>
  </div>
</main></br>


<?php


// mit $_SESSION["variablenname"] können die Sessionvariablen aufgerufen werden
// echo $_SESSION["userEmail"];
// echo $_SESSION["userID"];

?>

      
  </body>
</html>
