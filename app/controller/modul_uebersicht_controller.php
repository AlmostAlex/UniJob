<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once(__DIR__."/../model/modul_model.php");
include_once(__DIR__."/../model/thema_model.php");
include_once(__DIR__."/../model/tags_model.php");
include_once(__DIR__."/../../db.php"); 


class modul_uebersicht_controller
{
    public $model_uebersicht;

    public function __construct()
    {
        $this->modul_model = new modul_model();
        $this->thema_model = new thema_model();
        $this->tags_model = new tags_model();
    }

    public function modulUebersicht($semester,$art,$betreuer,$tags,$state){
        switch ($state) {
            case 'true':
                include 'app/view/modul_uebersicht/modul_uebersicht_view.php';
            break;

            case 'false':
                $tags_string=str_replace("\\","",$tags);
                $tags_string=str_replace("'","",$tags);
                $tags_array = explode(",", $tags_string); // heraus kommt [0] --> blubb [1] --> bla etc
                $i=0;
    
                while($i < count($tags_array) ){
                    //  $tags_array[$i]=str_replace("'","",$tags_array[$i]);
                    echo $tags_array[$i].'<br>';
                    $i++;
                }
            break;
        }        
    }
}