<?php 
// Daten-"Model"
require "classes/PPokerData.php";
$model = new PPokerData();

// Shop-"Controller"
require "classes/PPokerActions.php";
$controller = new PPokerActions($model);

//Datenbank Controller
require "classes/DBAccess.php";
$dbAccess = new DBAccess();

if(isset($_REQUEST['action'])){
    $action=$_REQUEST['action'];
    if(isset($_REQUEST['actionValue'])){
        $value=$_REQUEST['actionValue'];
    }else{
        $value="";
    }

    $controller->$action($value);
}

//"Vorlagen" für Views
require "views/Page.php";  // Eltern-Klasse "Page"
require "views/IPage.php"; // Interface "IPage"

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

require $pagePath;
$view=new $page($controller, $model);

//if (isset($_REQUEST['page']) && $_REQUEST['page']=="Sonderangebot"){
 //   require "views/Sonderangebot.php";
  //  $view = new Sonderangebot($controller, $model);
//}
//else{
 //   require "views/Startseite.php";
 //   $view = new Startseite($controller, $model);
//}

// Ausgabe
echo $view->output();
