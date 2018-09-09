<?php
include_once "app/model/modul_model.php";
include_once "app/model/thema_model.php";
include_once "db.php";

class bewerbung_controller
{
    public $model;

    public function __construct()
    {
        $this->modul_model = new modul_model();
        $this->thema_model = new thema_model();
        date_default_timezone_set("Europe/Berlin");
        $this->heute_dt = new DateTime(date("Y-m-d"));
    }

    public function Route($action, $action2, $id)
    {

     /*  if ($action == 'modul_eintragen' && $action2 == '' && $action3 =='') {
            $this->modulEintragung();
        */
        //verfahren aus DB holen
        //Wenn verfahren = X dann passende view aufrufen
        if ($action == 'windhund') {
            $this->Windhundformular($id);

        } else if ($action2 == 'bewerbung') {  
            //Nachrück? Wenn ja, dann /windhund_view        
            $this->Bewerbungsformular($id);

        } else if ($action2 == 'belegwunsch' ) {
            $this->Belegwunschformular($id);

        } else if ($action2 == 'abschluss') {
            $this->Abschlussformular($id);

        }
    }
}