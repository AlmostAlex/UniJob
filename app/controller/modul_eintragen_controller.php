<?php
include_once "app/model/modul_model.php";
include_once "app/model/thema_model.php";
include_once "app/model/tags_model.php";
include_once "app/model/user_model.php";
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
        $kategorie = $modulbezeichnung = $start = $ende = $jahr = $jahr1 = $jahr2 = $semester = '';

        if (isset($_SESSION['login'])) { // erstmal wird die Authentifizierung überprüft
            if (isset($_POST['modul_eintrag1']) || isset($_POST['modul_eintrag2'])) { // WINDHUND UND BEWERBUNG
                $kategorie = $_POST["Kategorie"]; // muss noch geändert werden zu $this->kategorie etc.
                $fakultätsbezeichnung = $_POST["fakultätsbezeichnung"];
                $modulbezeichnung = $_POST["modulbezeichnung"];
                $start = date("Y-m-d", strtotime($_POST["Start"]));
                $ende = date("Y-m-d", strtotime($_POST["Ende"]));
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
                if (($kategorie == "Seminararbeit" || $kategorie == "Abschlussarbeit") && ($verfahren == "Windhundverfahren" || $verfahren == "Bewerbungsverfahren")) {
                    if (!empty(array_filter($_POST['themenbezeichnungwindhund']))) {
                        $thema = $_POST['themenbezeichnungwindhund'];
                        $tags = $_POST["tags_WiBe"];
                        $betreuer = $_POST["betreuerwindhund"];
                        $eintrag = $this->modul_model->insertModul($thema, $modulbezeichnung, $kategorie, $verfahren, $semester, $start, $ende, $studiengang, $tags, $betreuer);
                        echo "erfolgreich eingetragen";
                    } else {
                        echo "Alles ausfüllen<br>";
                    }
                } else if (($kategorie == "Seminararbeit" || $kategorie == "Abschlussarbeit") && $verfahren == "Belegwunschverfahren") {
                    if (!empty(array_filter($_POST['themenbezeichnungbelegwunsch']))) {
                        $thema = $_POST['themenbezeichnungbelegwunsch'];
                        $tags = $_POST["tags_Beleg"];
                        $betreuer = $_POST["betreuerbelegwunsch"];
                        $eintrag = $this->modul_model->insertModul($thema, $modulbezeichnung, $kategorie, $verfahren, $semester, $start, $ende, $studiengang, $tags, $betreuer);
                        echo "erfolgreich eingetragen";
                    } else {
                        echo "Alles ausfüllen<br>";
                    }
                }
            }
            include 'app/view/modul_eintragen/modul_view.php';
        } else {
            include 'app/view/login/noAccess_view.php';
        }
    }

}