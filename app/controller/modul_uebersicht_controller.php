<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once(__DIR__."/../model/modul_model.php");
include_once(__DIR__."/../model/thema_model.php");
include_once(__DIR__."/../model/user_model.php");
include_once(__DIR__."/../model/tags_model.php");
include_once(__DIR__."/../model/vorkenntnisse_model.php");
include_once(__DIR__."/../../db.php"); 


class modul_uebersicht_controller
{
    public $model_uebersicht;

    public function __construct()
    {
        $this->user_model = new Model();
        $this->modul_model = new modul_model();
        $this->thema_model = new thema_model();
        $this->tags_model = new tags_model();
    }

public function modulUebersichtThemen($modul_id){
    return $this->thema_model->getThemen($modul_id);
}

    public function modulUebersicht($semester,$art,$betreuer,$tags,$state){
        $s_row = $this->modul_model->count_s(); // Anzahl der Semester, Betreuer und Kategorien für die Filteranzeige - Ausgangssicht
        $b_row = $this->modul_model->count_b();
        $k_row = $this->modul_model->count_k();
        $module = $this->modul_model->getModule('');

        switch ($state) {
            case 'true':
                include 'app/view/modul_uebersicht/modul_uebersicht_view.php';  
            break;

            case 'false':
                $tags_string=str_replace("\\","",$tags);
                $tags_string=str_replace("'","",$tags);
                $tags_array = explode(",", $tags_string); // heraus kommt [0] --> blubb [1] --> bla etc
                $f_abfrage = '';

                // $module = $this->modul_model->getModuleFilter($semester);
                if($semester == ''){ $s_abfrage =  $search_s = $x_s = ''; }else{ $s_abfrage = " AND modul.semester = '{$semester}'"; $search_s = 'badge badge-info'; $x_s = 'x';}
                if($art == ''){ $a_abfrage =  $search_a = $x_a = ''; }else{ $a_abfrage = " AND modul.kategorie = '{$art}'"; $search_a = 'badge badge-info'; $x_a = 'x';}
                if($betreuer == ''){ $b_abfrage =  $search_b = $x_b = ''; }else{ $b_abfrage = " AND thema.benutzer_id = '{$betreuer}'"; $search_b = 'badge badge-info'; $x_b = 'x';}
                $search_f = 'badge badge-info';
                if(count(array_filter($tags_array)) == 0) {
                    $f_abfrage = $f_abfrage_s = $search_f  ='';
                    $display ="display:none;";

                }else{
                    for ($i = 0; $i < count($tags_array)-1; $i++) {
                        
                    $f_abfrage = $f_abfrage. "'". $tags_array[$i] ."' AND ";                            
                 }
                $f_abfrage_s = " AND tags = ". $f_abfrage ."'".  $tags_array[$i]."'"; 
                }

                $abfrage_modul = $s_abfrage .''. $a_abfrage;

                $abfrage_th =  $b_abfrage .''. $f_abfrage_s;

                $module = $this->modul_model->getModule($abfrage_modul);

                
                $betreuer_anzeige = $this->user_model->getIDBenutzername($betreuer);
                include(__DIR__."/../view/modul_uebersicht/modul_uebersicht_mt_view.php"); 
            break;
        }        
    }
}