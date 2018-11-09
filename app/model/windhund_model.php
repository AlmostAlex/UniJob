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
    }

    public function insertWindhund($vorname, $nachname, $matrikelnummer, $email, $thema_id, $voraussetzungen)
    {
        if ($statement = $this->dbh->prepare("INSERT INTO `windhund` (`vorname`, `nachname`, `matrikelnummer`, `email`, `thema_id`, `status`, `voraussetzungen`)
        VALUES (?,?,?,?,?,'angenommen',?)")) {
            $statement->bind_param('ssisis', $vorname, $nachname, $matrikelnummer, $email, $thema_id, $voraussetzungen);
            $statement->execute();

            $this->thema->updateStatus($thema_id);
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Eintragung der Bewerbung ist fehlgeschlagen.";
        }
    }

    public function bewerbung_count($modul_id)
    {
         $statement = $this->dbh->prepare
         ("SELECT count(windhund_id) as anzahl_bewerber_check
         FROM Windhund, thema, modul 
         WHERE thema.thema_id = windhund.thema_id 
         AND thema.modul_id = modul.modul_id
         AND modul.modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($anzahl_bewerber_check);
        $statement->fetch();
        return $anzahl_bewerber_check;        
    }

    public function info_windhund($modul_id)
    {
         $statement = $this->dbh->prepare
         ("SELECT count(thema.thema_id) as anzThema, 
                    (SELECT count(thema.thema_id) 
                    FROM thema, modul 
                    WHERE thema.modul_id = modul.modul_id 
                    AND modul.modul_id = 24 
                    AND thema.thema_verfuegbarkeit = 'Vergeben')
            as anzThemaVergeben,
         modul.modulbezeichnung, 
         modul.professur,
         modul.kategorie
         FROM modul, thema
         WHERE thema.modul_id = modul.modul_id
         AND modul.modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($anzThema,$anzThemaVergeben,$modulbezeichnung,$professur,$kategorie);
        $statement->fetch();


        $infos = array(
            'anzThema' => $anzThema,
            'anzThemaVergeben' => $anzThemaVergeben,
            'anzThemaVerfuegbar' => $anzThema - $anzThemaVergeben,
            'modulbezeichnung' => $modulbezeichnung,
            'professur' => $professur,
            'kategorie' => $kategorie,            
        );

    return $infos;
    } 

}
