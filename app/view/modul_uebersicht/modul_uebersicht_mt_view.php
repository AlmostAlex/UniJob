
<?php //include(__DIR__."/../../../layout/head.php"); ?>
<!-- link rel="stylesheet" href="/css/modul_uebersicht.css">  
<link rel="stylesheet" href="/css/main.css"> -->

  <!-- TAGS -->
        <head>     
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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
</head>  


<br><br>
<h4>Seminar- und Abschlussarbeiten</h4>

<span class="badge badge-info"><?php echo $semester; ?> </span>
<span class="badge badge-info"><?php echo $art; ?> <delete onclick="r_art();">x</delete> </span>
<span class="badge badge-info"><?php echo $betreuer_anzeige; ?></span>


<?php for ($i = 0; $i < count($tags_array); $i++) {?>
    <span class="badge badge-info"><?php echo $tags_array[$i]; ?></span> 
<?php }?>

<br><br>
modul abfrage: <br>
<?php echo $abfrage_modul;?>
<br><br>
thema abfrage:<br>
<?php echo $abfrage_th;?>

<br><br>
<?php for ($i = 0; $i < count($module); $i++) {?>
<?php echo 'Modul:'. $module[$i]["modul_id"]  ?> <br>

<!--/* $themen = $this->modulUebersichtThemen($module[$k]['modul_id']); for ($p = 0; $p < count($themen); $p++) {?>   

}
               


<?php } ?>