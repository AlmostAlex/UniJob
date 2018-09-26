<?php
    include_once "../db.php";

$query = $_GET['term'];
$likeVar = "%" . $query . "%";
$statement = $dbh->prepare("SELECT DISTINCT bezeichnung FROM `vorkenntnisse` WHERE bezeichnung like '{$likeVar}'");
$statement->execute();
$statement->bind_result($bezeichnung);

$json = [];
   while ($statement->fetch()) {
   $json[] = $bezeichnung; 
   }
echo json_encode($json); 
	?>