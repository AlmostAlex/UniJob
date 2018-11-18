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
            $sw = $this->modul_model->getSw($modul_id);
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

    public function swap($thID, $bewID){
        $themenbezeichnung = $this->thema_model->SwapBewThema($thID);
        $thema_id = $this->thema_model->getTHID($thID);
        $swapThemen = $this->thema_model->swapThemen($thID);

        if($thID == NULL){
        } else {
        include_once(__DIR__."/../view/einsicht/swap.php");
        }
    }

    public function swapAgainst($bewID_von,$bewThID_von, $bewID_zu, $bewThID_zu){

        $themenbezeichnung = $this->thema_model->SwapBewThema($bewID_zu);
        $thema_id = $this->thema_model->getTHID($bewID_zu);
        
        $swapThemen = $this->thema_model->swapThemen($bewID_zu);
        $isNull = $this->thema_model->isNull($bewID_zu);

        $this->belegwunsch_model->setModulSW($bewID_von, $bewThID_von, $bewID_zu, $bewThID_zu);
        
        echo 'von'. $bewID_von .' '. $bewThID_von .' zu '.  $bewID_zu .' '. $bewThID_zu ;

        // WENN THEMA NULL ODER DAS THEMA VORHANDEN IST
        if($bewThID_zu == 'NULL'){
        $this->belegwunsch_model->tauschzuKeinTH($bewID_von);
        } else if($this->thema_model->isNull($bewThID_zu) == 'True'){
        $this->belegwunsch_model->tauschzuVTH($bewID_von,$bewThID_zu);
        } else { // WENN GEGEN EIN VERGEBENES THEMA 

        // ----------------------------------------------

        $this->belegwunsch_model->tauschzuVergTH($bewID_von, $bewThID_von, $bewID_zu, $bewThID_zu);
        $themenbezeichnung = "Kein Thema erhalten";
        $swapThemen = $this->thema_model->swapThemen($bewThID_zu);
        $bewID_von  = $bewID_zu; 
        $bewThID_von = $bewThID_zu; 
            echo  " ---->>>>>>>> ". $bewThID_zu;
    
        include_once(__DIR__."/../view/einsicht/swap2.php");
        }

    }

    public function Belegwunschverteilung($modul_id){
            //Festlegen der Bewerberanzahl und der ThemaAnzahl
            //Festlegen der Bewerberanzahl und der ThemaAnzahl
            $bewerberAnzahl = $this->belegwunsch_model->beleg_count($modul_id);
            $themaAnzahl = $this->modul_model->getThemenAnzahl($modul_id);
            
            //Status der Themen auf "Frei" setzen und Status der Bewerber auf "Hat nichts!" setzen.
            $bewerberinfos = $this->belegwunsch_model->getBewerberInfos($modul_id);            
            //shuffle($bewerberinfos);
            $k=0;
            while($k < $bewerberAnzahl)
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
            while($i < $bewerberAnzahl)
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
            while($i < $bewerberAnzahl)
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
            while($i < $bewerberAnzahl)
            { 
                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] != "Hat was!")
                {    //echo "i = ".$i."- j = ".$j." - Bewerber = ".$bewerberinfos[$i]['belegwunsch_id']." und status = ".$bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status']." - Thema = ".$bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema']." Wunsch3 = ".$bewerberinfos[$i]['wunschthema3']."</br>";
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
            //Prüfen, ob es noch Freie Themen gibt, welche vergeben werden können
            //->Bedingung dafür ist, dass es min. soviele Bewerber gibt wie Themen.
            while($j < $themaAnzahl)
            {
                if($themen[$themen[$j]['thema_id']]['Status'] == "Frei")
                {
                    echo $themen[$j]['thema_id'];
                    if($bewerberAnzahl >= $themaAnzahl)
                    {
                        $bewerbungErhalten = false;
                        //Es wird nach einem Bewerber gesucht, der das Thema als einen seiner Wünsche angegeben hatte.
                        //Wird er gefunden, dann werden seine Daten zwischengespeichert.
                        while($i < $bewerberAnzahl)
                        {
                            if($bewerberinfos[$i]['wunschthema1'] == $themen[$j]['thema_id'])
                            { echo "wunsch1  -  j = ".$j." - i = ".$i."</br>";
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
                                break;
                            }
                            if($bewerberinfos[$i]['wunschthema2'] == $themen[$j]['thema_id'])
                            { echo "wunsch2  -  j = ".$j." - i = ".$i."</br>";
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
                                break;
                            } 
                            else if($bewerberinfos[$i]['wunschthema3'] == $themen[$j]['thema_id'])
                            {echo "wunsch3";
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
                                break;
                            }
                            $i = $i + 1;
                        }
                        $i = 0;
                        $t = 0;

                        if($bewerbungErhalten == true)
                        {
                            //Nach einem Bewerber suchen, der noch kein Thema hat und das alte Thema nehmen könnte
                            while($i < $bewerberAnzahl)
                            {
                                if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] == "Hat nichts!")
                                {
                                    if($bewerberinfos[$i]['wunschthema1'] == $TauschThema)
                                    { echo "wunsch1";
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
                                            while($t < $bewerberAnzahl){
                                                if($bewerberinfos[$t]['belegwunsch_id']['Thema'] == $TauschThema){
                                                    $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                    $bewerberinfos[$t]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                                                    $t = $bewerberAnzahl;
                                                }else{$t= $t+1;}
                                            }
                                            //Der Bewerber der vorher noch nichts hatte bekommt nun das Thema vom
                                            //vorherigen Bewerber
                                            $t = 0;
                                            while($t < $themaAnzahl){
                                                if($themen[$t]['thema_id'] == $TauschThema){
                                                    $themen[$t]['thema_id']['Punkte'] = 115;
                                                    $themen[$t]['thema_id']['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                    $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                    $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                    $t = $themaAnzahl;
                                                }else{$t= $t+1;}
                                            }
                                        }
                                    }
                                    if($bewerberinfos[$i]['wunschthema2'] == $TauschThema)
                                    { echo "wunsch2!!".$i." - ".$j;
                                        $Saldo = 110 + $Punktzahl2 - $Punktzahl1;
                                        if($Saldo >= 0)
                                        {                                           
                                            $themen[$themen[$j]['thema_id']]['Punkte'] = $Punktzahl2;
                                            $themen[$themen[$j]['thema_id']]['Status'] = "Vergeben";
                                            while($t < $bewerberAnzahl){
                                                if($bewerberinfos[$t]['belegwunsch_id']['Thema'] == $TauschThema){
                                                    $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                    $bewerberinfos[$t]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                                                    $t = $bewerberAnzahl;
                                                }else{$t= $t+1;}
                                            }
                                            $t = 0;
                                            while($t < $themaAnzahl){
                                                if($themen[$t]['thema_id'] == $TauschThema){
                                                    $themen[$themen[$t]['thema_id']]['Punkte'] = 110;
                                                    $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                    $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                    $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                    $t = $themaAnzahl;
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
                                            while($t < $bewerberAnzahl){
                                                if($bewerberinfos[$t]['belegwunsch_id']['Thema'] == $TauschThema){
                                                    $themen[$themen[$j]['thema_id']]['Bewerber'] = $bewerberinfos[$t]['belegwunsch_id'];
                                                    $bewerberinfos[$t]['belegwunsch_id']['Thema'] = $themen[$j]['thema_id'];
                                                    $t = $bewerberAnzahl;
                                                }else{$t=$t+1;}
                                            }
                                            $t = 0;
                                            while($t < $themaAnzahl){
                                                if($themen[$t]['thema_id'] == $TauschThema){
                                                    $themen[$themen[$t]['thema_id']]['Punkte'] = 105;
                                                    $themen[$themen[$t]['thema_id']]['Bewerber'] = $bewerberinfos[$i]['belegwunsch_id'];
                                                    $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Status'] = "Hat was!";
                                                    $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] = $themen[$t]['thema_id'];
                                                    $t = $themaAnzahl;
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
        //In der Datenbank den Bewerben die Themen zuordnen und nochmal die Punkte bestimmen.
        $gesamtPunktzahl = 0;
        while($i < $bewerberAnzahl)
        { 
            if($bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema'] != "kein Thema")
            {
                $this->belegwunsch_model->setThema($bewerberinfos[$i]['belegwunsch_id'], $bewerberinfos[$bewerberinfos[$i]['belegwunsch_id']]['Thema']);
            }
            $i = $i + 1;
        }
    }
}
