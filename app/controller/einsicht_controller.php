<?php
include_once(__DIR__."/../model/modul_model.php");
include_once(__DIR__."/../model/thema_model.php");
include_once(__DIR__."/../model/tags_model.php");
include_once(__DIR__."/../model/user_model.php");
include_once(__DIR__."/../model/vorkenntnisse_model.php");
include_once(__DIR__."/../model/windhund_model.php");
include_once(__DIR__."/../../db.php"); 

class einsicht_controller
{
    public $einsicht_model;

    public function __construct()
    {
        $this->modul_model = new modul_model();
        $this->thema_model = new thema_model();
        $this->tags_model = new tags_model();
        $this->windhund_model = new windhund_model();
    }

    public function Einsicht($action, $action1, $modul_id)
    {
        if($action1=='windhundverfahren'){
            $bew_count = $this->windhund_model->bewerbung_count($modul_id);
            if($bew_count > 0){ // checkt, ob Bewerbungen vorhanden sind
                $infos = $this->windhund_model->info_windhund($modul_id);
                $themen = $this->thema_model->einsichtThemaModul($modul_id);
                $themenVG = $this->thema_model->einsichtThemaModulVerfuegbar($modul_id);
                    include 'app/view/einsicht/windhund_einsicht_view.php';
            }else{         
                $kat = "Anmeldungen"; // Wenn keine Bewerbungen vorhanden sind, dann wird die none Unterseite aufgerufen
                include 'app/view/einsicht/none_view.php';
            }            
        }
        else if($action1=='bewerbungsverfahren'){
            echo"!!";
        } 
        else if($action1=='belegwunschverfahren'){
            echo"!!";
        }
        else{ // das verfahren existiert nicht
            echo "Das Verfahren existiert nicht";
        }
        
    }
}
