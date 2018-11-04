<?php
class bewerb_vorkennt_model
{
    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;
        $this->vorkenntnisse = new vorkenntnisse_model();    
    }

    public function insertBewerbVorkennt($bewerbung_id, $vorkenntnisse_id, $vorkenntnisse)
    {
        $k = 0;
        while ($k < count($vorkenntnisse)) {
            if($vorkenntnisse[$k] == "Nein"){ $abgeschlossen = "Nein"; }
            else{ $abgeschlossen = "Ja"; }
            $statement = $this->dbh->prepare("INSERT INTO `bewerb_vorkennt` (`bewerbung_id`,`vorkenntnisse_id`,`abgeschlossen`)
                                                VALUES (?,?,?)");
            $statement->bind_param('iis', $bewerbung_id, $vorkenntnisse_id[$k]['vorkenntnisse_id'], $abgeschlossen);
            $statement->execute();
            $k = $k + 1;
        }
    }

    public function updateBewerbVorkennt($bewerbung_id, $vorkenntnisse_id, $vorkenntnisse)
    {
        $vorkenntnisse_array = explode(",", $vorkenntnisse); // heraus kommt [0] --> blubb [1] --> bla etc
        $k = 0;
        while ($k < count($vorkenntnisse_array)) {
            $statement = $this->dbh->prepare("UPDATE bewerb_vorkennt SET bewerbung_id = ?, vorkenntnisse_id = ?, abgeschlossen = ? 
                                            WHERE bewerbung_id = ? AND vorkenntnisse_id = ?)
                                            VALUES (?,?,?)");
            $statement->bind_param('iis', $bewerbung_id, $vorkenntnisse_id['vorkenntnisse_id'][$k], $vorkenntnisse_array[$k]);
            $statement->execute();
            $k = $k+1;
        }
    }

    public function deleteVorkenntnisse($modul_id)
    {
         $statement = $this->dbh->prepare("DELETE vorkenntnisse FROM bezeichnung,thema,modul 
         WHERE vorkenntnisse.thema_id = thema.thema_id 
         AND thema.modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
    }
}
