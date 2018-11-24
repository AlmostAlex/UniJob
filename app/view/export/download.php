<?php 
header("Pragma: public");
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: text/x-csv");
header("Content-Disposition: attachment;filename=\"search_results.csv\""); 

if(isset($_GET['action'])){ $action = $_GET['action'];} else { $action = 'nix';}

echo '"Id";"Modulbezeichnung";"Verfahren";"Starttermin";"Endtermin";"TESTESTEST22222";'  . $action . "\n";
?>