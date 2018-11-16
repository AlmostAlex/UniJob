<?php
include_once "app/model/user_model.php";
include_once "db.php";

class Controller
{
    
    public $model;
    public $benutzername;
    public $passwort;

    public function __construct()
    {
    $this->model = new Model();
    }

    public function login()
    {
        $error['name'] = $error['pass'] = $message['alert'] = $render = '';

        if (isset($_POST['login'])) {
            $this->benutzername = $_POST['benutzername'];
            $this->passwort = $_POST['passwort'];

            if (empty($_POST['benutzername']) || empty($_POST['passwort'])) {
                if ($_POST['benutzername'] == '') {$error['name'] = 'required';}
                if ($_POST['passwort'] == '') {$error['pass'] = 'required';}
                $message['alert'] = '<b>Achtung!</b><br> Alle Felder müssen ausgefüllt werden!';
                $render = 'danger';
            } else {
                $result = $this->model->verifyPassword($this->benutzername, $this->passwort);
                if ($result == true) {
                    $render = 'success';
                    $message['alert'] = '<b>Anmeldung war erfolreich!</b><br>
                                        Die Weiterleitung erfolgt in wenigen Sekunden.<br>
                                        <img src="img/ajax-loader.gif"> ';
                    // session_start();
                    $this->model->setSessionID($this->benutzername);
                   // header("refresh:2;url=index");
                   echo"<meta http-equiv='refresh' content='1, url=/verwaltung'>";
                } else {
                    $render = 'danger';
                    $message['alert'] = '<b>Achtung!</b><br>Das Passwort und der Benutzername stimmen nicht überein.';
                }
            }

        }
        include 'app/view/login/login_view.php';
    }

    public function logout(){
        $login['title'] = $login['logged'] ='';
        if(isset($_SESSION['login'])){
            ob_start (); 
            session_unset (); 
            session_destroy (); 
            ob_end_flush (); 
            
            $login['title'] = 'Ausgeloggt!';
            $login['logged'] = 'Du hast dich erfolgreich ausgeloggt!<br> 
                                Du wirst in wenigen Sekunden zur <b><a href="/index">Hauptseite</a></b> weitergeleitet.';
        }        
        include 'app/view/login/logout_view.php';      
       
        echo"<meta http-equiv='refresh' content='1, url=/index'>";
        
    }
}
