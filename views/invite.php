
<!-- 
  
  Bietet Suche nach Usern (zum Einladen) an
  Wenn man auf ein User klickt und er noch nicht Host oder Teilnehmer ist, wird er eingeladen 

-->

<!doctype html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="invite.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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

      .card{
          width: 80%;
          height: 80%;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <?php 
        require "../classes/DBAccess.php";
    ?>    
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
    </div>
  </div>
  <button type="button" class="btn btn-primary" onclick="window.location.href='signin.php'">Abmelden</button>
</nav>

    
    
    <?php
        $db = new DBAccess();


        if(isset($_REQUEST["gameID"])){
          $gameId = htmlspecialchars($_REQUEST["gameID"]);


          echo "
          
            <form class='search-container' method='POST' action='?'>
                <input type='text' name='searchTerm' class='centered'>
                <input type='hidden' name='gameID' value='" . $gameId . "'>
                <button type='submit' class='btn btn-warning centered'>Search</button>
            </form>

          ";

          
          // Get correct Game id
          if (isset($_REQUEST["toInvite"])){
            $userId = intval(htmlspecialchars($_REQUEST["toInvite"]));
            $db->inviteUserToGame($userId, $gameId);
          }
          
          if (isset($_REQUEST["searchTerm"])){
            $term = htmlspecialchars($_REQUEST["searchTerm"]);
            
            $users = $db->searchUsersLike($term);
            foreach($users as $user){
              echo "
              
              <form action='#' method='POST' class='user-container'>
              <button type='submit' class='btn btn-secondary'>
              <input type='hidden' name='toInvite' value='" . $user['id'] . "'>
              <input type='hidden' name='gameID' value='" . $gameId . "'>
              <p class='float-left padded'>{$user['firstName']}</p>
              <p class='float-right padded'>{$user['email']}</p>
              <p class='float-right padded'>{$user['lastName']}</p>
              
              </button>
              </form>
              
              ";
            }
            
          }
        }
          
    ?>
       
        
  </body>
  
</html>