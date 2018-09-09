

<?php
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
    echo "<br><br>";
 }
 else{
     $y = 'keine tags';
 }

?>
