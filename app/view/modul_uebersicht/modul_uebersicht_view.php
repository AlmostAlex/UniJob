

<script>
function r_art(){
//$("#art").find("option[value='']").attr('selected', true);
$("#art option[value='']").prop("selected", true);
filter();
} 
function r_betreuer(){
//$("#betreuer").find("option[value='']").attr('selected', true);
$("#betreuer option[value='']").prop("selected", true);
filter();
} 
function r_semester(){
//$("#semester").find("option[value='']").attr('selected', true);
$("#semester option[value='']").prop("selected", true);
filter();
}

$(document).on("click", '#remove', function(a) {
  var tag = this.getAttribute("value");
  var values = $('#tags').val();

  $('#tags').selectpicker('deselectAll');
  $('#tags').selectpicker('val', values.filter(function(e) {return e !== tag }));
  $('#tags').selectpicker('refresh');
});


</script>


<h2 style='margin-top: 20px;' class='card-title'>Übersicht der Seminar- / Abschlussarbeitsthemen</h2>
<div style='text-align: center'>
<div class='suche'>
<table>
<tr>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Art</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Semester</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Betreuer</b></th>
<th style='width: 20%; padding-right:2%;' class='tg-py0s'><b>Tags</b></th>
</tr>

<form method="post" action="">
    <tr>
        <td>
            <select class='form-control' id='art' name='art2' onchange="filter();">
            <option value=""></option>
                <?php for($l = 0; $l < count($k_row); $l++){ ?>
                <option value='<?php echo $k_row[$l]['kategorie']; ?>'> <?php echo $k_row[$l]['kategorie'] .' ('. $k_row[$l]['anzahl'] .')'; ?> </option>
                <?php } ?>
            </select>

        </td>
        <td>
            <select class='form-control' id='semester' name='semester2' onchange="filter();">
                <option value=""></option>
                <?php for($i = 0; $i < count($s_row); $i++){ ?>
                <option value='<?php echo $s_row[$i]['semester']; ?>'> <?php echo $s_row[$i]['semester'] .' ('. $s_row[$i]['anzahl'] .')'; ?> </option>
                <?php } ?>
            </select>
        </td>
         <td>
            <select class='form-control' id='betreuer' name='betreuer' onchange="filter();">
                <option value=""></option>
                <?php for($j = 0; $j < count($b_row); $j++){ ?>
                <option value='<?php echo $b_row[$j]['benutzer_id']; ?>'> <?php echo $b_row[$j]['benutzername'] .' ('. $b_row[$j]['anzahl'] .')'; ?> </option>
                <?php } ?>
            </select>
       </td>
       <td> <!-- data-selected-text-format="count > 2" -->


    <select class="selectpicker" title=""  style="width:auto;" data-live-search="true" id='tags' data-style="btn-primary" multiple data-max-options="10"  onchange="filter();">
      <option>PHP</option>
      <option>CSS</option>
      <option>HTML</option>
      <option>CSS 3</option>
      <option>Bootstrap</option>
      <option>JavaScript</option>
</select>
</td>
</tr>
</table>
</div>
</div>
</form>

    <div id="semester_f" class='modul_anzeige'>
<br><br>
<h4>Seminar- und Abschlussarbeiten</h4>

    <?php for($k = 0; $k < count($module); $k++){ ?>
        <div style='width: 100px; height:20px; background-color: #3979b5; font-size: 12px; margin-bottom: -3px; color: white;text-align: center;'><?php echo $module[$k]['kategorie']; ?></div>
        <table class='modul_table_uebersicht'>
            <tr>
                <th><a class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#modul_<?php echo $module[$k]['modul_id']; ?>' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></th>
                <th><b><titel><?php echo $module[$k]['nachrueckv_status']; ?> <?php echo $module[$k]['modulbezeichnung']; ?></titel></b><br>
                    <div class='border_round'><b><?php echo $module[$k]['kategorie']; ?></b></div>
                    <div class='border_round'><b><?php echo $module[$k]['verfahren_anzeige']; ?></b></div>
                    <div class='border_round'><i class='far fa-calendar'></i> <b><?php echo $module[$k]['semester']; ?></b></div>
                    <div class='border_round'><i class='far fa-clock'></i> <b><?php echo $module[$k]['start_anzeige'] .' - '. $module[$k]['ende_anzeige']; ?> </b></div>
                </th>
                <th><button class="<?php echo $module[$k]['btn_form']?>"><span><?php echo $module[$k]['btn_msg']?></span></button></th>
            </tr>
        </table>
        <inside>
            <div id='modul_<?php echo $module[$k]['modul_id']; ?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                <table class='th_table'>
                    <tr>
                        <th style='width:5%' class='bold_title'><center>Info</center></th>
                        <th style='width:75%' class='bold_title'><center>Titel</center></th>
                        <th style='width:15%' class='bold_title'><center>Betreuer</center></th>
                        <th style='width:20%' class='bold_title'><center>Verfügbarkeit</center></th>
                    </tr>
                    <?php $themen = $this->modulUebersichtThemen($module[$k]['modul_id']); for ($p = 0; $p < count($themen); $p++) {?>   
                    <tr>
                        <td><a class='collapsed' id='coll' data-toggle='collapse' data-parent='#accordion' href='#inhalt_<?php echo $themen[$p]["thema_id"];?>' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></td>
                        <td><?php echo $themen[$p]["themenbezeichnung"];?> </td>
                        <td><center>{$this->benutzer->getDozent($benutzer_id)}</center></td>
                        <td><center><div $vergeben><?php echo $themen[$p]["thema_verfuegbarkeit"];?></div></center></td>
                    </tr>
                    <tr class='nopadding'>
                        <td class='nopadding' colspan='6'>
                            <div id='inhalt_<?php echo $themen[$p]["thema_id"];?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                                <div class='information_content'>
                                    <b class='information_titel'>Inhaltliche Informationen:</b><br>
                                        <div class='information_content_inhalt'> <b>Bevorzugter Studiengang:</b> {$studiengang}<br>
                                            <b>Beschreibung:</b> <?php echo $themen[$p]["themenbeschreibung"];?>
                                        </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </inside><br>
    <?php } ?>
    </div>
