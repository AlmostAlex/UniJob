
<?php //include(__DIR__."/../../../layout/head.php"); ?>
<link rel="stylesheet" href="/css/modul_uebersicht.css">  
<link rel="stylesheet" href="/css/main.css">
<br><br>
<h4>Seminar- und Abschlussarbeiten</h4>
<span class="badge badge-info"><?php echo $semester; ?></span>
<span class="badge badge-info"><?php echo $art; ?></span>
<span class="badge badge-info"><?php echo $betreuer_anzeige; ?></span>

<?php for ($i = 0; $i < count($tags_array); $i++) {?>
    <span class="badge badge-info"><?php echo $tags_array[$i]; ?></span> 
<?php }?>

<br><br>
Komplett: <br><br>

<?php echo $abfrage_all;?>