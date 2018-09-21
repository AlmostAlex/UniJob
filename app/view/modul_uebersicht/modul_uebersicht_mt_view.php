
<?php //include(__DIR__."/../../../layout/head.php"); ?>
<!-- link rel="stylesheet" href="/css/modul_uebersicht.css">  
<link rel="stylesheet" href="/css/main.css"> -->
<br><br>

<style>
#r_s, #r_a,#r_b{
    display:none;
}

</style>
<h4>Seminar- und Abschlussarbeiten</h4>

<span id='r_s' class="badge badge-info"><?php echo $semester; ?> <delete onclick="r_semester();">x</delete> </span>
<span id='r_a'  class="badge badge-info"><?php echo $art; ?> <delete onclick="r_art();">x</delete> </span>
<span id='r_b' class="badge badge-info"><?php echo $betreuer_anzeige; ?> <delete onclick="r_betreuer();">x</delete> </span>


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