<?php
include_once "app/model/modul_model.php";
include_once "app/model/thema_model.php";
include_once "app/model/tags_model.php";
include_once "app/model/user_model.php";
include_once "app/model/vorkenntnisse_model.php";
include_once "db.php";

class abschluss_eintragen_controller
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
        $kategorie = "Abschlussarbeit";
        $professurbezeichnung = $abschlusstyp = $hinweise = $start = $ende = $kickoff = $jahr = $jahr1 = $jahr2 = $semester = '';

        if (isset($_SESSION['login'])) { // erstmal wird die Authentifizierung überprüft
            if (isset($_POST['modul_eintrag1']) || isset($_POST['modul_eintrag2'])) { // WINDHUND UND BEWERBUNG // muss noch geändert werden zu $this->kategorie etc.
                $abschlusstyp = $_POST["Abschlusstyp"];
                $professurbezeichnung = $_POST["professurbezeichnung"];
                $hinweise = $_POST["hinweise"];
                $start = date("Y-m-d", strtotime($_POST["Start"]));
                $ende = date("Y-m-d", strtotime($_POST["Ende"]));
                $kickoff = date("Y-m-d", strtotime($_POST["Kickoff"]));
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

//ABSCHLUSS BEI WINDHUND UND BEWERBUNGSVERFAHREN
                if ($verfahren == "Windhundverfahren" || $verfahren == "Bewerbungsverfahren") {
                    if (!empty(array_filter($_POST['themenbezeichnungwindhund']))) {
                        $thema = $_POST['themenbezeichnungwindhund'];
                        $tags = $_POST["tags_WiBe"];
                        $vorkenntnisse = $_POST["vorkenntnisse_WiBe"];
                        $betreuer = $_POST["betreuerwindhund"];
                        $eintrag = $this->modul_model->insertAbschluss($thema, $professurbezeichnung, $kategorie, $abschlusstyp, $hinweise, $verfahren, $semester, $start, $ende, $kickoff, $studiengang, $tags, $vorkenntnisse, $betreuer);
                        
                        $this->getModal('upload_abschluss_success', $professurbezeichnung);   
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
                        $eintrag = $this->modul_model->insertAbschluss($thema, $professurbezeichnung, $kategorie, $abschlusstyp, $hinweise, $verfahren, $semester, $start, $ende, $kickoff, $studiengang, $tags,$vorkenntnisse, $betreuer);
                        echo "erfolgreich eingetragen";
                    } else {
                        $this->getModal('upload_abschluss_success', $professurbezeichnung);   
                        //echo "Alles ausfüllen<br>";
                    }
                }
            }
            include 'app/view/modul_eintragen/abschluss_view.php';
        } else {
            include 'app/view/login/noAccess_view.php';
        }
    }

    public function getModal($form, $professurbezeichnung) // Modal Konfigurationen
    {
        $modal['case'] = $modal['title'] = $modal['body_class'] = $modal['content'] = $modal['img'] = $modal['btn'] = $modal['btn_class'] = $modal['btn_url'] = '';

        switch ($form) {
            case 'upload_abschluss_success':
            $modal['case'] = 'automatic';
            $modal['title'] = ' Abschlussarbeiten wurden erfolgreich erstellt!';
            $modal['body_class'] = 'alert alert-success';
            $modal['content'] = 'Zur Professur "<b>'.$professurbezeichnung.'</b>" wurden Abschlussarbeiten erfolgreich erstellt. <br>
                                Auf der <a href="">Verwaltungsseite</a> können Änderungen vorgenommen werden. <br>';
            $modal['img'] = '/img/checked.png';
            include 'app/view/modul_verwaltung/modals/modal_modul.php';
            break;
        }

    }


}