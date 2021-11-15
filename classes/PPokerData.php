<?php
class PPokerData
{

    private $link;


    function __construct(){
        $this->link=mysqli_connect("localhost","root","","ppoker")
            or die("Die DB-Verbindung geht nicht!");
    }
    
}