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

    public function Route($action, $id)
    {
        $modul = $this->modul_model->getModulByID($id);

     /*  if ($action == 'modul_eintragen' && $action2 == '' && $action3 =='') {
            $this->modulEintragung();
        */
        //verfahren aus DB holen
        //Wenn verfahren = X dann passende view aufrufen

        if($modul[0]['kategorie'] == 'Seminararbeit' && $modul[0]['nachrueckv_status'] == 'true')
        {
            include 'app/view/bewerbung/windhund_view.php';
        } elseif($modul[0]['kategorie'] == 'Seminararbeit' && $modul[0]['nachrueckv_status'] == ''){

            if ($modul[0]['verfahren'] == 'Windhundverfahren')
            {
                include 'app/view/bewerbung/windhund_view.php';

            } else if ($modul[0]['verfahren'] == 'bewerbung'){
                include 'app/view/bewerbung/bewerbung_view.php';

            } else if ($modul[0]['verfahren'] == 'belegwunsch'){
                include 'app/view/bewerbung/belegwunsch_view.php';

            }
        } else
        {
            include 'app/view/bewerbung/abschluss_view.php';
        }
        /* sollte das Formular bei Abschlussthemen sich auch zu windhund ändern, dann in etwa diese Lösung hier nehmen
        if($modul[0]['kategorie'] == 'Abschlussarbeit' && $modul[0]['nachrueckv_status'] == 'true')
        {
            include 'app/view/bewerbung/windhund_view.php';
        } elseif($modul[0]['kategorie'] == 'Aschlussarbeit' && $modul[0]['nachrueckv_status'] == ''){ */
    }
}