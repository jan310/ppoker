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
  <form>
    <h1 class="h3 mb-3 fw-normal"> ♣ ♦ Sign In ♠ ♥</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="d-grid gap-3">
      <div><button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button></div>
        <form action="neueseite.html">
         <div>
          <div><button class="w-100 btn btn-lg btn-primary" type="submit">Register</button></div>
         </div>
        </form>     
    </div>

    <p class="mt-5 mb-3 text-muted">&copy; Klingler | Pedersen | Ondra</p>
    
  </form>
</main>


    
  </body>
</html>
