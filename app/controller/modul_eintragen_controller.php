<?php
include_once "app/model/modul_model.php";
include_once "app/model/thema_model.php";
include_once "app/model/tags_model.php";
include_once "app/model/user_model.php";
include_once "app/model/vorkenntnisse_model.php";
include_once "db.php";

class modul_eintragen_controller
{
    public $model_add;

    public function __construct()
    {
        $this->modul_model = new modul_model();
        $this->thema_model = new thema_model();
        $this->tags_model = new tags_model();
    }

    public function modulEintragung()
    {
        $kategorie = "Seminararbeit";
        $professurbezeichnung = $modulbezeichnung = $hinweise = $start = $ende = $kickoff = $jahr = $jahr1 = $jahr2 = $semester = '';

        if (isset($_SESSION['login'])) { // erstmal wird die Authentifizierung überprüft
            if (isset($_POST['modul_eintrag1']) || isset($_POST['modul_eintrag2'])) { // WINDHUND UND BEWERBUNG
                if( isset($_post['Abschlusstyp'])){ $abschlusstyp = $_post['Abschlusstyp'];} else { $abschlusstyp = ''; }
                $professurbezeichnung = $_POST["professurbezeichnung"];
                $modulbezeichnung = $_POST["modulbezeichnung"];
                if(isset($_post["hinweise"])){$hinweise = $_POST["hinweise"];}else{$hinweise = "";}
                $start = date("Y-m-d", strtotime($_POST["Start"]));
                $ende = date("Y-m-d", strtotime($_POST["Ende"]));
                if(isset($_post["Kickoff"])){$kickoff = date("Y-m-d", strtotime($_POST["Kickoff"]));}else{$kickoff = "";}
                $semester = $_POST["Semester"];
                $studiengang = $_POST["Studiengang"];
                $verfahren = $_POST["verfahren"];

                if ($semester == 'WiSe') {
                    $jahr1 = $_POST["Semester_input2"];
                    $jahr2 = $_POST["Semester_input3"];
                    $jahr = $jahr1 . '/' . $jahr2;
                } else {
                    $jahr = $_POST["Semester_input1"];
                }

                $semester = $semester . ' ' . $jahr;

// SEMINAR UND ABSCHLUSS BEI WINDHUND UND BEWERBUNGSVERFAHREN
                if ($verfahren == "Windhundverfahren" || $verfahren == "Bewerbungsverfahren") {
                    if (!empty(array_filter($_POST['themenbezeichnungwindhund']))) {
                        $thema = $_POST['themenbezeichnungwindhund'];
                        $tags = $_POST["tags_WiBe"];
                        $vorkenntnisse = $_POST["vorkenntnisse_WiBe"];
                        $betreuer = $_POST["betreuerwindhund"];
                        $eintrag = $this->modul_model->insertSeminar($thema, $modulbezeichnung, $professurbezeichnung, $kategorie, $abschlusstyp, $hinweise, $verfahren, $semester, $start, $ende, $kickoff, $studiengang, $tags, $vorkenntnisse, $betreuer);
                        $this->getModal('upload_seminar_success');
                        
                        //echo "erfolgreich eingetragen";
                    } else {
                        echo "Alles ausfüllen<br>";
                    }
                } else if ($verfahren == "Belegwunschverfahren") {
                    if (!empty(array_filter($_POST['themenbezeichnungbelegwunsch']))) {
                        $thema = $_POST['themenbezeichnungbelegwunsch'];
                        $tags = $_POST["tags_Beleg"];
                        $vorkenntnisse = $_POST["vorkenntnisse_Beleg"];
                        $betreuer = $_POST["betreuerbelegwunsch"];
                        $eintrag = $this->modul_model->insertSeminar($thema, $modulbezeichnung, $professurbezeichnung, $kategorie, $abschlusstyp, $hinweise, $verfahren, $semester, $start, $ende, $kickoff, $studiengang, $tags, $vorkenntnisse, $betreuer);
                        
                        $this->getModal('upload_seminar_success');   
                        //echo "erfolgreich eingetragen";
                    } else {
                        echo "Alles ausfüllen<br>";
                    }
                }
            }
            include 'app/view/modul_eintragen/seminar_view.php';
        } else {
            include 'app/view/login/noAccess_view.php';
        }
    }



    public function getModal($form) // Modal Konfigurationen
    {
        $modal['case'] = $modal['title'] = $modal['body_class'] = $modal['content'] = $modal['img'] = $modal['btn'] = $modal['btn_class'] = $modal['btn_url'] = '';

        switch ($form) {
            case 'upload_seminar_success':
            $modal['case'] = 'automatic';
            $modal['title'] = 'Das Seminar wurde erfolgreich erstellt!';
            $modal['body_class'] = 'alert alert-success';
            $modal['content'] = 'Das Seminar wurde erfolgreich erstellt. <br>
                                Auf der <a href="">Verwaltungsseite</a> können Änderungen vorgenommen werden. <br>';
            $modal['img'] = '/img/checked.png';
            include 'app/view/modul_verwaltung/modals/modal_modul.php';
            break;
        }

    }
}



