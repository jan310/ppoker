
<!-- 
  
  Leitet an homepage weiter
  Wenn page attribut gesetzt ist, und die Seite in Views existiert, wird an die Seite weitergeleitet

-->

<?php 

//Datenbank Controller
require "classes/DBAccess.php";
$dbAccess = new DBAccess();


// View
if (isset($_REQUEST['page'])) {
    $page=$_REQUEST['page'];
}else{
    $page="signin";
}
// punkte und Slasches entfernen
$page=str_replace(".","",$page);
//$page=str_replace($page,"/","");
$pagePath="views/$page.php";

if(!file_exists($pagePath)){
    $pagePath="views/signin.php"; //TODO Fehlerseite
    $page="signin";
}

header("refresh:0; url='$pagePath'");

