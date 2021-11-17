<!doctype html>
<html lang="en">
  <head>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <!-- Bootstrap Vorlage wurde für das erstellen der Login Page verwendet 
     Die Vorlage können Sie unter folgendem Link finden https://getbootstrap.com/docs/5.1/examples/sign-in/
    -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post" action="register.php">
    <h1 class="h3 mb-3 fw-normal"> 🃏	Register 🃏</h1>


    <div class="form-floating">
      <input type="text" class="form-control" id="floatingFirstName" name="firstName" placeholder="Max" required>
      <label for="floatingFirstName">First Name</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingLastName" name="lastName" placeholder="Mustermann" required>
      <label for="floatingLastName">Last Name</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com" required>
      <label for="floatingEmail">Email address</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingEmail2" name="email2" placeholder="name@example.com" required>
      <label for="floatingEmail2">Reenter Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <div class="d-grid gap-3">
        
          <div><button class="w-100 btn btn-lg btn-primary" type="submit">Register</button></div>
             
    </div>

    <p class="mt-5 mb-3 text-muted">&copy; Klingler | Pedersen | Ondra</p>
    
  </form>
</main>

<?php 
if(isset($_REQUEST['firstName']) && isset($_REQUEST['lastName']) && isset($_REQUEST['email']) && isset($_REQUEST['email2']) && isset($_REQUEST['password'])){

  $firstName = htmlspecialchars($_REQUEST['firstName']);
  $lastName = htmlspecialchars($_REQUEST['lastName']);
  $email = htmlspecialchars($_REQUEST['email']);
  $email2 = htmlspecialchars($_REQUEST['email2']);
  $password = htmlspecialchars($_REQUEST['password']);

  if($email == $email2){
    require "classes/DBAccess.php";
    $dbAccess = new DBAccess();

    $dbAccess->createUser($firstName,$lastName,$email,$password);
  }

}
?>

  </body>
</html>
