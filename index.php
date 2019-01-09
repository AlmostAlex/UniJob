<?php
ob_start();
session_start();
ob_get_clean();

include_once('layout/header.php');
require('vendor/autoload.php');
include("PHPRouter/Router.php");
include("PHPRouter/Response.php");
include("PHPRouter/Request.php");
include(__DIR__."/app/controller/modul_uebersicht_controller.php"); 
include(__DIR__."/app/controller/login_controller.php");  
include(__DIR__."/app/controller/modul_controller.php"); 
include(__DIR__."/app/controller/bewerbung_controller.php"); 
include(__DIR__."/app/controller/modul_eintragen_controller.php");
include(__DIR__."/app/controller/abschluss_eintragen_controller.php"); 
include(__DIR__."/app/controller/einsicht_controller.php"); 

$router = new Router();
/* PUBLIC */  
$router->map(["GET", "POST"], ["/", "/index"], function () {  
    $modul = new modul_controller();
    $modul->info(); 
});

$router->map(["GET", "POST"], ["/login"], function () {  
    $controller = new Controller();
    $controller->login(); 
});

$router->map(["GET"], ["/logout"], function () {  
    $controller = new Controller();
    $controller->logout(); 
});

$router->map(["GET", "POST"],["/modul_uebersicht"], function () { 
    $modul_uebersicht = new modul_uebersicht_controller();
    $modul_uebersicht->modulUebersicht('','','','','true');
});

$router->map(["GET", "POST"],["/bewerbung/{action}/{id}"], function ($action,$id) {
    $bewerbung = new bewerbung_controller();
    $bewerbung->Route($action,$id,'true','show'); 
});

$router->map(["GET", "POST"], ["/export/download.php"], function (Response $response) {
    $response->render("app/view/export/download.php");
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

$router->map(["GET", "POST"],["/seminar_eintragen"], function () {
    $modul_add1 = new modul_eintragen_controller();
    $modul_add1->modulEintragung();
});

$router->map(["GET", "POST"],["/abschlussarbeit_eintragen"], function () {
    $modul_add2 = new abschluss_eintragen_controller();
    $modul_add2->modulEintragung();
});

// gilt für mt_verwaltung, modul_eintragen, mt_verwaltung/modul/add(thema hinzufügen)
// für jeden neuen controller neue Route anlegen
// (Modul edit muss noch in den modul_controller)
$router->map(["GET", "POST"],["/mt_verwaltung","/mt_verwaltung/{action2}/{action3}/{action4}/{id}"], function ($action,$action2,$action3,$action4,$id) {
    $modul = new modul_controller();
    $modul->Route('mt_verwaltung',$action2,$action3,$action4,$id); 
});

$router->map(["GET", "POST"],["/mt_verwaltung","/mt_verwaltung/{action2}/{action3}/{id}"], function ($action,$action2,$action3,$id) {
    $modul = new modul_controller();
    $modul->Route('mt_verwaltung',$action2,$action3,'',$id); 
});

$router->map(["GET", "POST"],["/archivierung"], function () {
    $modul = new modul_controller();
    $modul->archivierung('','main'); 
});

$router->map(["GET", "POST"],["/einsicht/{action}/{id}"], function ($action,$id) {
    $modul = new einsicht_controller();
    $modul->Einsicht('einsicht',$action,"none",$id); 
});
$router->map(["GET", "POST"],["/einsicht/{action1}/modul/{id}"], function ($action1,$id) {
    $modul = new einsicht_controller();
    $modul->Einsicht('einsicht',$action1,'modul',$id); 
});

$router->map(["GET", "GET"], ["/fazit_abschluss.php"], function (Response $response) {
    $response->render("app/view/bewerbung/Abschlussarbeit/fazit_abschluss.php");
});
/* Ajax */
$router->map(["GET", "GET"], ["app/controller/ajax_controller.php"], function (Response $response) {
});

$router->dispatch();
include_once('layout/navi.php');
include_once('layout/footer.php');
?>