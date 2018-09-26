
<?php //include(__DIR__."/../../../layout/head.php"); ?>
<!-- link rel="stylesheet" href="/css/modul_uebersicht.css">  
<link rel="stylesheet" href="/css/main.css"> -->
<br><br>

<h4>Seminar- und Abschlussarbeiten</h4>

<span class="<?php echo $search_s; ?>"><?php echo $semester; ?> <delete onclick="r_semester();"><?php echo $x_s; ?></delete></span>
<span  class="<?php echo $search_a; ?>"><?php echo $art; ?> <delete onclick="r_art();"><?php echo $x_a; ?></delete> </span>
<span  class="<?php echo $search_b; ?>"><?php echo $betreuer_anzeige; ?> <delete onclick="r_betreuer();"><?php echo $x_b; ?></delete> </span>

<?php for ($i = 0; $i < count($tags_array); $i++) {?>
    <span style='float:left;' class="<?php echo $search_f;?>"> &nbsp; <?php echo $tags_array[$i]; ?> 
    <div style='float:right; <?php echo $display;?>' value='<?php echo $tags_array[$i];?>' id='remove'>&nbsp; x &nbsp;</div>
    </span> 
<?php }?>
<div class='listprice' id='listprice'></div>
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