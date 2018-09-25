
<?php //include(__DIR__."/../../../layout/head.php"); ?>
<!-- link rel="stylesheet" href="/css/modul_uebersicht.css">  
<link rel="stylesheet" href="/css/main.css"> -->
<br><br>

<h4>Seminar- und Abschlussarbeiten</h4>

<span class="<?php echo $search_s; ?>"><?php echo $semester; ?> <delete onclick="r_semester();"><?php echo $x_s; ?></delete></span>
<span  class="<?php echo $search_a; ?>"><?php echo $art; ?> <delete onclick="r_art();"><?php echo $x_a; ?></delete> </span>
<span  class="<?php echo $search_b; ?>"><?php echo $betreuer_anzeige; ?> <delete onclick="r_betreuer();"><?php echo $x_b; ?></delete> </span>

<script>
$(".t").click(function(){
var test = true;
alert("test" + t); 
location.reload();
//$('#tags').multiselect('refresh');
//$('#tags option[value='t']').prop('selected', false);
//$("#semester option[value='']").prop("selected", true);

});
</script>

<?php for ($i = 0; $i < count($tags_array); $i++) {?>
    <span class="badge badge-info"><?php echo $tags_array[$i]; ?> <input id='t' name='t'  class='t' value='<?php echo $tags_array[$i];?>' onclick="getvalue(this)"> x </input> </span> 
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