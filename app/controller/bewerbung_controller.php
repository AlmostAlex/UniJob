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

    public function Route($action,$id,$state)
    {
        if($action == 'Abschlussarbeit'){
            $this->Bewerbung_Abschlussarbeit($id,$state);
        }
        else{
            $this->Bewerbung_Seminararbeit($id,$state); 
        }
    }

    public function Bewerbung_Abschlussarbeit($id,$state)
    {

        if($state=='false')
        {
            $vorkenntnisse = $this->vorkenntnisse_model->VorkenntnisseByThemaID($id);
            if(empty($vorkenntnisse)){$msg_vork =''; } else{$msg_vork ='Empfohlene Vorkenntnisse: ';}
             
                include (__DIR__."/../../ajax/showVorkenntnisse.php");                     
        }
else{
 
     if($this->modul_model->getVerfuegbarkeitID($id) == 'Offen'){
        if($this->modul_model->getModulNachrueckvByID($id) == 'false'){
            if($this->modul_model->getModulVerfahrenByID($id) == 'Windhundverfahren'){
                    $modul = $this->modul_model->getModulById($id);
                    $themen = $this->thema_model->getThemenVG($id,'');


                            if(isset($_POST['Vorname'])) { $vorname = $_POST['Vorname']; } else{ $vorname = '';}
                            if(isset($_POST['Nachname'])) { $nachname = $_POST['Nachname']; } else{ $nachname = '';}
                            if(isset($_POST['Matrikelnummer'])) { $matrikelnummer  = $_POST['Matrikelnummer']; } else{ $matrikelnummer = '';}
                            if(isset($_POST['Email'])) { $email  = $_POST['Email']; } else{ $email = '';}
                            if(isset($_POST['Thema'])) { $thema_id  = $_POST['Thema']; $themenbezeichnung = $this->thema_model->getThemenbezeichnung($thema_id); } 
                                else{ $thema_id = $themenbezeichnung = '';}

                            if(isset($_POST['Zulassung'])) { $Zulassung  = $_POST['Zulassung']; } else{ $Zulassung = '';}                   

                        if (isset($_POST['bewerbung_ab_WH_weiter'])) {
                            // AB HIER ALLES CHECKEN LASSEN
                           $check_modul = $this->modul_model->checkModul($id);
                           $check_thema = $this->thema_model->checkThema($thema_id); 
                                if($check_modul == 'falseTime'){
                                    $this->getModal("modulFalseTime_AB_WH", $id);
                                    include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';     
                                } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                                    $this->getModal("themaFalseVG_AB_WH", $thema_id);
                                    include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';  
                                } else if($check_modul == "true" && $check_thema == "true"){
                                    // HIER INSERT BEWERBUNG
                                    include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                                }      
                        }
                    else{    
   
                        include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';
                    }

                    if (isset($_POST['bewerbung_ab_WH_back'])) {
                        include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                    }
            }

            else if($this->modul_model->getModulVerfahrenByID($id) == 'bewerbungsverfahren'){
                echo"2";
                include 'app/view/bewerbung/bewerbung_view.php';
            }

            else if($this->modul_model->getModulVerfahrenByID($id) == 'belegwunschverfahren'){
                echo"3";
                include 'app/view/bewerbung/belegwunsch_view.php';
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

                case 'themaFalseVG_AB_WH':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Anmeldung fehlgeschlagen!';
                $modal['body_class'] = 'alert alert-danger';
                $modal['content'] = '<b>Achtung!</b><br> Das Thema ist bereits <b>vergeben</b>. <br>Du konntest dich <b>nicht</b> für das Modul und dem dazugehörigen Thema anmelden.';
                $modal['img'] = '/img/ups.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';


            }                          
        }
}