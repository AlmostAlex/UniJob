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

    public function deleteBewerbVorkennt($bewerbung_id)
    {
        $statement = $this->dbh->prepare("DELETE FROM bewerb_vorkennt
                                        WHERE bewerbung_id = ?");
        $statement->bind_param('i', $bewerbung_id);
        $statement->execute();
    }
}


/*    public function updateBewerbVorkennt($bewerbung_id, $vorkenntnisse_id, $vorkenntnisse)
    {
        $k = 0;
        while ($k < count($vorkenntnisse)) {
            if($vorkenntnisse[$k] == "Nein"){ $abgeschlossen = "Nein"; }
            else{ $abgeschlossen = "Ja"; }
            $statement = $this->dbh->prepare("UPDATE bewerb_vorkennt SET abgeschlossen = ? 
                                            WHERE bewerbung_id = ? AND vorkenntnisse_id = ?");
            $statement->bind_param('sii', $abgeschlossen, $bewerbung_id, $vorkenntnisse_id[$k]['vorkenntnisse_id']);
            $statement->execute();
            $k = $k+1;
        }
    }
*/
