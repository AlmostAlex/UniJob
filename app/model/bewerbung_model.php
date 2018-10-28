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
        $this->bewerb_vorkennt = new bewerb_vorkennt_model();
        date_default_timezone_set("Europe/Berlin");
        $this->heute_dt = new DateTime(date("Y-m-d"));
    }

    public function insertBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $voraussetungen)
    {
        if ($statement = $this->dbh->prepare("INSERT INTO `windhund` (`vorname`, `nachname`, `matrikelnummer`, `email`, `thema_id`, `status`, `voraussetungen`)
        VALUES (?,?,?,?,?,'angenommen',?)")) {
            $statement->bind_param('ssisiss', $vorname, $nachname, $matrikelnummer, $email, $thema_id, $voraussetungen);
            $statement->execute();
            $last_id = $this->lastBewerbungID();
            $this->bewerb_vorkennt->insertBewerbVorkennt($last_id, $thema_id, $vorkenntnisse);

        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Eintragung der Bewerbung ist fehlgeschlagen.";
        }
    }

    
    public function updateBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $voraussetungen)
    {
        if ($statement = $this->dbh->prepare("UPDATE bewerbung SET vorname = ?, nachname = ?, email = ?, thema_id = ?, status = ?, voraussetungen = ? WHERE matrikelnummer = ?)
        VALUES (?,?,?,?,'offen',?,?)")) {
            $statement->bind_param('sssissi', $vorname, $nachname, $matrikelnummer, $email, $thema_id, $voraussetungen);
            $statement->execute();

        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Update der Bewerbung ist fehlgeschlagen.";
        }
    }

    public function duplicateBewerbungCheck($matrikelnummer, $thema_id)
    {
        $statement = $this->dbh->prepare("SELECT matrikelnummer FROM modul, thema, bewerbung
                                            WHERE bewerbung.matrikelnummer = ?
                                            AND bewerbung.thema_id = thema.thema_id
                                            AND thema.modul_id = modul.modul_id
                                            AND modul.semester = (SELECT semester 
                                                                FROM modul, thema
                                                                WHERE thema.modul_id = modul.modul_id
                                                                AND thema.thema_id = ?)");
        $statement->bind_param('ii', $matrikelnummer, $thema_id);
        $statement->execute();
        if($statement->num_rows > 0) {
            $duplicate = "duplikat";
        } else { $duplicate = "neu"; }
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
}
