<?php
class vorkenntnisse_model
{
    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;    
    }

    public function insertVorkenntnisse($vorkenntnisse, $thema_id)
    {
        $vorkenntnisse_array = explode(",", $vorkenntnisse); // heraus kommt [0] --> blubb [1] --> bla etc
        $k = 0;
        while ($k < count($vorkenntnisse_array)) {
            $statement = $this->dbh->prepare("INSERT INTO `vorkenntnisse` (`bezeichnung`,`thema_id`)
        VALUES (?,?)");
            $statement->bind_param('si', $vorkenntnisse_array[$k], $thema_id);
            $statement->execute();
            $k = $k + 1;
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

    
    public function VorkenntnisseByThemaID($thema_id)
    {
        $statement = $this->dbh->prepare("SELECT bezeichnung FROM vorkenntnisse WHERE thema_id =?");
        $statement->bind_param('i', $thema_id);
        $statement->bind_result($bezeichnung);
        $statement->execute();

        $vorkenntnisse = array();
        while ($statement->fetch()) {
            $row = array(
                'bezeichnung' => $bezeichnung
            );
            $vorkenntnisse[] = $row;
        }
        return $vorkenntnisse;
    
    }
}
