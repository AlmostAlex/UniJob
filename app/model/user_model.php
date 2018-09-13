<?php

class Model
{

    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;
    }

    public function verifyPassword($benutzername, $passwort)
    {
        $statement = $this->dbh->prepare("SELECT passwort FROM user WHERE benutzername = ?");
        $statement->bind_param('s', $benutzername);
        $statement->execute();
        $statement->bind_result($pw);
        $statement->fetch();
        return (password_verify($passwort, $pw));
    }

    public function setSessionID($benutzername)
    {
        $statement = $this->dbh->prepare("SELECT benutzer_id FROM user WHERE benutzername = ?");
        $statement->bind_param('s', $benutzername);
        $statement->execute();
        $statement->bind_result($benutzer_id);
        $statement->fetch();
        $_SESSION['login'] = $benutzer_id;
        return $_SESSION['login'];
    }
    // !!!!! BEI UNIDB ZUGRIFF NEUSCHREIBEN!!!!!!
    public function getNachnameID($nachname)
    {
        $statement = $this->dbh->prepare("SELECT benutzer_id FROM user WHERE benutzername = ?");
        $statement->bind_param('s', $nachname);
        $statement->execute();
        $statement->bind_result($benutzer_id);
        $statement->fetch();
        return $benutzer_id;
    }

    public function getIDBenutzername($benutzer_id)
    {
        $statement = $this->dbh->prepare("SELECT benutzername FROM user WHERE benutzer_id= ?");
        $statement->bind_param('i', $benutzer_id);
        $statement->execute();
        $statement->bind_result($benutzername);
        $statement->fetch();
        return $benutzername;
    }
    
    public function logout()
    {
        session_destroy();
        session_start();
    }

}
