<?php
class windhund_model
{
    //Erstellen einer Variable $dbh und speichern des Datenabnkzugriffs auf dieser
    //damit alle Funktionen Zugriff auf diese über $this->dbh haben
    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;
        $this->thema = new thema_model();
        date_default_timezone_set("Europe/Berlin");
        $this->heute_dt = new DateTime(date("Y-m-d"));
    }

    public function insertWindhund($vorname, $nachname, $matrikelnummer, $email, $thema_id, $voraussetungen)
    {
        if ($statement = $this->dbh->prepare("INSERT INTO `windhund` (`vorname`, `nachname`, `matrikelnummer`, `email`, `thema_id`, `status`, `timestamp`, `voraussetungen`)
        VALUES (?,?,?,?,?,'angenommen',".$this->heute_dt.",?)")) {
            $statement->bind_param('ssisisss', $vorname, $nachname, $matrikelnummer, $email, $thema_id, $voraussetungen);
            $statement->execute();
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Eintragung der Bewerbung ist fehlgeschlagen.";
        }
    }
}
