<?php
    include_once "../db.php";
    

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
	?>