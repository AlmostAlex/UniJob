<?php session_start();?>
<html>
    <head>
        <title>Georg-August-Universität Göttingen</title>         
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/layout.css"> 
        <link rel="stylesheet" href="/css/main.css">  
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css"> 
        <link rel="stylesheet" href="/css/modul_verwaltung.css"> 
        <link rel="stylesheet" href="/css/modul_uebersicht.css"> 
        <!-- Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
                               
        <!-- TAGS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        
        <!-- DATEPICKER -->         
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Pop-over-->  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>   

        <!-- JS -->                 
        <script src="/js/datepicker.js"></script>
        <script src="/js/modul.js"></script>
        <script src="/js/modul_verwaltung.js"></script>

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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

