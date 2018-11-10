<?php
class bewerbung_model
{
    //Erstellen einer Variable $dbh und speichern des Datenabnkzugriffs auf dieser
    //damit alle Funktionen Zugriff auf diese über $this->dbh haben
    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;
        $this->thema = new thema_model();
        $this->vorkenntnisse = new vorkenntnisse_model();
        $this->bewerb_vorkennt = new bewerb_vorkennt_model();
        date_default_timezone_set("Europe/Berlin");
        $this->heute_dt = new DateTime(date("Y-m-d"));
    }

    public function insertBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $voraussetzungen, $fachsemester, $studiengang, $credits, $punkte)
    {
        if ($statement = $this->dbh->prepare("INSERT INTO `bewerbung` (`vorname`, `nachname`, `matrikelnummer`, `email`, `thema_id`, `status`, `voraussetzung`, `fachsemester`, `fachsemester_punkte`, `studiengang`, `studiengang_punkte`, `credits`, `credits_punkte`, `gesamt_punkte`)
        VALUES (?,?,?,?,?,'offen',?,?,?,?,?,?,?,?)")) {
            $statement->bind_param('ssisisidsiidd', $vorname, $nachname, $matrikelnummer, $email, $thema_id, $voraussetzungen, $fachsemester, $punkte['fachsemester'], $studiengang, $punkte['studiengang'], $credits, $punkte['credits'], $punkte['gesamt']);
            $statement->execute();
            $last_id = $this->lastBewerbungID();
            $vorkenntnisse_id = $this->vorkenntnisse->vorkenntnisseByThemaID($thema_id);
            $this->bewerb_vorkennt->insertBewerbVorkennt($last_id, $vorkenntnisse_id, $vorkenntnisse);
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Eintragung der Bewerbung ist fehlgeschlagen.";
        }
    }

    public function updateBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $voraussetzungen, $fachsemester, $studiengang, $credits, $punkte)
    {
        $status = "offen";
        if ($statement = $this->dbh->prepare("UPDATE bewerbung, thema SET bewerbung.vorname = ?, bewerbung.nachname = ?, bewerbung.email = ?, bewerbung.thema_id = ?, bewerbung.status = ?, bewerbung.voraussetzung = ?, bewerbung.fachsemester = ?, bewerbung.fachsemester_punkte = ?, bewerbung.studiengang = ?, bewerbung.studiengang_punkte =?, bewerbung.credits = ?, bewerbung.credits_punkte = ?, bewerbung.gesamt_punkte = ? WHERE bewerbung.matrikelnummer = ? AND bewerbung.thema_id = thema.thema_id AND thema.modul_id = (SELECT modul_id FROM thema WHERE thema_id = ?)"))
        {
            $statement->bind_param('sssissidsiiddii', $vorname, $nachname, $email, $thema_id, $status, $voraussetzungen, $fachsemester, $punkte['fachsemester'], $studiengang, $punkte['studiengang'], $credits, $punkte['credits'], $punkte['gesamt'], $matrikelnummer, $thema_id);
            $statement->execute();
            $vorkenntnisse_id = $this->vorkenntnisse->vorkenntnisseByThemaID($thema_id);
            $bewerbung_id = $this->getIdByMatrikelnummer($matrikelnummer, $thema_id);
            $this->bewerb_vorkennt->deleteBewerbVorkennt($bewerbung_id);
            $this->bewerb_vorkennt->insertBewerbVorkennt($bewerbung_id, $vorkenntnisse_id, $vorkenntnisse);
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Update der Bewerbung ist fehlgeschlagen.";
        }
    }

    public function duplicateBewerbungCheck($matrikelnummer, $thema_id)
    {
        echo $matrikelnummer."   ".$thema_id;
        $statement = $this->dbh->prepare("SELECT bewerbung.matrikelnummer, bewerbung.thema_id FROM test.modul, test.thema, test.bewerbung
                                            WHERE bewerbung.matrikelnummer = ?
                                            AND bewerbung.thema_id = thema.thema_id
                                            AND thema.modul_id = modul.modul_id
                                            AND modul.semester = (SELECT modul.semester
                                                                FROM modul, thema
                                                                WHERE thema.modul_id = modul.modul_id
                                                                AND thema.thema_id = ?)
                                            AND modul.modul_id = (SELECT modul_id
                                                                FROM thema
                                                                WHERE thema_id = ?)");
        $statement->bind_param('iii', $matrikelnummer, $thema_id, $thema_id);
        $statement->execute();
        $statement->store_result();
        if($statement->num_rows > 0) {
            $duplicate = "duplikat";
            echo "HAAAAAAAAAAAAALLOOOOOOOO";
        } else { $duplicate = "neu"; echo "NOOOOOOOOOOOPE"; }
        return $duplicate;
    }

    public function lastBewerbungID()
    {
        $statement = $this->dbh->prepare("SELECT max(bewerbung_id) FROM bewerbung");
        $statement->execute();
        $statement->bind_result($last_id);
        $statement->fetch();
        return $last_id;
    }

    public function getIdByMatrikelnummer($matrikelnummer, $thema_id)
    {
        $statement = $this->dbh->prepare("SELECT bewerbung_id FROM bewerbung WHERE matrikelnummer = ? AND thema_id = ?");
        $statement->bind_param('ii', $matrikelnummer, $thema_id);
        $statement->execute();
        $statement->bind_result($bewerbung_id);
        $statement->fetch();
        return $bewerbung_id;
    }
}
