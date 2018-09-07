<?php
require('layout/header.php');
require('vendor/autoload.php');
include("PHPRouter/Router.php");
include("PHPRouter/Response.php");
include("PHPRouter/Request.php");
include("app/controller/login_controller.php");  
include("app/controller/modul_controller.php"); 
include("app/controller/modul_eintragen_controller.php"); 
include("app/controller/modul_uebersicht_controller.php"); 
$router = new Router();
/*  Der Router Code wird in der Index-Datei festgehalten 
    Zu Beginn werden alle Routen für den Public-Bereich festgelegt.
    render --> Wenn es sich um einen public bereich handelt
    render_private --> Wenn eine Anfrage auf einen geschützen Bereich erfolgt.
    Public
        - / , /index --> view/index.php (Informationssseite)
        - /login --> view/
    Admin/Private
        - 
        -
        ...
--> Für jede Unterseite wird ein eigener Controller angelegt

        */

/* PUBLIC */  
$router->map(["GET", "GET"], ["/", "/index"], function (Response $response) {
    $response->render("app/view/info/info_view.php");
});

$router->map(["GET", "POST"], ["/login"], function () {  
    $controller = new Controller();
    $controller->login(); 
  
});

$router->map(["GET"], ["/logout"], function () {  
    $controller = new Controller();
    $controller->logout(); 
});
/* PUBLIC END*/ 

/* ADMIN */
$router->map(["GET", "GET"], ["/verwaltung"], function (Response $response) {
    $response->render("app/view/login/verwaltung_view.php");
});

$router->map(["GET", "POST"],["/ajax/tags.php"], function (Response $response) {

});

$router->map(["GET", "POST"],["/ajax/tags/{term}"], function ($term) {
    $modul = new modul_controller();
    $modul->Ajax($term); 
});



// gilt für mt_verwaltung, modul_eintragen, mt_verwaltung/modul/add(thema hinzufügen)
// für jeden neuen controller neue Route anlegen
// (Modul edit muss noch in den modul_controller)
$router->map(["GET", "POST"],["/{action}","/{action}/{action2}/{action3}/{id}"], function ($action,$action2,$action3,$id) {
    $modul = new modul_controller();
    $modul->Route($action,$action2,$action3,$id); 
});

$router->map(["GET", "POST"],["/modul_eintragen"], function () {
    $modul_add = new modul_eintragen_controller();
    $modul_add->modulEintragung();
});

$router->map(["GET", "POST"],["/modul_uebersicht"], function () {
    $modul_add = new modul_uebersicht_controller();
    $modul_add->Route('modul_uebersicht');
});


/*
// Wenn Modul editiert werden soll
$router->map(["GET", "POST"],["/mt_verwaltung/modul/edit/{id}"], function ($action,$id) {
            $modul_edit = new modul_edit_controller();
            $modul_edit->editModul($id);
});
*/
/* ADMIN ENDE */

//Routing für die Bewerbungen. Also weiterleitung von der Themen Übersicht zu dem passenden
//Formular
$router->map(["GET", "POST"],["/{action}","/{action}/{action2}/{id}"], function ($action,$action2,$id) {
    $modul = new bewerbung_controller();
    $modul->Route($action,$action2,$id); 
});

$router->dispatch();
include('layout/navi.php');
include('layout/footer.php');
?>