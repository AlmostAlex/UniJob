<?php session_start();?>
<html>
    <head>
        <title>Georg-August-Universität Göttingen</title>         
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include("head.php"); ?>
</head>
    <body>            
        <!-- Header-Bereich -->      
        <header>
            <div class="wrapper">
                <div class="header">
                    <div class="container">
                        <a href="https://www.uni-goettingen.de">
                            <img id="logo" src="img/GAU_Logo.png" alt="Georg-August-Universit Göttingen">
                        </a>
                        <div class="headerunter">
                            <a href="/index">
                                <span class="headeruntertitel">Anmeldung für Abschluss- <br> und Seminararbeitsthemen</span>
                            </a>
                        </div>
                    </div>
                </div>         
            </div>
        </header>

        <!-- Obere Navigation -->          
        <nav class="navbereich" style="background-color: #3979b5"> 
            <a href="https://www.uni-goettingen.de/de/2165.html">Wiwi-Fakultät</a>
            <a href="/index">Informationsseite</a>
            <a href="/modul_uebersicht">Themenübersicht</a>
            <?php if (isset($_SESSION['login'])) { ?> 
                <a href='/logout'>logout</a>
            <?php } else { ?>
                <a href='/login'>Admin-Login</a> 
            <?php } ?>             
        </nav>

        <!-- CONTENT BEREICH -->
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="content">

