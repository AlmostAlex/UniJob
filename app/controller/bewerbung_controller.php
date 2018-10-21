<?php
include_once (__DIR__."/../model/modul_model.php");
include_once(__DIR__."/../model/thema_model.php");
include_once(__DIR__."/../model/vorkenntnisse_model.php");
include_once(__DIR__."/../../db.php"); 

class bewerbung_controller
{
    public $model;

    public function __construct()
    {
        $this->modul_model = new modul_model();
        $this->thema_model = new thema_model();
        $this->vorkenntnisse_model = new vorkenntnisse_model();
        date_default_timezone_set("Europe/Berlin");
        $this->heute_dt = new DateTime(date("Y-m-d"));
    }

    public function Route($action,$id,$state,$kat)
    {
        if($action == 'Abschlussarbeit'){
            $this->Bewerbung_Abschlussarbeit($id,$state,$kat);
        }
        else{
            $this->Bewerbung_Seminararbeit($id,$state,$kat); 
        }
    }

    public function Bewerbung_Abschlussarbeit($id,$state,$kat)
    {
        $module = $this->modul_model->getModulById($id);

        if($state=='false' && $kat =='WH')
        {
            $vorkenntnisse = $this->vorkenntnisse_model->VorkenntnisseByThemaID($id);
            if(empty($vorkenntnisse)){$msg_vork =''; } else{$msg_vork ='Empfohlene Vorkenntnisse: ';}
             
                include (__DIR__."/../../ajax/showVorkenntnisse_AB_WH.php");                     
        }
        else if($state=='false' && $kat =='BW')
        {
            $vorkenntnisse = $this->vorkenntnisse_model->VorkenntnisseByThemaID($id);
            if(empty($vorkenntnisse)){$msg_vork =''; } else{$msg_vork ='Empfohlene Vorkenntnisse: ';}
             
                include (__DIR__."/../../ajax/showVorkenntnisse_AB_BW.php");                     
        }
        else if($state=='false' && $kat =='BEL1')
        {
            $vorkenntnisse = $this->vorkenntnisse_model->VorkenntnisseByThemaID($id);
            if(empty($vorkenntnisse)){$msg_vork =''; } else{$msg_vork ='Empfohlene Vorkenntnisse: ';}
             
                include (__DIR__."/../../ajax/vorkenntnisse_BEL/showVorkenntnisse_AB_BEL1.php");                     
        }


else{
 
    if(isset($_POST['Thema'])) { $thema_id  = $_POST['Thema']; $themenbezeichnung = $this->thema_model->getThemenbezeichnung($thema_id); } 
    else{ $thema_id = $themenbezeichnung = '';}
    if(isset($_POST['Vorname'])) { $vorname = $_POST['Vorname']; } else{ $vorname = '';}
    if(isset($_POST['Nachname'])) { $nachname = $_POST['Nachname']; } else{ $nachname = '';}
    if(isset($_POST['Matrikelnummer'])) { $matrikelnummer  = $_POST['Matrikelnummer']; } else{ $matrikelnummer = '';}
    if(isset($_POST['Email'])) { $email  = $_POST['Email']; } else{ $email = '';}
    if(isset($_POST['Zulassung'])) { $Zulassung  = $_POST['Zulassung']; } else{ $Zulassung = '';} 
    $check_modul = $this->modul_model->checkModul($id);
    $check_thema = $this->thema_model->checkThema($thema_id); 
     if($this->modul_model->getVerfuegbarkeitID($id) == 'Offen'){
        if($this->modul_model->getModulNachrueckvByID($id) == 'false'){

 // WINDHNDVERFAHREN ABSCHLUSS
            if($this->modul_model->getModulVerfahrenByID($id) == 'Windhundverfahren'){
                    $modul = $this->modul_model->getModulById($id);
                    $themen = $this->thema_model->getThemenVG($id,'');

                        if (isset($_POST['bewerbung_ab_WH'])) {
                            // AB HIER ALLES CHECKEN LASSEN
                                if($check_modul == 'falseTime'){
                                    $this->getModal("modulFalseTime_AB_WH", $id);
                                    include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';     
                                } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                                    $this->getModal("themaFalseVG_AB_WH", $thema_id);
                                    include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';  
                                } else {
                                    // HIER INSERT BEWERBUNG
                                    $this->getModal("AB_WH_erfolgreich", $thema_id);
                                    include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                                }      
                        }
                    else{     
                        include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';
                    }
            }
// BEWERBUNGSVERFAHREN ABSCHLUSS
        else if($this->modul_model->getModulVerfahrenByID($id) == 'Bewerbungsverfahren'){
            
            if(isset($_POST['Thema'])) { $thema_id  = $_POST['Thema']; $themenbezeichnung = $this->thema_model->getThemenbezeichnung($thema_id); } 
            else{ $thema_id = $themenbezeichnung = '';}
            if(isset($_POST['Vorname'])) { $vorname = $_POST['Vorname']; } else{ $vorname = '';}
            if(isset($_POST['Nachname'])) { $nachname = $_POST['Nachname']; } else{ $nachname = '';}
            if(isset($_POST['Matrikelnummer'])) { $matrikelnummer  = $_POST['Matrikelnummer']; } else{ $matrikelnummer = '';}
            if(isset($_POST['Email'])) { $email  = $_POST['Email']; } else{ $email = '';}
            if(isset($_POST['Fachsemester'])) { $fachsemester  = $_POST['Fachsemester']; } else{ $fachsemester = '';}
            if(isset($_POST['Studiengang'])) { $studiengang  = $_POST['Studiengang']; } else{ $studiengang = '';}
            if(isset($_POST['Credits'])) { $credits  = $_POST['Credits']; } else{ $credits = '';}
            $modul = $this->modul_model->getModulById($id);
            $themen = $this->thema_model->getThemenVG($id,'');
            if (isset($_POST['bewerbung_ab_BW'])) {
                // AB HIER ALLES CHECKEN LASSEN
                    if($check_modul == 'falseTime'){
                        $this->getModal("modulFalseTime_AB_WH", $id);
                        include 'app/view/bewerbung/Abschlussarbeit/bewerbung_view_abschluss.php';     
                    } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                        $this->getModal("themaFalseVG_AB_WH", $thema_id);
                        include 'app/view/bewerbung/Abschlussarbeit/bewerbung_view_abschluss.php';  
                    } else {
                        // HIER INSERT BEWERBUNG
                        $this->getModal("AB_BW_erfolgreich", $thema_id);
                       // include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                    }      
            }
        else{     
            include 'app/view/bewerbung/Abschlussarbeit/bewerbung_view_abschluss.php';
        }
    }

// BELEGWUNSCHVERFAHREN ABSCHLUSS
            else if($this->modul_model->getModulVerfahrenByID($id) == 'Belegwunschverfahren'){

                if(isset($_POST['Thema'])) { $thema_id  = $_POST['Thema']; 
                $j=0;
                while ($j < count($thema_id)) {
                echo $thema_id[$j];
                $j++;
                }
}               
                if(isset($_POST['Vorname'])) { $vorname = $_POST['Vorname']; } else{ $vorname = '';}
                if(isset($_POST['Nachname'])) { $nachname = $_POST['Nachname']; } else{ $nachname = '';}
                if(isset($_POST['Matrikelnummer'])) { $matrikelnummer  = $_POST['Matrikelnummer']; } else{ $matrikelnummer = '';}
                if(isset($_POST['Email'])) { $email  = $_POST['Email']; } else{ $email = '';}

                $modul = $this->modul_model->getModulById($id);
                $themen = $this->thema_model->getThemenVG($id,'');

                if (isset($_POST['bewerbung_ab_BEL'])) {
                   
                    // AB HIER ALLES CHECKEN LASSEN
                        if($check_modul == 'falseTime'){
                            $this->getModal("modulFalseTime_AB_WH", $id);
                            include 'app/view/bewerbung/Abschlussarbeit/belegwunsch_view_abschluss.php';     
                        } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                            $this->getModal("themaFalseVG_AB_WH", $thema_id);
                            include 'app/view/bewerbung/Abschlussarbeit/belegwunsch_view_abschluss.php';  
                        } else {
                            // HIER INSERT BEWERBUNG
                            $this->getModal("AB_BW_erfolgreich", $thema_id);
                            include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                        }      
                }
            else{     
                include 'app/view/bewerbung/Abschlussarbeit/belegwunsch_view_abschluss.php';
            }

            }
        }
            else{ // Wenn Nachrueckverfahren ist, wird immer winhund-formular angezeigt
             echo"nachrueckv";
                include 'app/view/bewerbung/windhund_view.php';
            } 
       } 
        else{
            echo "nicht gueltig";
        }
    }
}

    public function Bewerbung_Seminararbeit($id,$state)
    {
        echo"seminar";
    }


        /*
        $thema = $this->thema_model->getThemen($id);

        if($modul[0]['kategorie'] == 'Seminararbeit' && $modul[0]['nachrueckv_status'] == 'true')
        {
            if (isset($_POST['bewerbung_windhund'])) 
            {
            $vorname = $_POST["Vorname"];
            $nachname = $_POST["Nachname"];
            $matrikelnummer = $_POST["Matrikelnummer"];
            $email = $_POST["Email"];
            $thema_id = $_POST["Thema"];
            $this->Windhundbewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $modul_id);
            }
            include 'app/view/bewerbung/windhund_view.php';

        } elseif($modul[0]['kategorie'] == 'Seminararbeit' && $modul[0]['nachrueckv_status'] == ''){

            if ($modul[0]['verfahren'] == 'Windhundverfahren')
            {
                if (isset($_POST['bewerbung_windhund'])) 
                {
                $vorname = $_POST["Vorname"];
                $nachname = $_POST["Nachname"];
                $matrikelnummer = $_POST["Matrikelnummer"];
                $email = $_POST["Email"];
                $thema_id = $_POST["Thema"];
                $this->Windhundbewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $modul_id);
                }
                include 'app/view/bewerbung/windhund_view.php';

            } else if ($modul[0]['verfahren'] == 'bewerbung'){
                include 'app/view/bewerbung/bewerbung_view.php';

            } else if ($modul[0]['verfahren'] == 'belegwunsch'){
                include 'app/view/bewerbung/belegwunsch_view.php';

            }
        } else //Wenn man sich auf Abschlussthemen bewirbt
        {
            include 'app/view/bewerbung/abschluss_view.php';
        }
    }

    public function Windhundbewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $modul_id) 
    {
        //Hier wird geprüft, ob der Student sich bereits auf ein Thema in dem Modul beworben hat oder schon genommen wurde
        $prüfung = $this->windhund->duplikatPrüfung($modul_id);
        $prüfung->bind_result($matrikelDB, $status);
        $prüfung->store_result();
        $vorhanden = 0;
        while ($prüfung->fetch()) 
        {
            if (($matrikelnummer == $matrikelDB) && ($status != "abgelehnt")) 
            {
                $vorhanden += 1;
            }
        }

        //Wenn er sich noch nicht beworben hat, dann werden seine Infromationen dem Thema zugeordnet
        //Und das Thema wird auf vergeben gestellt
        if ($vorhanden == 0) 
        {
            $this->windhund->insertWindhund($vorname, $nachname, $matrikelnummer, $email, $thema_id, "offen");            
            $this->thema->updateVerfuegbarkeit($thema_id, "Vergeben");
            $thema = $this->thema_model->getThema($thema_id);
                     
            while ($statement->fetch()) 
            { 
                //Modal zur erfolgreichen Eintragung anzeigen
                $modal['case'] = 'Sicherheitsabfrage_';
                $modal['title'] = 'Eintragung erfolgreich!';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Sie haben sich erfolgreich für das Thema <b>"' . $thema[0]['themenbezeichnung'] . '"</b> eingetragen!';
                $modal['btn'] = '<i class="far fa-trash-alt"></i> Fertig';
                $modal['btn_class'] = 'btn btn-success';
                $modal['btn_url'] = '/modul_uebersicht/modul_uebersicht_view.php/';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
            }           
        }
        
 */

        public function getModal($form, $id) // Modal Konfigurationen
        {
           $modal['case'] = $modal['title'] = $modal['body_class'] = $modal['content'] = $modal['img'] = $modal['btn'] = $modal['btn_class'] = $modal['btn_url'] = '';

            switch ($form) {
                case 'modulFalseTime_AB_WH':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Anmeldung fehlgeschlagen!';
                $modal['body_class'] = 'alert alert-danger';
                $modal['content'] = '<b>Achtung!</b><br> Der <b>Anmeldezeitraum</b> ist bereits <b>beendet</b>. <br>Du konntest dich <b>nicht</b> für das Modul und dem dazugehörigen Thema anmelden.';
                $modal['img'] = '/img/ups.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

                case 'themaFalseVG_AB_WH':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Anmeldung fehlgeschlagen!';
                $modal['body_class'] = 'alert alert-danger';
                $modal['content'] = '<b>Achtung!</b><br> Das Thema ist bereits <b>vergeben</b>. <br>Du konntest dich <b>nicht</b> für das Modul und dem dazugehörigen Thema anmelden.';
                $modal['img'] = '/img/ups.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

                case 'anmeldung_senden':
                $modal['case'] = 'bewerbung_senden';
                $modal['title'] = 'Sicherheitsabfrage: Modul archvieren?';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Wollen sie das Modul "<b></b>" mit den dazgehörigen Daten sicher archivieren?';
                $modal['btn'] = 'Modul archivieren';
                $modal['btn_class'] = 'btn btn-primary';
                $modal['btn_url'] = '/mt_verwaltung/modul/archivierung/' . $id;
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

                case 'bewerbung_senden':
                $modal['case'] = 'bewerbung_senden';
                $modal['title'] = 'Sicherheitsabfrage: Modul archvieren?';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Wollen sie das Modul "<b></b>" mit den dazgehörigen Daten sicher archivieren?';
                $modal['btn'] = 'Modul archivieren';
                $modal['btn_class'] = 'btn btn-primary';
                $modal['btn_url'] = '/mt_verwaltung/modul/archivierung/' . $id;
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

                case 'AB_WH_erfolgreich':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Erfolgreich angemeldet!';
                $modal['body_class'] = 'alert alert-success';
                $modal['content'] = 'Du hast dich erfolgreich für das Modul mit dem dazugehörigen Thema angemeldet.<br><br>';
                $modal['img'] = '/img/checked.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';                
                break;

                case 'AB_BW_erfolgreich':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Erfolgreich angemeldet!';
                $modal['body_class'] = 'alert alert-success';
                $modal['content'] = 'Du hast dich erfolgreich für das Modul mit dem dazugehörigen Thema angemeldet.<br><br>';
                $modal['img'] = '/img/checked.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';                
                break;




            }                          
        }
}