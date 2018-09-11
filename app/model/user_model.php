<?php
require_once "app/model/user_model.php";

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

    public function logout()
    {
        session_destroy();
        session_start();
    }

}
