<?php


include_once(__DIR__."/../model/modul_model.php");
include_once(__DIR__."/../model/thema_model.php");
include_once(__DIR__."/../model/tags_model.php");
include_once(__DIR__."/../model/user_model.php");
include_once(__DIR__."/../model/vorkenntnisse_model.php");
include_once(__DIR__."/../../db.php"); 

class modul_controller
{
    public $model;

    public function __construct()
    {
        $this->modul_model = new modul_model();
        $this->thema_model = new thema_model();
        $this->tags_model = new tags_model();
        $this->vorkenntnisse_model = new vorkenntnisse_model();
        date_default_timezone_set("Europe/Berlin");
        $this->heute_dt = new DateTime(date("Y-m-d"));
    }

    public function Route($action, $action2, $action3, $action4, $id)
    {
        if ($action == 'mt_verwaltung' && $action2 == '' && $action3 =='') {
            $this->Modul_Verwaltung('false', 0, 'none');

        } else if ($action == 'mt_verwaltung' && $action2 == 'modul' && $action3 == 'archivierung') {          
           // $this->modul_actions('archivierung', $id);
            $this->modul_model->updateArchivierung($id, 'true');
            $this->getModal('archivierung_success', $id);
            $this->Modul_Verwaltung('false', 0, 'none');

        } else if ($action == 'mt_verwaltung' && $action2 == 'modul' && $action3 == 'nachrueckverfahren') {
            $frist_ende = date("Y-m-d", strtotime(date('Y-m-d') . "+7 day")); 
            $this->modul_model->updateNachrueckverfahren($id,'true',$frist_ende);
            $this->getModal('nachrueckverfahren_success', $id);
            $this->Modul_Verwaltung('false', 0, 'none');

        } else if ($action == 'mt_verwaltung' && $action2 == 'modul' && $action3 == 'delete') {
           // $this->modul_actions($action3,$id);
            $start_dt = $this->modul_model->getModulDateStart($id);
            if (($start_dt < new DateTime(date("Y-m-d")) )) {
                $this->getModal('fail_delete_modul_time', $id);
            } else if (($this->modul_model->getModulAnzahl($id) <= 0)) {
                $this->getModal('fail_delete_modul_count', $id);
            } else {
                $this->tags_model->deleteTags($id);
                $this->modul_model->deleteModul($id);
                $this->thema_model->deleteAllThema($id);
                $this->getModal('delete_modul_success', $id);
            }
                $this->Modul_Verwaltung('false',$id);

        } else if ($action == 'mt_verwaltung' && $action2 == 'modul' && $action3 == 'add_thema') { 
            $this->addThema($id);  
        }else if ($action == 'mt_verwaltung' && $action2 == 'modul' && $action3 == 'edit' && ($action4 == 'Seminararbeit' || $action4 == 'Abschlussarbeit')) { 
            $this->editMod($id);
        }else if ($action == 'mt_verwaltung' && $action2 == 'thema' && $action3 == 'edit' && $action4 == '') { 
            $this->editThema($id);
        }
    }
    public function info()
    {
        include("app/view/info/info_view.php");
    }
    public function modul_verwaltung($state, $modul_id)
    {
        switch ($state) {
            case 'false':
                $module = $this->modul_model->getModule('', '');
                include 'app/view/modul_verwaltung/modul_verwaltung_view.php';
                break;
            // Wenn die Themen in Abh. mehrerer Module geholt werden sollen (dh es werden erst die Modul IDs generiert, dann muss der Controller)
            // mit den generierten IDs die Themen holen. Daher --> True.
            // Anders ist es jedoch, wenn man bereits eine Modul_id (wie bei Edit)
            case 'true':
                return $this->thema_model->getThemen($modul_id, '');
                break;
        }
    }
    public function addThema($id){

        if(isset($_POST['add_thema'])){
            $thema = $_POST['themenbezeichnung'];
            $beschreibung = $_POST['themenbeschreibung'];
            $tags = $_POST["tags"];
            //$vorkenntnisse = $_POST["vorkenntnisse"];
             $vorkenntnisse = $_POST["vorkenntnisse"]; 


                if (!empty(array_filter($_POST['themenbezeichnung']))) {
                    $j = 0;
                    $i =0;
                    
                    if( (count($thema)-1) > 1){
                        $action ='add_thema_success_true';
                    }
                    else{
                        $action ='add_thema_success_false'; 
                    }

                    while ($j < count($thema)) {
                            
                        $tag_string = $tags[$j];
                        $vorkenntnisse_string = $vorkenntnisse[$j];

                        if (!empty($thema[$j])) {
                            if (!empty($beschreibung[$j])) {
                                $beschreibung_array = $beschreibung[$j];
                                $thema_array = $thema[$j];                                

                                if ($tag_string == '') {
                                    if($vorkenntnisse_string ==''){
                                    $this->thema_model->insertThema($id, $thema_array, $beschreibung_array, $_SESSION['login']);
                                    $this->getModal($action, $id);
                                    } else{
                                        //$eintrag = $this->vorkenntnisse_model->getVorkenntnisseString($vorkenntnisse_string);
                                        $this->thema_model->insertThema($id, $thema_array, $beschreibung_array, $_SESSION['login']);
                                        $thema_id = $this->thema_model->lastThemaID();
                                        $this->vorkenntnisse_model->insertVorkenntnisse($vorkenntnisse_string, $thema_id);
                                        $this->getModal($action, $id);
                                        // INSERT THEMA AND INSERT VORKENNTNISSE
                                    }
                                } else { // wenn tag != '', vork =''
                                    if($vorkenntnisse_string ==''){
                                        $eintrag = $this->tags_model->getTagString($tag_string);
                                        $this->thema_model->insertThema($id, $thema_array, $beschreibung_array, $_SESSION['login']);
                                        $thema_id = $this->thema_model->lastThemaID();
                                        $this->tags_model->insertTags($tag_string, $thema_id);
                                        $this->getModal($action, $id);
                                    } else{                                        
                                        $eintrag = $this->tags_model->getTagString($tag_string);
                                        $this->thema_model->insertThema($id, $thema_array, $beschreibung_array, $_SESSION['login']);
                                        $thema_id = $this->thema_model->lastThemaID();
                                        $this->tags_model->insertTags($tag_string, $thema_id);
                                        $this->vorkenntnisse_model->insertVorkenntnisse($vorkenntnisse_string, $thema_id);
                                        $this->getModal($action, $id);   
                                    }
                                }
                            }
                            
                            else{ // beschreibung ist leer
                                if ($tag_string == '') { //wenn besch = '', vork ='', tags =''
                                    if($vorkenntnisse_string ==''){
                                        $thema_array = $thema[$j];
                                        $beschreibung_array = '';
                                        $this->thema_model->insertThema($id, $thema_array, $beschreibung_array,$_SESSION['login']);
                                        $this->getModal($action, $id);
                                    } else { //wenn besch = '', tags =''
                                        $thema_array = $thema[$j];
                                        $beschreibung_array = '';
                                        $this->thema_model->insertThema($id, $thema_array, $beschreibung_array, $_SESSION['login']);
                                        $thema_id = $this->thema_model->lastThemaID();
                                        $this->vorkenntnisse_model->insertVorkenntnisse($vorkenntnisse_string, $thema_id);
                                    }
                                } else { // wenn besch = '', vork =''
                                    if($vorkenntnisse_string ==''){
                                        $thema_array = $thema[$j];
                                        $beschreibung_array = '';
                                        $this->thema_model->insertThema($id, $thema_array, $beschreibung_array, $_SESSION['login']);
                                        $thema_id = $this->thema_model->lastThemaID();
                                        $this->tags_model->insertTags($tag_string, $thema_id);
                                        $this->getModal($action, $id);
                                    } else{ // wenn besch ='', 
                                        $thema_array = $thema[$j];
                                        $beschreibung_array = '';
                                        $this->thema_model->insertThema($id, $thema_array, $beschreibung_array, $_SESSION['login']);
                                        $thema_id = $this->thema_model->lastThemaID();
                                        $this->vorkenntnisse_model->insertVorkenntnisse($vorkenntnisse_string, $thema_id);
                                        $this->tags_model->insertTags($tag_string, $thema_id);
                                        $this->getModal($action, $id);
                                    }

                                }
                            }
                       }
                     
                    $j = $j + 1;
                }
              
            }
            else{
                echo "alles ausfüllen";
            }
        }
        $modulbezeichnung = $this->modul_model->getModulbezeichnung($id);
        $kategorie = $this->modul_model->getModulKategorie($id);
        include 'app/view/modul_verwaltung/add_thema.php';
    }


