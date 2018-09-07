<?php
// Gibt an, welche PHP-Fehlermeldungen gemeldet werden
error_reporting(E_ALL);

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="test";

$dbh = new mysqli($host, $user, $password, $dbname, $port, $socket);
$dbh->set_charset("utf8");

// wenn die Verbidung ergolreich war
if($dbh){
   /* 
    echo "funktioniert";
    print_r($dbh);
    */
}
// Fehlermeldung, wenn die Verbindung nicht erfolgreich war
else{
 die('keine Verbindung möglich: ' . mysqli_error());
}
