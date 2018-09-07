

<?php
if(isset($_GET["semester"])){
    $w = $_GET["semester"];
    echo $w;
}
else{
    $w = '';
}

if(isset($_GET["art"])){
   $q = $_GET['art'];
   // echo $q;
}
else{
    $q = '';
}


?>
