
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('../app/controller/modul_uebersicht_controller.php');


$controller = new modul_uebersicht_controller();
$controller->blabla(); 

if(isset($_GET["semester"])){
    $w = $_GET["semester"];
    echo $w;
    echo "<br><br>";
}
else{
    $w = '';
}

if(isset($_GET["art"])){
   $q = $_GET["art"];
    echo $q;
    echo "<br><br>";
}
else{
    $q = '';
}

if(isset($_GET["betreuer"])){
    $y = $_GET["betreuer"];
     echo $y;
     echo "<br><br>";
 }
 else{
     $y = '';
 }

 if(isset($_GET["gift"])){
   $gift = $_GET["gift"];
    $gift_string=str_replace("\\","",$gift);
   
    echo $_GET["gift"];
    echo "tags da";
 }
 else{
     $y = 'keine tags';
 }





?>
