<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('../app/controller/modul_controller.php');
require_once('../app/controller/bewerbung_controller.php');
require_once('../app/controller/modul_uebersicht_controller.php');
require_once('../app/controller/einsicht_controller.php');
require_once('../db.php');

if(isset($_GET["action"]) && $_GET["action"] =='filter'){
if(isset($_GET["semester"])){ $semester = $_GET["semester"];} else{$semester = "";}
if(isset($_GET["art"])){ $art = $_GET["art"];} else{$art = "";}
if(isset($_GET["betreuer"])){ $betreuer = $_GET["betreuer"];} else{$betreuer = "";}
if(isset($_GET["tags"])){ $tags = $_GET["tags"];} else{$tags = "";}

$controller = new modul_uebersicht_controller();
$controller->modulUebersicht($semester, $art, $betreuer,$tags,'false'); 

}

if(isset($_GET["action"]) && $_GET["action"] =='tags'){
    $query = $_GET['term'];
    $likeVar = "%" . $query . "%";
    $statement = $dbh->prepare("SELECT DISTINCT tag_bezeichnung FROM `tags` WHERE tag_bezeichnung like '{$likeVar}'");
    $statement->execute();
    $statement->bind_result($tag_bezeichnung); 

    $json = [];
    while ($statement->fetch()) {
    $json[] = $tag_bezeichnung; 
    }    
    echo json_encode($json); 
}

if(isset($_GET["action"]) && $_GET["action"] =='showVorkenntnisse'){
    $controller = new bewerbung_controller();
    $controller->Abschluss_AJ($_GET["id"],'false','WH'); 
}

if(isset($_GET["action"]) && $_GET["action"] =='showVorkenntnisseBW'){
    $controller = new bewerbung_controller();
    $controller->Abschluss_AJ($_GET["id"],'false','BW'); 
}
// VORKENNTNISSE BELEGWUNSCH THEMA 1
if(isset($_GET["action"]) && $_GET["action"] =='showVorkenntnisseBEL1'){
    $controller = new bewerbung_controller();
    $controller->Abschluss_AJ($_GET["id"],'false','BEL1'); 
}
// VORKENNTNISSE BELEGWUNSCH THEMA 2
if(isset($_GET["action"]) && $_GET["action"] =='showVorkenntnisseBEL2'){
    $controller = new bewerbung_controller();
    $controller->Abschluss_AJ($_GET["id"],'false','BEL2'); 
}
// VORKENNTNISSE BELEGWUNSCH THEMA 3
if(isset($_GET["action"]) && $_GET["action"] =='showVorkenntnisseBEL3'){
    $controller = new bewerbung_controller();
    $controller->Abschluss_AJ($_GET["id"],'false','BEL3'); 
}

// archivierung
if(isset($_GET["action"]) && $_GET["action"] =='showArchiv'){
    $controller = new modul_controller();
    $controller->archivierung($_GET["semester"],"filter"); 
}

// Swap
if(isset($_GET["action"]) && $_GET["action"] =='swap'){
    $controller = new einsicht_controller();
    $controller->swap($_GET["thID"],$_GET["bewID"]);
}

if(isset($_GET["action"]) && $_GET["action"] =='swapAgain'){
    $controller = new einsicht_controller();
    $controller->swapAgainst($_GET["bewID_von"], $_GET["bewThID_von"], $_GET["bewID_zu"], $_GET["thID_zu"]);

} 

// Export

if(isset($_GET["action"]) && ($_GET["action"] =='expWH' || $_GET["action"] =='expBEW' ||  $_GET["action"] =='expBEL')){
    $controller = new einsicht_controller();
    $controller->export($_GET['action'],$_GET['art'],$_GET['id']);
}
?>
