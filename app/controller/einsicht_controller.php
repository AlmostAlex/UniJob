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
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__.'/../../vendor/autoload.php';

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

    public function Einsicht($action, $action1, $action2, $id)
    {

        if($action1=='Windhundverfahren' && $action2=='none'){
            $modul_id = $id;
            $bew_count = $this->windhund_model->bewerbung_count($modul_id);

            if($bew_count > 0){ // checkt, ob Bewerbungen vorhanden sind
                $infos = $this->windhund_model->info_windhund($modul_id);
                $themen = $this->thema_model->einsichtThemaModul($modul_id);

                // Abfrage der Infos
                $semester = $this->modul_model->getSemesterByID($modul_id);
                //$note = $this->bewerbung_model->getNotes($matrikelnummer, $semester);
                //echo $semester;
               
                if($infos['anzThemaVerfuegbar'] > 0){
                    $themenVG = $this->thema_model->einsichtThemaModulVerfuegbar($modul_id);
                   } else {}                   
                    
                include 'app/view/einsicht/windhund_einsicht_view.php';
            }else{         
                $kat = "Anmeldungen"; // Wenn keine Bewerbungen vorhanden sind, dann wird die none Unterseite aufgerufen
                include 'app/view/einsicht/none_view.php';
            }            
        }
        else if($action1=='Bewerbungsverfahren' && $action2=='none'){
            $thema_id = $id;
            $modul_id = $this->thema_model->getModulID($thema_id);


            if( ($this->modul_model->getNachrueckverfahren($modul_id) == 'true') 
                && ($this->bewerbung_model->countAnzWHBew($modul_id)  > 0 ) ){
                $display = ""; 
                $anmeldungen = $this->bewerbung_model->getWHThBew($modul_id);    
            } else { 
                $display = 'display:none'; 
            } 

            $bew_count_bw = $this->bewerbung_model->bewerbung_count($thema_id);

                if($bew_count_bw > 0 ||  ($bew_count_bw > 0  && $this->bewerbung_model->countAnzWHBew($modul_id)  > 0)) { 
                                        // checkt, ob Bewerbungen vorhanden sind
                                        // KORR: UND ABER NACHR = 0 --> WENN KEINE BEW ABER NACHRÜCKV DANN JA
                    $infos = $this->bewerbung_model->info_bewerbung($thema_id);                  
                    $bewerber = $this->bewerbung_model->bewerber($thema_id);
                    include 'app/view/einsicht/bewerbung_einsicht_view.php';
                }
                else{
                    $kat = "Bewerbungen"; // Wenn keine Bewerbungen vorhanden sind, dann wird die none Unterseite aufgerufen
                    include 'app/view/einsicht/none_view.php'; 
                }
        } 
        else if($action1=='Bewerbungsverfahren' && $action2=='modul'){
            echo "hihihihi";
            $modul_id = $id;

            //$modul_id = $this->thema_model->getModulID($thema_id);


            if( ($this->modul_model->getNachrueckverfahren($modul_id) == 'true') 
                && ($this->bewerbung_model->countAnzWHBew($modul_id)  > 0 ) ){
                $display = ""; 
                $anmeldungen = $this->bewerbung_model->getWHThBew($modul_id);    
            } else { 
                $display = 'display:none'; 
            } 

            $bew_count_bw_all = $this->bewerbung_model->bewerbung_count_all($modul_id);
            echo $bew_count_bw_all;

                if($bew_count_bw_all > 0 ||  ($bew_count_bw_all > 0  && $this->bewerbung_model->countAnzWHBew($modul_id)  > 0)) { 
                                        // checkt, ob Bewerbungen vorhanden sind
                                        // KORR: UND ABER NACHR = 0 --> WENN KEINE BEW ABER NACHRÜCKV DANN JA
                 $infos = $this->bewerbung_model->info_bewerbung_all($modul_id);                  
                $bew_thema = $this->bewerbung_model->bewerber_thema_all($modul_id);
                echo count($bew_thema);
                 include 'app/view/einsicht/bewerbung_einsicht_all_view.php';
                }
                else{
                    $kat = "Bewerbungen"; // Wenn keine Bewerbungen vorhanden sind, dann wird die none Unterseite aufgerufen
                    include 'app/view/einsicht/none_view.php'; 
                } 
        } 



        else if($action1=='Belegwunschverfahren' && $action2=='none'){
            $modul_id = $id; 
      
            if( ($this->modul_model->getNachrueckverfahren($id) == 'true') && ($this->belegwunsch_model->countAnzWHBeleg($id)  > 0 ) ){
                $display = ""; 
                $anmeldungen = $this->belegwunsch_model->getWHThBeleg($modul_id);    
            } else { 
                $display = 'display:none'; 
            }

            $sw = $this->modul_model->getSw($modul_id);  // NOCH WENN NACHRV IST ODER FRIST ENDE EINGETROFFEN IST                                                        
            if($this->modul_model->getSw($modul_id) == "True"){ }           
                else{
                    $this->belegwunsch_model->deleteBewerbungModul($modul_id);
                    $this->Belegwunschverteilung($modul_id);       
                }
                          
            $bel_count = $this->belegwunsch_model->beleg_count($modul_id);
            $infos = $this->belegwunsch_model->info_belegwunsch($modul_id);
            $bewerber = $this->thema_model->einsichtThemaModulBeleg($modul_id);

            $keinThemaCount = $this->thema_model->keinThemaCount($modul_id);
            $keinThema = $this->thema_model->keinThema($modul_id);
            if((count((array)$bewerber)) > 0) {  
                include 'app/view/einsicht/belegwunsch_einsicht_view.php';
            }      
            else{
                $display_bew = "display:none;";
                $kat = "Bewerbungen"; // Wenn keine Bewerbungen vorhanden sind, dann wird die none Unterseite aufgerufen
                include 'app/view/einsicht/none_view.php';  
            }
        }
        else {
            echo "Verfahren existiert nicht";
        }
       
    }

    public function swap($thID, $bewID){

        $themenbezeichnung = $this->thema_model->SwapBewThema($thID);
        $thema_id = $this->thema_model->getTHID($thID);
        $swapThemen = $this->thema_model->swapThemen($thID, $bewID);
        $data = $this->belegwunsch_model->getDataByBEWID($bewID);

        if($thID == NULL){
        $themenbezeichnung = "kein Thema erhalten";
        $swapThemen = $this->thema_model->swapThemenByBewID($bewID);   // basierend auf bewerbers ID
       
        include_once(__DIR__."/../view/einsicht/swap.php");
        } else {
        include_once(__DIR__."/../view/einsicht/swap.php");
        }
    }

    public function swapAgainst($bewID_von,$bewThID_von, $bewID_zu, $bewThID_zu){

        $themenbezeichnung = $this->thema_model->SwapBewThema($bewID_zu);
        $thema_id = $this->thema_model->getTHID($bewID_zu);
        
        $swapThemen = $this->thema_model->swapThemen($bewThID_zu, $bewID_zu);
        $isNull = $this->thema_model->isNull($bewID_zu);

        $data = $this->belegwunsch_model->getDataByBEWID($bewID_zu);

        $this->belegwunsch_model->setModulSW($bewID_von, $bewThID_von, $bewID_zu, $bewThID_zu);    
        // WENN THEMA NULL ODER DAS THEMA VORHANDEN IST
        if($bewThID_zu == 'NULL'){
        $this->belegwunsch_model->tauschzuKeinTH($bewID_von);
        } else if($this->thema_model->isNull($bewThID_zu) == 'True'){
        $this->belegwunsch_model->tauschzuVTH($bewID_von,$bewThID_zu);
        } else { // WENN GEGEN EIN VERGEBENES THEMA 

        // ----------------------------------------------

        $this->belegwunsch_model->tauschzuVergTH($bewID_von, $bewThID_von, $bewID_zu, $bewThID_zu);
        $themenbezeichnung = "Kein Thema erhalten";
        $swapThemen = $this->thema_model->swapThemen($bewThID_zu, $bewID_zu);
        $bewID_von  = $bewID_zu; 
        $bewThID_von = $bewThID_zu; 
        include_once(__DIR__."/../view/einsicht/swap2.php");
        }

    }

    public function Belegwunschverteilung($modul_id){
        //Festlegen der Bewerberanzahl und der ThemaAnzahl

        $studiengang = $this->modul_model->getModulStudiengang($modul_id);
        $bewerberAnzahlStudien = $this->belegwunsch_model->beleg_countStudien($modul_id, $studiengang);
        $bewerberAnzahlRest = $this->belegwunsch_model->beleg_countRest($modul_id, $studiengang);
        $themaAnzahl = $this->modul_model->getThemenAnzahl($modul_id);
            
        //Status der Themen auf "Frei" setzen und Status der Bewerber auf "Hat nichts!" setzen.
        $bewerberinfos = $this->belegwunsch_model->getBewerberInfosPlus($studiengang, $modul_id);
        $bewerberinfoPlus = $this->belegwunsch_model->getBewerberInfos($studiengang, $modul_id);     
        //shuffle($bewerberinfos);

        $k=0;
        while($k < $bewerberAnzahlRest)
        {
            $bewerberinfoPlus[$bewerberinfoPlus[$k]['belegwunsch_id']]['Status'] = "Hat nichts!";
            $bewerberinfoPlus[$bewerberinfoPlus[$k]['belegwunsch_id']]['Thema'] = "kein Thema";
            $k = $k + 1;
        }
        $k=0;
        while($k < $bewerberAnzahlStudien)
        {
            $bewerberinfos[$bewerberinfos[$k]['belegwunsch_id']]['Status'] = "Hat nichts!";
            $bewerberinfos[$bewerberinfos[$k]['belegwunsch_id']]['Thema'] = "kein Thema";
            $k = $k + 1;
        }
            
        $themen = $this->thema_model->getAllModulThema($modul_id);
        $k=0;
        while($k < $themaAnzahl)
        {
            $themen[$themen[$k]['thema_id']]['Status'] = "Frei";
            $themen[$themen[$k]['thema_id']]['Punkte'] = 0;
            $themen[$themen[$k]['thema_id']]['Bewerber'] = "Noch kein Bewerber";
            $k = $k + 1;
        }
            
        //Die Studenten bekommen ihren ersten Wunsch, wenn dieser noch frei ist.
        $i = 0; $j = 0;
        while($i < $bewerberAnzahlStudien)
        {
            while($j < $themaAnzahl)
            {
                if($bewerberinfos[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                {
                    if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
                    {
                        $themen[$themen[$j]['thema_id']]['Punkte'] = 115;
                        $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                        $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                        $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                    }
                }
                $j = $j + 1;
            }
            $i = $i + 1;
            $j = 0;
        }
        $i = 0; $j = 0;
        //Die Studenten, die noch nichts haben, bekommen ihren zweiten Wunsch, wenn dieser noch Frei ist.
        while($i < $bewerberAnzahlStudien)
        {
            while($j < $themaAnzahl)
            { 
                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] != "Hat was!")
                {
                    if($bewerberinfos[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                    {
                        if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
                        {
                            $themen[$themen[$j]['thema_id']]['Punkte'] = 110;
                            $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                            $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                            $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                            $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                        }
                    }
                }
                $j = $j + 1;
            }
            $i = $i + 1;
            $j = 0;
        }
        $i = 0; $j = 0;
        //Die Studenten, die noch nichts haben, bekommen ihren dritten Wunsch, wenn dieser noch Frei ist.
        while($i < $bewerberAnzahlStudien)
        { 
            if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] != "Hat was!")
            {   
                while($j < $themaAnzahl)
                {
                    if($bewerberinfos[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                    {
                        if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
                        {
                            $themen[$themen[$j]['thema_id']]['Punkte'] = 105;
                            $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                            $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                            $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                            $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                        }
                    }
                    $j = $j + 1;
                }
            }
            $i = $i + 1;
            $j = 0;
        }
        $i = 0; $j = 0;
        //Gesamtpunktzahl nach der ersten iteraltion bestimmen.
        $gesamtPunktzahl = 0;
        while($i < $themaAnzahl)
        {
            $gesamtPunktzahl += $themen[$themen[$j]['thema_id']]['Punkte'];
            $i = $i + 1;
        }
        $i = 0;

        $bewerbersucht = 0;
        while($i < $bewerberAnzahlStudien)
        {
            if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] != "Hat was!")
            {
                $bewerbersucht = 1;
            }
            $i = $i + 1;
        }
        $i=0;

        //Prüfen, ob es noch Freie Themen gibt, welche vergeben werden können
        //->Bedingung dafür ist, dass es min. soviele Bewerber gibt wie Themen.
        while($j < $themaAnzahl)
        {
            if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
            {
                if($bewerberAnzahlStudien >= $themaAnzahl || $bewerbersucht = 1)
                {
                    $bewerbungErhalten = false;
                    //Es wird nach einem Bewerber gesucht, der das Thema als einen seiner Wünsche angegeben hatte.
                    //Wird er gefunden, dann werden seine Daten zwischengespeichert.
                    while($i < $bewerberAnzahlStudien)
                    {
                        if($bewerberinfos[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 115;
                            $TauschThema = $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        }
                        if($bewerberinfos[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 110;
                            $TauschThema = $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        } 
                        else if($bewerberinfos[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 105;
                            $TauschThema = $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        }
                        $i = $i + 1;
                    }
                    $i = 0;
                    $t = 0;

                    if($bewerbungErhalten == true)
                    {
                        //Nach einem Bewerber suchen, der noch kein Thema hat und das alte Thema nehmen könnte
                        while($i < $bewerberAnzahlStudien)
                        {
                            if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] == "Hat nichts!")
                            {
                                if($bewerberinfos[$i]['wunschthema1'] == $TauschThema)
                                {
                                    //Sollte man mehr Priorität auf die Wünsche und nicht die Themenvergabe
                                    //setzen wollen, dann kann man die Punkte geringer setzen.
                                    //Momentan wird bei den "if"-Abfragen True rauskommen, da die Themenvergabe
                                    //als Priorität angegeben wurde
                                    $Saldo = 115 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {
                                        //Hier findet der "tausch" statt.
                                        //Punkte aktuallisierung
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        //Das noch nicht vergebene Thema bekommt nun den Bewerber zugewiesen und umgekehrt.
                                        while($t < $bewerberAnzahlStudien){
                                            if($bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t= $t+1;}
                                        }
                                        //Der Bewerber der vorher noch nichts hatte bekommt nun das Thema vom
                                        //vorherigen Bewerber
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 115;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t= $t+1;}
                                        }
                                    }
                                }
                                if($bewerberinfos[$i]['wunschthema2'] == $TauschThema)
                                {
                                    $Saldo = 110 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {                                           
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        while($t < $bewerberAnzahlStudien){
                                            if($bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t= $t+1;}
                                        }
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 110;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t= $t+1;}
                                        }
                                    }
                                }
                                if($bewerberinfos[$i]['wunschthema3'] == $TauschThema)
                                {
                                    $Saldo = 105 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        while($t < $bewerberAnzahlStudien){
                                            if($bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t=$t+1;}
                                        }
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 105;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t=$t+1;}
                                        }
                                    }
                                }
                            }
                            $i = $i +1;
                        }
                    }
                }
            }
            $j = $j + 1;
        }
        $themafrei = 0;
        $i = 0;
        while($i < $themaAnzahl)
        {
            if($themen[$themen[$i]['thema_id']]['Status'] == "Frei")
            {
                $themafrei = $themafrei + 1;
            }
            $i = $i + 1;
        }
        $i = 0;

        if($themafrei != 0 && $bewerberAnzahlRest != 0)
        {
            while($i < $bewerberAnzahlRest)
            {
                while($j < $themaAnzahl)
                {
                    if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] != "Hat was!")
                    {
                        if($bewerberinfoPlus[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                        {
                            if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
                            {
                                $themen[$themen[$j]['thema_id']]['Punkte'] = 115;
                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                            }
                        }
                    }
                    $j = $j + 1;
                }
                $i = $i + 1;
                $j = 0;
            }
            $i = 0; $j = 0;
            //Die Studenten, die noch nichts haben, bekommen ihren zweiten Wunsch, wenn dieser noch Frei ist.
            while($i < $bewerberAnzahlRest)
            {
                while($j < $themaAnzahl)
                {
                    if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] != "Hat was!")
                    {
                        if($bewerberinfoPlus[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                        {
                            if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
                            {
                                $themen[$themen[$j]['thema_id']]['Punkte'] = 110;
                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                            }
                        }
                    }
                    $j = $j + 1;
                }
                $i = $i + 1;
                $j = 0;
            }
            $i = 0; $j = 0;
            //Die Studenten, die noch nichts haben, bekommen ihren dritten Wunsch, wenn dieser noch Frei ist.
            while($i < $bewerberAnzahlRest)
            { 
                if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] != "Hat was!")
                {   
                    while($j < $themaAnzahl)
                    {
                        if($bewerberinfoPlus[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                        {
                            if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
                            {
                                $themen[$themen[$j]['thema_id']]['Punkte'] = 105;
                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                            }
                        }
                        $j = $j + 1;
                    }
                }
                $i = $i + 1;
                $j = 0;
            }
            $i = 0;
            $bewerbersucht = 0;
            while($i < $bewerberAnzahlStudien)
            {
                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] != "Hat was!")
                {
                    $bewerbersucht = 1;
                }
                $i = $i + 1;
            }
            $i=0;
            //Prüfen, ob es noch Freie Themen gibt, welche vergeben werden können
            //->Bedingung dafür ist, dass es min. soviele Bewerber gibt wie Themen.
            while($j < $themaAnzahl)
            {
                if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
                {
                    if($bewerberAnzahlRest >= $themaAnzahl || $bewerbersucht = 1)
                    {
                        $bewerbungErhalten = false;
                        //Es wird nach einem Bewerber gesucht, der das Thema als einen seiner Wünsche angegeben hatte.
                        //Wird er gefunden, dann werden seine Daten zwischengespeichert.
                        while($i < $bewerberAnzahlRest)
                        {
                            if($bewerberinfoPlus[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                            {
                                $k = 0;
                                while($k < $themaAnzahl){
                                    if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                        $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                        $k = $themaAnzahl;
                                    }else{$k=$k+1;}
                                }
                                $Punktzahl2 = 115;
                                $TauschThema = $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'];
                                $bewerbungErhalten = true;
                                break 1;
                            }
                            if($bewerberinfoPlus[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                            {
                                $k = 0;
                                while($k < $themaAnzahl){
                                    if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                        $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                        $k = $themaAnzahl;
                                    }else{$k=$k+1;}
                                }
                                $Punktzahl2 = 110;
                                $TauschThema = $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'];
                                $bewerbungErhalten = true;
                                break 1;
                            }    
                            else if($bewerberinfoPlus[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                            {
                                $k = 0;
                                while($k < $themaAnzahl){
                                    if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                        $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                        $k = $themaAnzahl;
                                    }else{$k=$k+1;}
                                }
                                $Punktzahl2 = 105;
                                $TauschThema = $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'];
                                $bewerbungErhalten = true;
                                break 1;
                            }
                            $i = $i + 1;
                        }
                        $i = 0;
                        $t = 0;

                        if($bewerbungErhalten == true)
                        {
                            //Nach einem Bewerber suchen, der noch kein Thema hat und das alte Thema nehmen könnte
                            while($i < $bewerberAnzahlRest)
                            {
                                if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] == "Hat nichts!")
                                {
                                    if($bewerberinfoPlus[$i]['wunschthema1'] == $TauschThema)
                                    {
                                        //Sollte man mehr Priorität auf die Wünsche und nicht die Themenvergabe
                                        //setzen wollen, dann kann man die Punkte geringer setzen.
                                        //Momentan wird bei den "if"-Abfragen True rauskommen, da die Themenvergabe
                                        //als Priorität angegeben wurde
                                        $Saldo = 115 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {
                                            //Hier findet der "tausch" statt.
                                            //Punkte aktuallisierung
                                            $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                            $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                            //Das noch nicht vergebene Thema bekommt nun den Bewerber zugewiesen und umgekehrt.
                                            while($t < $bewerberAnzahlRest){
                                                if($bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                    $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$t]['belegwunsch_id'];
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                    break;
                                                }else{$t= $t+1;}
                                            }
                                            //Der Bewerber der vorher noch nichts hatte bekommt nun das Thema vom
                                            //vorherigen Bewerber
                                            $t = 0;
                                            while($t < $themaAnzahl){
                                                if($themen[$t]['thema_id'] == $TauschThema){
                                                    $themen[$themen[$t]['thema_id']]['Punkte'] = 115;
                                                    $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                    break 2;
                                                }else{$t= $t+1;}
                                            }
                                        }
                                    }
                                    if($bewerberinfoPlus[$i]['wunschthema2'] == $TauschThema)
                                    {
                                        $Saldo = 110 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {                                        
                                            $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                            $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                            while($t < $bewerberAnzahlRest){
                                                if($bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                    $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$t]['belegwunsch_id'];
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                    break;
                                                }else{$t= $t+1;}
                                            }
                                            $t = 0;
                                            while($t < $themaAnzahl){
                                                if($themen[$t]['thema_id'] == $TauschThema){
                                                    $themen[$themen[$t]['thema_id']]['Punkte'] = 110;
                                                    $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                    break 2;
                                                }else{$t= $t+1;}
                                            }
                                        }
                                    }
                                    if($bewerberinfoPlus[$i]['wunschthema3'] == $TauschThema)
                                    {
                                        $Saldo = 105 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {
                                            $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                            $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                            while($t < $bewerberAnzahlRest){
                                                if($bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                    $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$t]['belegwunsch_id'];
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                    break;
                                                }else{$t=$t+1;}
                                            }
                                            $t = 0;
                                            while($t < $themaAnzahl){
                                                if($themen[$t]['thema_id'] == $TauschThema){
                                                    $themen[$themen[$t]['thema_id']]['Punkte'] = 105;
                                                    $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                    $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                    break 2;
                                                }else{$t=$t+1;}
                                            }
                                        }
                                    }
                                }
                                $i = $i +1;
                            }
                        }
                    }
                }
                $j = $j + 1;
            }
        }
        $i = 0;
        /*print_r($bewerberinfos);
        echo "</br></br>";
        print_r($bewerberinfoPlus);
        echo "</br></br>";
        while($i < $bewerberAnzahlRest){
            $bewerberinfos[$bewerberAnzahlStudien+$i] = $bewerberinfoPlus[$i];
            $bewerberinfos[$bewerberinfos[$bewerberAnzahlStudien+$i]['belegwunsch_id']]['Status'] = $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'];
            $bewerberinfos[$bewerberinfos[$bewerberAnzahlStudien+$i]['belegwunsch_id']]['Thema'] = $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'];
            $i = $i + 1;
        }
        $bewerberinfoAlle = $bewerberinfos + $bewerberinfoPlus;
        print_r($bewerberinfoAlle);
        */
        $i = 0;
        $bewerbersucht = 0;
        while($i < $bewerberAnzahlStudien)
        {
            if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] != "Hat was!")
            {
                $bewerbersucht = 1;
            }
            $i = $i + 1;
        }
        $i=0;
        $j=0;
         //Prüfen, ob es noch Freie Themen gibt, welche vergeben werden können
        //->Bedingung dafür ist, dass es min. soviele Bewerber gibt wie Themen.
        while($j < $themaAnzahl)
        {
            if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
            {
                if($bewerberAnzahlRest >= $themaAnzahl || $bewerbersucht = 1)
                {
                    $bewerbungErhalten = false;
                    //Es wird nach einem Bewerber gesucht, der das Thema als einen seiner Wünsche angegeben hatte.
                    //Wird er gefunden, dann werden seine Daten zwischengespeichert.
                    while($i < $bewerberAnzahlRest)
                    {
                        if($bewerberinfoPlus[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 115;
                            $TauschThema = $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        }
                        if($bewerberinfoPlus[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 110;
                            $TauschThema = $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        } 
                        else if($bewerberinfoPlus[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 105;
                            $TauschThema = $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        }
                        $i = $i + 1;
                    }
                    $i = 0;
                    $t = 0;

                    if($bewerbungErhalten == true)
                    {
                        //Nach einem Bewerber suchen, der noch kein Thema hat und das alte Thema nehmen könnte
                        while($i < $bewerberAnzahlStudien)
                        {
                            if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] == "Hat nichts!")
                            {
                                if($bewerberinfos[$i]['wunschthema1'] == $TauschThema)
                                {
                                    //Sollte man mehr Priorität auf die Wünsche und nicht die Themenvergabe
                                    //setzen wollen, dann kann man die Punkte geringer setzen.
                                    //Momentan wird bei den "if"-Abfragen True rauskommen, da die Themenvergabe
                                    //als Priorität angegeben wurde
                                    $Saldo = 115 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {
                                        //Hier findet der "tausch" statt.
                                        //Punkte aktuallisierung
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        //Das noch nicht vergebene Thema bekommt nun den Bewerber zugewiesen und umgekehrt.
                                        while($t < $bewerberAnzahlRest){
                                            if($bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$t]['belegwunsch_id'];
                                                $bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t= $t+1;}
                                        }
                                        //Der Bewerber der vorher noch nichts hatte bekommt nun das Thema vom
                                        //vorherigen Bewerber
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 115;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t= $t+1;}
                                        }
                                    }
                                }
                                if($bewerberinfos[$i]['wunschthema2'] == $TauschThema)
                                {
                                    $Saldo = 110 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {                                           
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        while($t < $bewerberAnzahlRest){
                                            if($bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$t]['belegwunsch_id'];
                                                $bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t= $t+1;}
                                        }
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 110;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t= $t+1;}
                                        }
                                    }
                                }
                                if($bewerberinfos[$i]['wunschthema3'] == $TauschThema)
                                {
                                    $Saldo = 105 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        while($t < $bewerberAnzahlRest){
                                            if($bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$t]['belegwunsch_id'];
                                                $bewerberinfoPlus[$bewerberinfoPlus[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t=$t+1;}
                                        }
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 105;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t=$t+1;}
                                        }
                                    }
                                }
                            }
                            $i = $i +1;
                        }
                    }
                }
            }
            $j = $j + 1;
        }
        $i = 0;
        $bewerbersucht = 0;
        while($i < $bewerberAnzahlRest)
        {
            if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] != "Hat was!")
            {
                $bewerbersucht = 1;
            }
            $i = $i + 1;
        }
        $i=0;
        $j=0;
         //Prüfen, ob es noch Freie Themen gibt, welche vergeben werden können
        //->Bedingung dafür ist, dass es min. soviele Bewerber gibt wie Themen.
        while($j < $themaAnzahl)
        {
            if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
            {
                if($bewerberAnzahlStudien >= $themaAnzahl || $bewerbersucht = 1)
                {
                    $bewerbungErhalten = false;
                    //Es wird nach einem Bewerber gesucht, der das Thema als einen seiner Wünsche angegeben hatte.
                    //Wird er gefunden, dann werden seine Daten zwischengespeichert.
                    while($i < $bewerberAnzahlStudien)
                    {
                        if($bewerberinfos[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 115;
                            $TauschThema = $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        }
                        if($bewerberinfos[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 110;
                            $TauschThema = $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        } 
                        else if($bewerberinfos[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                        {
                            $k = 0;
                            while($k < $themaAnzahl){
                                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] == $themen[$k]['thema_id']){
                                    $Punktzahl1 = $themen[$themen[$k]['thema_id']]['Punkte'];
                                    $k = $themaAnzahl;
                                }else{$k=$k+1;}
                            }
                            $Punktzahl2 = 105;
                            $TauschThema = $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'];
                            $bewerbungErhalten = true;
                            break 1;
                        }
                        $i = $i + 1;
                    }
                    $i = 0;
                    $t = 0;

                    if($bewerbungErhalten == true)
                    {
                        //Nach einem Bewerber suchen, der noch kein Thema hat und das alte Thema nehmen könnte
                        while($i < $bewerberAnzahlRest)
                        {
                            if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] == "Hat nichts!")
                            {
                                if($bewerberinfoPlus[$i]['wunschthema1'] == $TauschThema)
                                {
                                    //Sollte man mehr Priorität auf die Wünsche und nicht die Themenvergabe
                                    //setzen wollen, dann kann man die Punkte geringer setzen.
                                    //Momentan wird bei den "if"-Abfragen True rauskommen, da die Themenvergabe
                                    //als Priorität angegeben wurde
                                    $Saldo = 115 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {
                                        //Hier findet der "tausch" statt.
                                        //Punkte aktuallisierung
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        //Das noch nicht vergebene Thema bekommt nun den Bewerber zugewiesen und umgekehrt.
                                        while($t < $bewerberAnzahlStudien){
                                            if($bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t= $t+1;}
                                        }
                                        //Der Bewerber der vorher noch nichts hatte bekommt nun das Thema vom
                                        //vorherigen Bewerber
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 115;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t= $t+1;}
                                        }
                                    }
                                }
                                if($bewerberinfoPlus[$i]['wunschthema2'] == $TauschThema)
                                {
                                    $Saldo = 110 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {                                           
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        while($t < $bewerberAnzahlStudien){
                                            if($bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t= $t+1;}
                                        }
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 110;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t= $t+1;}
                                        }
                                    }
                                }
                                if($bewerberinfoPlus[$i]['wunschthema3'] == $TauschThema)
                                {
                                    $Saldo = 105 + $Punktzahl2 - $Punktzahl1;
                                    if($Saldo >= 0)
                                    {
                                        $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                        $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                        while($t < $bewerberAnzahlStudien){
                                            if($bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] == $TauschThema){
                                                $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                $bewerberinfos[$bewerberinfos[$t]['belegwunsch_id']]['Thema'] = $themen[$j]['thema_id'];
                                                break;
                                            }else{$t=$t+1;}
                                        }
                                        $t = 0;
                                        while($t < $themaAnzahl){
                                            if($themen[$t]['thema_id'] == $TauschThema){
                                                $themen[$themen[$t]['thema_id']]['Punkte'] = 105;
                                                $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfoPlus[$i]['belegwunsch_id'];
                                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                break 2;
                                            }else{$t=$t+1;}
                                        }
                                    }
                                }
                            }
                            $i = $i +1;
                        }
                    }
                }
            }
            $j = $j + 1;
        }

        
        $i = 0;
        while($i < $bewerberAnzahlStudien)
        {
            if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] != "kein Thema")
            {
                $this->belegwunsch_model->setThema($bewerberinfos[$i]['belegwunsch_id'], $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema']);
            }
            $i = $i + 1;
        } 
        $i = 0;
        while($i < $bewerberAnzahlRest)
        {
            if($bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema'] != "kein Thema")
            {
                $this->belegwunsch_model->setThema($bewerberinfoPlus[$i]['belegwunsch_id'], $bewerberinfoPlus[$bewerberinfoPlus[$i]['belegwunsch_id']]['Thema']);
            }
            $i = $i + 1;
        } 
    }
    public function export($action,$art,$id)
    {
        if($action == 'expWH'){     
            if($art == 'all'){ // Alle Listen d.h Vergebene, Nicht-vergebene und Liste nachdem Nachrückv. falls vorhanden
                $bewerber = $this->thema_model->einsichtThemaModulBeleg($id); // Hole alle, die ein Thema haben
                $keinThemaCount = $this->thema_model->keinThemaCount($id); // Hole alle, die KEIN Thema haben
                $keinThema = $this->thema_model->keinThema($id);
                include('../app/view/export/download.php');
            }
            else if($art == 'verfTh'){
                echo "verf";
            }
            else if($art == 'vergTh'){
                echo "verg";
            }
            else if($art == 'nachr'){
                echo "nr";
            }
        }

        else if($action == 'expBEL'){
             // Alle Listen d.h Vergebene, Nicht-vergebene und Liste nachdem Nachrückv. falls vorhanden
                $bewerber = $this->thema_model->einsichtThemaModulBeleg($id); // Hole alle, die ein Thema haben
                $keinThemaCount = $this->thema_model->keinThemaCount($id); // Hole alle, die KEIN Thema haben
                $keinThema = $this->thema_model->keinThema($id);

                if( ($this->modul_model->getNachrueckverfahren($id) == 'true') && 
                ($this->belegwunsch_model->countAnzWHBeleg($id)  > 0 ) ){
                    $cWH = true;  }  else { $cWH = false;}
                $anmeldungen = $this->belegwunsch_model->getWHThBeleg($id); 
                // Nachr fehlt
                include('../app/view/export/download.php');
            
        }

        if($action == 'expBEW'){     
            if($art == 'all'){ // Alle Listen d.h Vergebene, Nicht-vergebene und Liste nachdem Nachrückv. falls vorhanden
            }
            else if($art == 'verfTh'){
                echo "verf";
            }
            else if($art == 'vergTh'){
                echo "verg";
            }
            else if($art == 'nachr'){
                echo "nr";
            }
        }

    }

          
