<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('../app/controller/modul_uebersicht_controller.php');
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

?>
