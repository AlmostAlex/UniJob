<?php

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
        $this->vorkenntnisse_model = new vorkenntnisse_model();
    }

public function modulUebersichtThemen($modul_id, $f_abfrage_s, $b_abfrage){
    return $this->thema_model->getThemen($modul_id, $f_abfrage_s, $b_abfrage);
}

public function modulUebersichtVorkenntisse($thema_id){
    return $this->vorkenntnisse_model->VorkenntnisseByThemaID($thema_id);
}

public function modulUebersichtTags($thema_id){
    return $this->tags_model->TagsByThemaID($thema_id);
}

    public function modulUebersicht($semester,$art,$betreuer,$tags,$state){
        $s_row = $this->modul_model->count_s(); // Anzahl der Semester, Betreuer und Kategorien für die Filteranzeige - Ausgangssicht
        $b_row = $this->modul_model->count_b();
        $k_row = $this->modul_model->count_k();
        $module = $this->modul_model->getModuleByUebersicht('', '', '');

        if(count($module) > 0) {
            $tagsBezFilter = $this->tags_model->getTagsBezeichnung();
        }

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
                    if($semester == ''){   $s_abfrage = $x_s = $s_abfrage='';
                        $search_s = 'display:none;';
                    }else{ $s_abfrage = " AND modul.semester = '{$semester}'"; $search_s = ''; $x_s = 'x';}
                    if($art == ''){ $a_abfrage =  $x_a = '';  $search_a = 'display:none;'; }else{ $a_abfrage = " AND modul.kategorie = '{$art}'"; $search_a = ''; $x_a = 'x';}
                    if($betreuer == ''){ $b_abfrage = $x_b = ''; $search_b = 'display:none;'; }else{ $b_abfrage = " AND thema.betreuer = '{$betreuer}'"; $search_b = ''; $x_b = 'x';}
                    $search_f = '';
                    if(count(array_filter($tags_array)) == 0) {
                        $f_abfrage = $f_abfrage_s = $search_f  ='';
                        $display ="display:none;";

                    }else{
                        for ($i = 0; $i < count($tags_array)-1; $i++) {
                            
                        $f_abfrage = $f_abfrage. "'". $tags_array[$i] ."' THEN 1 ELSE 0 END) > 0 AND
                        SUM(CASE WHEN tag_bezeichnung = ";                            
                    }
                    $f_abfrage_s = "HAVING SUM(CASE WHEN tag_bezeichnung = ". $f_abfrage ."'".  $tags_array[$i]."' THEN 1 ELSE 0 END) > 0"; 
                    }

                    $abfrage_modul = $s_abfrage .''. $a_abfrage;
                    $abfrage_th =  $b_abfrage .''. $f_abfrage_s;

                    $module = $this->modul_model->getModuleByUebersicht($abfrage_modul, $f_abfrage_s, $b_abfrage);      
                    include(__DIR__."/../view/modul_uebersicht/modul_uebersicht_mt_view.php"); 
                break; 
            }        
         
        
     }
}