function convertToWindowsCharset($string) {
    $charset =  mb_detect_encoding(
    $string,
    "UTF-8, ISO-8859-1, ISO-8859-15",
    true
    );
        $string =  mb_convert_encoding($string, "Windows-1252", $charset);
        return $string;
    }


    public function getModal($form, $id)
    {
        switch ($form) {
            case '_bel':
            $infos = $this->belegwunsch_model->info_belegwunsch($id);
            include 'app/view/modals/.php';
            break;

            case 'swap':
            $infos = $this->belegwunsch_model->info_belegwunsch($id);
            include 'app/view/modals/swap.php'; 
            break;
        }
    }

    public function getAnnahmeModal($iteration, $matrikelnummer, $thema_id)
    {
        $modal['btn_url'] = '/einsicht/annehmen/'.$iteration.'/'.$thema_id;
        include 'app/view/modals/bewerbung_annehmen.php';
    }

    public function mailBearbeitung($genommen, $thema_id)
    {
        $bewerber = $this->bewerbung_model->bewerber($thema_id);
        $themabezeichnung = $this->thema_model->getThemenbezeichnung($thema_id);
        $betreff_angenommen = "Sie wurden für das Thema '#thema' angenommen!";
        $inhalt_angenommen = "Hallo #bewerber, </br> hiermit möchten wir Sie darüber informieren, dass sie das Thema #thema erhalten haben.";
        //$inhalt_angenommen = str_replace("#thema", $themabezeichnung, $inhalt_angenommen1, $count);
        //echo $count;
        include 'app/view/einsicht/annehmen_view.php';
        
    }

    public function sendMail($wahl, $student)
    {

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'user@example.com';                 // SMTP username
            $mail->Password = 'secret';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            while($i < count($student)){
                $mail->addAddress($student[$i]['email'], $student[$i]['vorname']." ".$student[$i]['nachname']);     // Add a recipient
                $i = $i + 1;
            }
            $mail->addReplyTo('info@example.com', 'Information');

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $annehmenbody = "Sie haben das <b>Thema</b> erhalten!";
            $ablehnenbody = "Sie haben das Thema leider <b>nicht</b> erhalten.";
            if($wahl == "annehmen"){
                $mail->Subject = 'Here is the subject';
                $mail->Body    = $annehmenbody;
                $mail->AltBody = strip_tags($annehmenbody);
            }else{
                $mail->Subject = 'Here is the subject';
                $mail->Body    = $ablehnenbody;
                $mail->AltBody = strip_tags($ablehnenbody);
            }

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}