<select class='form-control' id='semester' name='semester' onchange="sem(this.value)">
    <option></option>
    <option value='s12'>s12</option>
    <option value='s11'>s11</option>
</select>
semester filterung

<?php

if(isset($_GET["semester"])){
    $w = $_GET["semester"];
    echo $w;
}
else{
    $w = '';
}


if(isset($_GET["art"])){
    $q = $_GET["art"];
    echo $q;
}
else{
    $q = 'nee';
    echo '<br>'.$q;
}

?>
