<?php
include_once(__DIR__."/../model/modul_model.php");
include_once(__DIR__."/../model/thema_model.php");
include_once(__DIR__."/../model/tags_model.php");
include_once(__DIR__."/../model/user_model.php");
include_once(__DIR__."/../model/vorkenntnisse_model.php");
include_once(__DIR__."/../model/windhund_model.php");
include_once(__DIR__."/../model/bewerbung_model.php");
include_once(__DIR__."/../model/belegwunsch_model.php");
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
        $this->bewerbung_model = new bewerbung_model();
        $this->belegwunsch_model = new belegwunsch_model();
    }

    public function Einsicht($action, $action1, $id)
    {
        if($action1=='Windhundverfahren'){
            $modul_id = $id;
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
        else if($action1=='Bewerbungsverfahren'){
            $thema_id = $id;
            $bew_count_bw = $this->bewerbung_model->bewerbung_count($thema_id);
                if($bew_count_bw > 0){ // checkt, ob Bewerbungen vorhanden sind
                    $infos = $this->bewerbung_model->info_bewerbung($thema_id);
                    $bewerber= $this->bewerbung_model->bewerber($thema_id);
                    include 'app/view/einsicht/bewerbung_einsicht_view.php';
                }
                else{
                    $kat = "Bewerbungen"; // Wenn keine Bewerbungen vorhanden sind, dann wird die none Unterseite aufgerufen
                    include 'app/view/einsicht/none_view.php'; 
                }
        } 
        else if($action1=='Belegwunschverfahren'){
            $modul_id = $id;
            $bel_count = $this->belegwunsch_model->beleg_count($modul_id);
            $infos = $this->belegwunsch_model->info_belegwunsch($modul_id);

            if($bel_count > 0){
                include 'app/view/einsicht/belegwunsch_einsicht_view.php';  
            }
            else{
                $kat = "Bewerbungen"; // Wenn keine Bewerbungen vorhanden sind, dann wird die none Unterseite aufgerufen
                include 'app/view/einsicht/none_view.php';  
            }
        }
        else{ // das verfahren existiert nicht
            echo "Das Verfahren existiert nicht";
        }
        
    }
}
