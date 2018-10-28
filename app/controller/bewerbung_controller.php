<?php
include_once (__DIR__."/../model/modul_model.php");
include_once(__DIR__."/../model/thema_model.php");
include_once(__DIR__."/../model/vorkenntnisse_model.php");
include_once(__DIR__."/../model/windhund_model.php");
include_once(__DIR__."/../model/bewerbung_model.php");
include_once(__DIR__."/../model/bewerb_vorkennt_model.php");
include_once(__DIR__."/../../db.php"); 

class bewerbung_controller
{
    public $model;

    public function __construct()
    {
        $this->modul_model = new modul_model();
        $this->thema_model = new thema_model();
        $this->vorkenntnisse_model = new vorkenntnisse_model();
        $this->windhund_model = new windhund_model();
        $this->bewerbung_model = new bewerbung_model();
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

    public function Bewerbung_Abschlussarbeit($id,$state,$kat){  //$id = $modul_id
    if(isset($_POST['Thema'])) { $thema_id  = $_POST['Thema']; $themenbezeichnung = $this->thema_model->getThemenbezeichnung($thema_id); } 
    else{ $thema_id = $themenbezeichnung = '';}
    if(isset($_POST['Vorname'])) { $vorname = $_POST['Vorname']; } else{ $vorname = '';}
    if(isset($_POST['Nachname'])) { $nachname = $_POST['Nachname']; } else{ $nachname = '';}
    if(isset($_POST['Matrikelnummer'])) { $matrikelnummer  = $_POST['Matrikelnummer']; } else{ $matrikelnummer = '';}
    if(isset($_POST['Email'])) { $email  = $_POST['Email']; } else{ $email = '';}
    if(isset($_POST['Zulassung'])) { $zulassung  = $_POST['Zulassung']; } else{ $zulassung = '';}
    $check_modul = $this->modul_model->checkModul($id);
    $check_thema = $this->thema_model->checkThema($thema_id); 
    $modul = $this->modul_model->getModulById($id);
    $themen = $this->thema_model->getThemenVG($id,'');
     if($this->modul_model->getVerfuegbarkeitID($id) == 'Offen'){
        if($this->modul_model->getModulNachrueckvByID($id) == 'false'){
 // WINDHNDVERFAHREN ABSCHLUSS
            if($this->modul_model->getModulVerfahrenByID($id) == 'Windhundverfahren'){

                        if (isset($_POST['bewerbung_ab_WH'])) {
                            // AB HIER ALLES CHECKEN LASSEN
                                if($check_modul == 'falseTime'){
                                    $this->getModal("modulFalseTime", $id);
                                    include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';     
                                } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                                    $this->getModal("themaFalseVG", $thema_id);
                                    include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';  
                                } else {
                                    // HIER INSERT BEWERBUNG
                                //    $this->windhund_model->insertWindhund($vorname, $nachname, $matrikelnummer, $email, $thema_id, $zulassung);
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
            $dup = '';
            echo "nix nix nix";
            $modul = $this->modul_model->getModulById($id);
            $themen = $this->thema_model->getThemenVG($id,'');
            if (isset($_POST['bewerbung_ab_BW'])) {
                echo"bew";
                echo"bew";
                // AB HIER ALLES CHECKEN LASSEN
                    if($check_modul == 'falseTime'){
                        $this->getModal("modulFalseTime", $id);
                        include 'app/view/bewerbung/Abschlussarbeit/bewerbung_view_abschluss.php';
                    } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                        $this->getModal("themaFalseVG", $thema_id);
                        include 'app/view/bewerbung/Abschlussarbeit/bewerbung_view_abschluss.php';
                    } else {
                        // HIER INSERT BEWERBUNG
                        if( $dup == "duplikat"){
                            echo "hello6666";
   // Hier hat Alex verkackt   // if(($this->bewerbung_model->duplicateBewerbungCheck($matrikelnummer, $thema_id)) == "duplikat"){
   
    /* Bei der bewerbung wird jedes feld mit den VOrraussetzungen genommen und geprüft und die Punkte vergeben! */ 
   /* Das Feld "Vorraussetzung macht hier also beim insert NULL Sinn "*/        
   
                            $this->punkteBerechnung($fachsemester, $studiengang, $credits, " "); //Vorraussetzungen
                            $this->bewerbung_model->updateBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $zulassung);
                            $this->getModal("AB_BW_erfolgreich", $thema_id);
                           include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                            
                        } else {
                            echo "hello";
                            $this->bewerbung_model->insertBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $zulassung);
                            $this->getModal("AB_BW_erfolgreich", $thema_id);
                            include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                        }
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
                            $this->getModal("modulFalseTime", $id);
                            include 'app/view/bewerbung/Abschlussarbeit/belegwunsch_view_abschluss.php';     
                        } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                            $this->getModal("themaFalseVG", $thema_id);
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
             include 'app/view/bewerbung/Abschlussarbeit/windhund_view_abschluss.php';    
            } 
       } 
        else{
            echo "nicht gueltig";
        }
}

// SEMINARARBEIT 
// START
    public function Bewerbung_Seminararbeit($id,$state)
    {
        if(isset($_POST['Thema'])) { $thema_id  = $_POST['Thema']; $themenbezeichnung = $this->thema_model->getThemenbezeichnung($thema_id); } 
        else{ $thema_id = $themenbezeichnung = '';}
        if(isset($_POST['Vorname'])) { $vorname = $_POST['Vorname']; } else{ $vorname = '';}
        if(isset($_POST['Nachname'])) { $nachname = $_POST['Nachname']; } else{ $nachname = '';}
        if(isset($_POST['Matrikelnummer'])) { $matrikelnummer  = $_POST['Matrikelnummer']; } else{ $matrikelnummer = '';}
        if(isset($_POST['Email'])) { $email  = $_POST['Email']; } else{ $email = '';}
        if(isset($_POST['Zulassung'])) { $zulassung  = $_POST['Zulassung']; } else{ $zulassung = '';}
        $check_modul = $this->modul_model->checkModul($id);
        $check_thema = $this->thema_model->checkThema($thema_id); 


          if($this->modul_model->getVerfuegbarkeitID($id) == 'Offen'){
        if($this->modul_model->getModulNachrueckvByID($id) == 'false'){
 // WINDHNDVERFAHREN SEMINAR
            if($this->modul_model->getModulVerfahrenByID($id) == 'Windhundverfahren'){
                    $modul = $this->modul_model->getModulById($id);
                    $themen = $this->thema_model->getThemenVG($id,'');
                        if (isset($_POST['bewerbung_SEM_WH'])) {
                            // AB HIER ALLES CHECKEN LASSEN
                                if($check_modul == 'falseTime'){
                                    $this->getModal("modulFalseTime", $id);
                                    include 'app/view/bewerbung/Seminararbeit/windhund_view_seminar.php';     
                                } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                                    $this->getModal("themaFalseVG", $thema_id);
                                    include 'app/view/bewerbung/Seminararbeit/windhund_view_seminar.php';  
                                } else {
                                    // HIER INSERT BEWERBUNG
                                //    $this->windhund_model->insertWindhund($vorname, $nachname, $matrikelnummer, $email, $thema_id, $zulassung);
                                    $this->getModal("AB_WH_erfolgreich", $thema_id);
                                    include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                                }      
                        }
                    else{
                        include 'app/view/bewerbung/Seminararbeit/windhund_view_seminar.php';
                    }
            }


// TBC
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
    $dup = '';
    echo "nix nix nix";
    $modul = $this->modul_model->getModulById($id);
    $themen = $this->thema_model->getThemenVG($id,'');
    if (isset($_POST['bewerbung_ab_BW'])) {
        echo"bew";
        echo"bew";
        // AB HIER ALLES CHECKEN LASSEN
            if($check_modul == 'falseTime'){
                $this->getModal("modulFalseTime_AB_WH", $id);
                include 'app/view/bewerbung/Abschlussarbeit/bewerbung_view_abschluss.php';
            } else if($check_thema == 'false_TH_Verfuegbarkeit'){
                $this->getModal("themaFalseVG_AB_WH", $thema_id);
                include 'app/view/bewerbung/Abschlussarbeit/bewerbung_view_abschluss.php';
            } else {
                // HIER INSERT BEWERBUNG
                if( $dup == "duplikat"){
                    echo "hello6666";
// Hier hat Alex verkackt   // if(($this->bewerbung_model->duplicateBewerbungCheck($matrikelnummer, $thema_id)) == "duplikat"){

/* Bei der bewerbung wird jedes feld mit den VOrraussetzungen genommen und geprüft und die Punkte vergeben! */ 
/* Das Feld "Vorraussetzung macht hier also beim insert NULL Sinn "*/        

                    $this->punkteBerechnung($fachsemester, $studiengang, $credits, " "); //Vorraussetzungen
                    $this->bewerbung_model->updateBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $zulassung);
                    $this->getModal("AB_BW_erfolgreich", $thema_id);
                   include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                    
                } else {
                    echo "hello";
                    $this->bewerbung_model->insertBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $zulassung);
                    $this->getModal("AB_BW_erfolgreich", $thema_id);
                    include 'app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php';
                }
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

        public function getModal($form, $id) // Modal Konfigurationen
        {
           $modal['case'] = $modal['title'] = $modal['body_class'] = $modal['content'] = $modal['img'] = $modal['btn'] = $modal['btn_class'] = $modal['btn_url'] = '';
           $modal['type'] = $modal['linkage'] = $modal['name'] = '';
            switch ($form) {
                case 'modulFalseTime':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Anmeldung fehlgeschlagen!';
                $modal['body_class'] = 'alert alert-danger';
                $modal['content'] = '<b>Achtung!</b><br> Der <b>Anmeldezeitraum</b> ist bereits <b>beendet</b>. <br>Du konntest dich <b>nicht</b> für das Modul und dem dazugehörigen Thema anmelden.';
                $modal['img'] = '/img/ups.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

                case 'themaFalseVG':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Anmeldung fehlgeschlagen!';
                $modal['body_class'] = 'alert alert-danger';
                $modal['content'] = '<b>Achtung!</b><br> Das Thema ist bereits <b>vergeben</b>. <br>Du konntest dich <b>nicht</b> für das Modul und dem dazugehörigen Thema anmelden.';
                $modal['img'] = '/img/ups.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

                case 'anmeldung_senden':
                $modal['case'] = 'anmeldung_senden';
                $modal['title'] = 'Sicherheitsabfrage: Anmelden?';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Möchtest du wirklich dich da wirklich anmelden?';
                $modal['btn'] = 'Anmeldung versenden';
                $modal['btn_class'] = 'btn btn-primary';
                $modal['type'] = 'submit';
                $modal['name'] = 'bewerbung_ab_WH';
                $modal['btn_url'] = '#';
                include 'app/view/modals/bewerbung_modal.php';
                break;

                case 'bewerbung_senden':
                $modal['case'] = 'bewerbung_senden';
                $modal['title'] = 'Sicherheitsabfrage: Bewerbung?';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Möchtest du wirklich dich da wirklich bewerben??';
                $modal['btn'] = 'Bewerbung versenden';
                $modal['btn_class'] = 'btn btn-primary';
                $modal['type'] = 'submit';
                $modal['name'] = 'bewerbung_ab_BW';
                $modal['btn_url'] = '#';
                include 'app/view/modals/bewerbung_modal.php';
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

        public function Abschluss_AJ($id,$state,$kat)
        {           
            $modul = $this->modul_model->getModulById($id);
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
                 for($j = 0; $j < count($vorkenntnisse); $j++){ 
                   $vorkenntnisse_msg =  $vorkenntnisse[$j]['bezeichnung'] .'; <br>' ;
              }          
                    include (__DIR__."/../../ajax/vorkenntnisse_BEL/showVorkenntnisse_AB_BEL1.php");                     
            }
            else if($state=='false' && $kat =='BEL2')
            {
                $vorkenntnisse = $this->vorkenntnisse_model->VorkenntnisseByThemaID($id);
                for($j = 0; $j < count($vorkenntnisse); $j++){ 
                    $vorkenntnisse_msg =  $vorkenntnisse[$j]['bezeichnung'] .'; <br>' ;
               } 
                if(empty($vorkenntnisse)){$msg_vork =''; } else{$msg_vork ='Empfohlene Vorkenntnisse: ';}          
                    include (__DIR__."/../../ajax/vorkenntnisse_BEL/showVorkenntnisse_AB_BEL2.php");                     
            }
            else if($state=='false' && $kat =='BEL3')
            {
                $vorkenntnisse = $this->vorkenntnisse_model->VorkenntnisseByThemaID($id);
                for($j = 0; $j < count($vorkenntnisse); $j++){ 
                    $vorkenntnisse_msg =  $vorkenntnisse[$j]['bezeichnung'] .'; <br>' ;
               } 
                if(empty($vorkenntnisse)){$msg_vork =''; } else{$msg_vork ='Empfohlene Vorkenntnisse: ';}           
                    include (__DIR__."/../../ajax/vorkenntnisse_BEL/showVorkenntnisse_AB_BEL3.php");                     
            }
        }

}