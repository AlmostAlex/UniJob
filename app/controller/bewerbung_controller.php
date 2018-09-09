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
        $thema = $this->thema_model->getThemen($id);

        if($modul[0]['kategorie'] == 'Seminararbeit' && $modul[0]['nachrueckv_status'] == 'true')
        {
            if (isset($_POST['bewerbung_windhund'])) 
            {
            $vorname = $_POST["Vorname"];
            $nachname = $_POST["Nachname"];
            $matrikelnummer = $_POST["Matrikelnummer"];
            $email = $_POST["Email"];
            $thema_id = $_POST["Thema"];
            $this->Windhundbewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $modul_id);
            }
            include 'app/view/bewerbung/windhund_view.php';

        } elseif($modul[0]['kategorie'] == 'Seminararbeit' && $modul[0]['nachrueckv_status'] == ''){

            if ($modul[0]['verfahren'] == 'Windhundverfahren')
            {
                if (isset($_POST['bewerbung_windhund'])) 
                {
                $vorname = $_POST["Vorname"];
                $nachname = $_POST["Nachname"];
                $matrikelnummer = $_POST["Matrikelnummer"];
                $email = $_POST["Email"];
                $thema_id = $_POST["Thema"];
                $this->Windhundbewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $modul_id);
                }
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

    public function Windhundbewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $modul_id) 
    {
        //Hier wird geprüft, ob der Student sich bereits auf ein Thema in dem Modul beworben hat oder schon genommen wurde
        $prüfung = $this->windhund->duplikatPrüfung($modul_id);
        $prüfung->bind_result($matrikelDB, $status);
        $prüfung->store_result();
        $vorhanden = 0;
        while ($prüfung->fetch()) 
        {
            if (($matrikelnummer == $matrikelDB) && ($status != "abgelehnt")) 
            {
                $vorhanden += 1;
            }
        }

        //Wenn er sich noch nicht beworben hat, dann werden seine Infromationen dem Thema zugeordnet
        //Und das Thema wird auf vergeben gestellt
        if ($vorhanden == 0) 
        {
            $this->windhund->insertWindhund($vorname, $nachname, $matrikelnummer, $email, $thema_id, "offen");            
            $this->thema->updateVerfuegbarkeit($thema_id, "Vergeben");
            $thema = $this->thema_model->getThema($thema_id);
                     
            while ($statement->fetch()) 
            { 
                //Modal zur erfolgreichen Eintragung anzeigen
                $modal['case'] = 'Sicherheitsabfrage_';
                $modal['title'] = 'Eintragung erfolgreich!';
                $modal['body_class'] = 'well';
                $modal['content'] = 'Sie haben sich erfolgreich für das Thema <b>"' . $thema[0]['themenbezeichnung'] . '"</b> eingetragen!';
                $modal['btn'] = '<i class="far fa-trash-alt"></i> Fertig';
                $modal['btn_class'] = 'btn btn-success';
                $modal['btn_url'] = '/modul_uebersicht/modul_uebersicht_view.php/';
                include 'app/view/modul_verwaltung/modals/modal_modul.php';
            }           
        }
        
        







        
        //Wenn bereits in ein Thema im selben Modul eingetragen, adnn Modal zur Fehlgeschlagenen Eintragung
        else 
        {
            echo"<script>
            $(window).load(function()
            {
                $('#myModal2').modal('show');
            });
            </script>";
            ?>
            <!-- Modal -->
            <div id="myModal2" class="modal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eintragung ist Fehlgeschlagen!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Sie haben sich bereits auf ein Thema in diesem Modul beworben/eingetragen!.</p>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-danger" href="Themen_uebersicht_student.php">Fertig</a> 
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}