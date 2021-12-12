
   

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

    <form class="search-container" method="POST" action="#">
        <input type="text" name="searchTerm" class="centered">
        <button type="submit" class="btn btn-warning centered">Search</button>
    </form>
    
    <?php
        $db = new DBAccess();
        $gameId = 3;
        // Get correct Game id
        if (isset($_GET["toInvite"])){
            $userId = intval($_GET["toInvite"]);
            $db->inviteUserToGame($userId, $gameId);
        }

        if (isset($_POST["searchTerm"])){
            $term = $_POST["searchTerm"];
    
            $users = $db->searchUsersLike($term);
            foreach($users as $user){
                echo "
                
                <form action='?toInvite={$user['id']}' method='POST'>
                    <button type='submit' class='btn btn-secondary'>
                        <p >{$user['firstName']}</p>
                        <p>{$user['lastName']}</p>
                    </button>
                </form>
                
                ";
            }

        }

    ?>
       
        
  </body>
  
</html>
