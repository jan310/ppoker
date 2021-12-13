
<!-- 
  
  Nutzer kann sich anmelden

-->

<?php session_start();
  session_unset();
?>
<!doctype html>
<html lang="en">
  <head>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Signin</title>

    <!-- Bootstrap Vorlage wurde für das erstellen der Login Page verwendet 
     Die Vorlage können Sie unter folgendem Link finden https://getbootstrap.com/docs/5.1/examples/sign-in/
    -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post" action="signin.php"> 
    <h1 class="h3 mb-3 fw-normal"> <span id="signIn">♣ ♦ Sign In ♠ ♥</span></h1>
    <h1 class="h3 mb-3 fw-normal" id="errorMessage2"></h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <div class="d-grid gap-2">
      <div><button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button></div>
      
      <div><button class="w-100 btn btn-lg btn-primary" type="button" onclick="window.location.href = 'register.php';">Register</button></div>  
    </div>

    <p class="mt-5 mb-3 text-muted">&copy; Klingler | Pedersen | Ondra</p>
    
  </form>

<?php 

  if(isset($_REQUEST['userEmail']) && isset($_REQUEST['userPassword'])){

    $userEmail = htmlspecialchars($_REQUEST['userEmail']);
    $userPassword = htmlspecialchars($_REQUEST['userPassword']);

    $_SESSION["userEmail"] = $userEmail;

    require "../classes/DBAccess.php";
    $dbAccess = new DBAccess();

    if($dbAccess->emailInUse($userEmail)){
      $userID = $dbAccess->getIdByEmail($userEmail);

      $_SESSION["userID"] = $userID;

      if($dbAccess->passwordIsValid($userID,$userPassword)) echo "<script>window.location.href = 'homepage.php'</script>";
      else {
        echo "<script>document.getElementById('signIn').style.color = 'firebrick'</script>";
        echo "<script>document.getElementById('errorMessage2').style.color = 'firebrick'</script>";
        echo "<script>document.getElementById('errorMessage2').innerText = 'Falsches Passwort.'</script>";
      }
    }else{
      echo "<script>document.getElementById('signIn').style.color = 'firebrick'</script>";
      echo "<script>document.getElementById('errorMessage2').style.color = 'firebrick'</script>";
      echo "<script>document.getElementById('errorMessage2').innerText = 'Falsche Email.'</script>";
    }
  }
  
?>

</main>


    
  </body>
</html>
