<?php 

session_start();


require_once("./layot/header.php");

require_once('./js/scripts.php');

if(isset($_GET["action"]) ) {
    //
    include_once("./views/". $_GET["action"] . ".php");
}
else {
require_once("views/mainpage.php");
}

require_once("./layot/footer.php"); ?>