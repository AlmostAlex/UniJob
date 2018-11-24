<?php
header("Pragma: public");
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: text/x-csv");
header("Content-Disposition: attachment;filename=\"search_results.csv\""); 

if($_POST['data']){
    print $_POST['data'];
}
?>