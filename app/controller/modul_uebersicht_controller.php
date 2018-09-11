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

    public function Route($action){
        if($action == 'modul_uebersicht'){
            $this->modulUebersicht();
        }
    }

    public function modulUebersicht(){   
        include 'app/view/modul_uebersicht/modul_uebersicht_view.php';
    }

    public function blabla(){   
        echo"hihihi";
    }


}