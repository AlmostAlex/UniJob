<?php 

if(isset($_POST['create_csv'])){

    // If the file is NOT requested via AJAX, force-download
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header("Content-Disposition: attachment; filename=search_results.csv");
    }
    //
    //Generate csv
    //
    echo $csvOutput;
    exit();
}

?>