    public function editMod($modul_id)
    {
        $check['Abschlussarbeit'] = $check['verfahren_select'] = $check['verfahren_option'] = $check['Seminararbeit'] = $check['fristen'] = '';
        $modul = $this->modul_model->getModulById($modul_id);
        $start_dt = new DateTime($modul["frist_start"]);
        $start_anzeige = date("d-m-Y", strtotime($modul['frist_start']));
        $ende_anzeige = date("d-m-Y", strtotime($modul['frist_ende']));
        $kickoff_anzeige = date("d-m-Y", strtotime($modul['kickoff']));

        if($modul['kategorie'] == "Abschlussarbeit"){ 
            $displayBez = 'display:none'; $reqBez = "";
            $bezeichnung = $modul['professur'];
        } else {$displayBez = ''; $reqBez = "required";
            $bezeichnung = $modul['modulbezeichnung'];
        } 

        $semesterString = explode(" ", $modul["semester"]);
        $semester = $semesterString[0];

        if($semester == "WiSe")
        {
            $semesterjahr = explode("/", $semesterString[1]);
           // $semesterjahr[0] .'--'. $semesterjahr[1];

        } else {
            $semester_s = $semesterString[1];
            $semesterString = $semester[0];
        }

        if ($start_dt <= $this->heute_dt) {
            $check['fristen'] = 'disabled';
            $check['verfahren_select'] = 'readonly';
            $check['verfahren_select'] = 'disabled';
        } else {
            $check['fristen'] = $check['verfahren_select'] = $check['verfahren_select'] = '';
        }

        if (isset($_POST['modul_edit'])) {
            $start_anzeige = date("d-m-Y", strtotime($_POST['Start']));
            $ende_anzeige = date("d-m-Y", strtotime($_POST['Ende']));
            $kickoff_anzeige = date("d-m-Y", strtotime($_POST['Kickoff']));
            if(isset($_POST['modulbezeichnung'])) {$modulbezeichnung = $_POST['modulbezeichnung'];} else{ $modulbezeichnung ='';}

            $start = date("Y-m-d", strtotime($_POST['Start']));
            $ende = date("Y-m-d", strtotime($_POST['Ende']));
            $kickoff = date("Y-m-d", strtotime($_POST['Kickoff']));

            $semester = $_POST['SemesterEdit'];
            
            if($semester =='SoSe') {
                $semester_post = $semester .' '. $_POST['Semester_input1'];  
                $semester_s = $_POST['Semester_input1'];    
            } else if($semester == 'WiSe' ){
                $semester_post = $semester .' '. $_POST['Semester_input2'] .'/'. $_POST['Semester_input3'];  
                $semesterjahr[0] = $_POST['Semester_input2'];
                $semesterjahr[1]= $_POST['Semester_input3'];
            }

            if ($check['verfahren_select'] == 'disabled') {
                $verfahren = $modul['verfahren'];
            } else {
                $verfahren = $_POST['Verfahren'];
            }
            
            $this->modul_model->updateModul( $_POST['professur'], $modulbezeichnung, $start, $ende, $kickoff, $semester_post, $_POST['hinweise'], $_POST['Studiengang'], $verfahren, $modul_id);
            $modul['modulbezeichnung'] = $_POST['modulbezeichnung'];
            $modul['professur'] = $_POST['professur'];
            $modul['frist_start'] = $start;
            $modul['frist_ende'] = $ende;
            $modul['kickoff'] = $kickoff;
            //$modul['semester'] = $_POST['Semester'];
            $modul['studiengang'] = $_POST['Studiengang'];
            $modul['hinweise'] =  $_POST['hinweise'];
            $modul['verfahren'] = $verfahren;
            $this->getModal('edit_modul_success', $modul_id);
        }

        $themen = $this->thema_model->getThemen($modul_id, '');
        include 'app/view/modul_verwaltung/edit_modul_view.php';
}

public function editThema($thema_id)
    {



     /*   $check['Abschlussarbeit'] = $check['verfahren_select'] = $check['verfahren_option'] = $check['Seminararbeit'] = $check['fristen'] = '';
        $thema = $this->thema_model->getThema($thema_id);
        $start_dt = new DateTime($modul["frist_start"]);

        $start_anzeige = date("d-m-Y", strtotime($modul['frist_start']));
        $ende_anzeige = date("d-m-Y", strtotime($modul['frist_ende']));

        $semester = explode(" ", $modul["semester"]);
        if($semester[0] == "WiSe")
        {
            $semesterjahr = explode("/", $semester[1]);
        }
        if ($start_dt <= $this->heute_dt) {
            $check['fristen'] = 'readonly';
            $check['verfahren_select'] = 'readonly';
            $check['verfahren_select'] = 'disabled';
        } else {
            $check['fristen'] = $check['verfahren_select'] = $check['verfahren_select'] = '';
        }

        if (isset($_POST['modul_edit'])) {
            $start_anzeige = date("d-m-Y", strtotime($_POST['Start']));
            $ende_anzeige = date("d-m-Y", strtotime($_POST['Ende']));
            $start = date("Y-m-d", strtotime($_POST['Start']));
            $ende = date("Y-m-d", strtotime($_POST['Ende']));
        
            if ($check['verfahren_select'] == 'disabled') {
                $verfahren = $modul['verfahren'];
            } else {
                $verfahren = $_POST['Verfahren'];
            }
            $this->modul_model->updateModul($_POST['Bezeichnung'], $_POST['fakultaet'], $start, $ende, $_POST['Semester'], $_POST['Studiengang'], $verfahren, $modul_id);
            $modul['professur'] = $_POST['Bezeichnung'];
            $modul['fakultaet'] = $_POST['fakultaet'];
            $modul['frist_start'] = $start;
            $modul['frist_ende'] = $ende;
            $modul['semester'] = $_POST['Semester'];
            $modul['studiengang'] = $_POST['Studiengang'];
            $modul['verfahren'] = $verfahren;
            $this->getModal('edit_modul_success', $modul_id); 
        
        $themen = $this->thema_model->getThemen($modul_id, '');}
        include 'app/view/modul_verwaltung/edit_abschluss_view.php';*/
}
// Archivierung

public function ArchivierungThemen($modul_id,$abfrage_th){
    return $this->thema_model->getThemen($modul_id,$abfrage_th);
}

public function archivierung($semester_f,$status) // Modal Konfigurationen
{

    if($status=='filter'){
       $module = $this->modul_model->getArchivierteModule($semester_f,$status);
        include_once(__DIR__."/../view/archivierung/showArchivierung_view.php"); 
    }

    if($status=='main'){    
        $semester_d = $this->modul_model->getSemester();
        $c_all = $this->modul_model->getSemesterCountAll();

        include_once(__DIR__."/../view/archivierung/archivierung_view.php");

        
    }

}
// gehört in den Model 
    public function getModal($form, $id) // Modal Konfigurationen
    {
        $modal['case'] = $modal['title'] = $modal['body_class'] = $modal['content'] = $modal['img'] = $modal['btn'] = $modal['btn_class'] = $modal['btn_url'] = '';

        switch ($form) {
            case 'delete_modul':
                $modal['case'] = 'Sicherheitsabfrage_' . $id;
                $modal['title'] = 'Sicherheitsabfrage: Modul löschen?';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Wollen sie das Modul <b>"' . $this->modul_model->getModulbezeichnung($id) . '"</b> mit den dazugehörigen Themen und Daten wirklich löschen?';
                $modal['btn'] = '<i class="far fa-trash-alt"></i> Modul löschen';
                $modal['btn_class'] = 'btn btn-danger';
                $modal['btn_url'] = '/mt_verwaltung/modul/delete/' . $id;
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

            case 'fail_delete_modul_time':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Fehler aufgetreten!';
                $modal['body_class'] = 'alert alert-danger';
                $modal['content'] = '<b>Achtung!</b><br> Der <b>Anmeldezeitraum</b> ist bereits eingetroffen. <br>Das Modul konnte nicht gelöscht werden.';
                $modal['img'] = '/img/ups.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

            case 'fail_delete_modul_count':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Fehler aufgetreten!';
                $modal['body_class'] = 'alert alert-danger';
                $modal['content'] = '<b>Achtung!</b><br> Das Modul konnte nicht gelöscht werden.<br>Das Modul exisitiert nicht oder wurde bereits gelöscht.<br>';
                $modal['img'] = '/img/ups.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

            case 'delete_modul_success':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Das Modul wurde gelöscht!';
                $modal['body_class'] = 'alert alert-success';
                $modal['content'] = 'Das <b>Modul</b> und die dazugehörigen Themen und Daten wurden <b>erfolgreich</b> gelöscht.<br><br>';
                $modal['img'] = '/img/checked.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

            case 'edit_modul_success':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Das Modul wurde bearbeitet!';
                $modal['body_class'] = 'alert alert-success';
                $modal['content'] = '<b>Das Modul wurde erfolgreich bearbeitet.</b><br> Gehe zur <a style="color: green;" href="mt_verwaltung.php">Verwaltungsseite für Module und Themen</a><br><br>';
                $modal['img'] = '/img/checked.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

            case 'add_thema':
                $modulbezeichnung = $this->modul_model->getModulbezeichnung($id);
                include 'app/view/modul_verwaltung/modals/modal_add_thema.php';
                break;

            case 'archivierung':
                $modal['case'] = 'Abfrage_' . $id;
                $modal['title'] = 'Sicherheitsabfrage: Modul archvieren?';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Wollen sie das Modul "<b>' . $this->modul_model->getModulbezeichnung($id) . '</b>" mit den dazgehörigen Daten sicher archivieren?';
                $modal['btn'] = 'Modul archivieren';
                $modal['btn_class'] = 'btn btn-primary';
                $modal['btn_url'] = '/mt_verwaltung/modul/archivierung/' . $id;
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

            case 'archivierung_success':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Das Modul wurde erfolgreich archiviert!';
                $modal['body_class'] = 'alert alert-success';
                $modal['content'] = 'Das <b>Modul</b> und die dazugehörigen Themen und Daten wurden <b>erfolgreich</b> archiviert.<br><br>';
                $modal['img'] = '/img/checked.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

            case 'nachrueckverfahren':
                $modal['case'] = 'nachrueckverfahren_' . $id;
                $modal['title'] = 'Sicherheitsabfrage: Nachrückverfahren einleiten?';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Durch das Ausführen des Nachrückverfahrens wird die Endfrist des Moduls um 7 Tage, vom aktuellen Datum an, verlängert.<br>
                                     Der neue Endzeitpunkt wird somit von <b>' . date("d.m.Y") . '</b> auf <b>' . date("d.m.Y", strtotime(date("d.m.Y") . "+7 day")) . '</b> verlängert.';
                $modal['btn'] = 'Nachrückverfahren einleiten';
                $modal['btn_class'] = 'btn btn-primary';
                $modal['btn_url'] = '/mt_verwaltung/modul/nachrueckverfahren/' . $id;
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

                case 'nachrueckverfahren_success':
                $modal['case'] = 'automatic';
                $modal['title'] = 'Nackrückverfahren erfolgreich eingeleitet!';
                $modal['body_class'] = 'alert alert-success';
                $modal['content'] = 'Das Nachrückverfahren wurde erfolgreich eingeleitet!<br>Die Endfrist wurde von <b>'.$this->modul_model->getFristEnde($id).'</b> auf <b>'. date("d.m.Y", strtotime(date("d.m.Y") . "+7 day")).'</b> geändert.<br>';
                $modal['img'] = '/img/checked.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;

                case 'add_thema_success_false':
                case 'add_thema_success_true':
                    $modal['case'] = 'automatic'; 
                    $modal['body_class'] = 'alert alert-success';
                    if($form == 'add_thema_success_false'){
                        $modal['title'] = 'Das Thema wurde erfolgreich hinzugefügt!';
                        $modal['content'] = '<b>Das Thema wurde erfolgreich zum Modul "'. $this->modul_model->getModulbezeichnung($id) . '" hinzugefügt.</b> <br><br>';
                    } else {
                        $modal['title'] = 'Die Themen wurden erfolgreich hinzugefügt!';
                        $modal['content'] = '<b>Die Themen wurden erfolgreich zum Modul "'. $this->modul_model->getModulbezeichnung($id) . '" hinzugefügt.</b> <br><br>';
                    }
                    $modal['img'] = '/img/checked.png';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
                break;
        }
    }
    public function ajax($term) // Modal Konfigurationen
    {
        $tags = $this->tags_model->searchTag($term);
        
    }
        

}
