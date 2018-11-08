<h2 style='margin-top: 20px;' class='card-title'>Übersicht der Seminar- / Abschlussarbeitsthemen</h2>
<div style='text-align: center'>
<div class='suche'>
    <filter>
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
            <div class='selectparent'>
            <select class='form-control' id='art' name='art2' onchange="filter();">
            <option value=""></option>
                <?php for($l = 0; $l < count($k_row); $l++){ ?>
                <option value='<?php echo $k_row[$l]['kategorie']; ?>'> <?php echo $k_row[$l]['kategorie'] .' ('. $k_row[$l]['anzahl'] .')'; ?> </option>
                <?php } ?>
            </select>
        </div>
        </td>
        <td>
            <div class='selectparent'>
                <select class='form-control' id='semester' name='semester2' onchange="filter();">
                    <option value=""></option>
                    <?php for($i = 0; $i < count($s_row); $i++){ ?>
                    <option value='<?php echo $s_row[$i]['semester']; ?>'> <?php echo $s_row[$i]['semester'] .' ('. $s_row[$i]['anzahl'] .')'; ?> </option>
                    <?php } ?>
                </select>
            </div>
        </td>
         <td>
            <div class='selectparent'>
                <select class='form-control' id='betreuer' name='betreuer' onchange="filter();">
                    <option value=""></option>
                    <?php for($j = 0; $j < count($b_row); $j++){ ?>
                    <option value='<?php echo $b_row[$j]['benutzer_id']; ?>'> <?php echo $b_row[$j]['benutzername'] .' ('. $b_row[$j]['anzahl'] .')'; ?> </option>
                    <?php } ?>
                </select>
            </div>
       </td>
       <td> <!-- data-selected-text-format="count > 2" -->
            <select class="selectpicker" title=""  data-size="5" style="width:auto;height: 10px;" data-live-search="true" id='tags' data-style="btn-primary" multiple data-max-options="10"  onchange="filter();">
                <?php for ($i = 0; $i < count($tagsBezFilter); $i++) { ?>
                    <option><?php echo $tagsBezFilter[$i]['tag_bezeichnung'];?></option>      
                <?php } ?>
            </select>   
        </td>
    </tr>
</table>
<filter>
</div>
</div>
</form>

    <div id="semester_f" class='modul_anzeige'>
<br><br>
<h4>Seminar- und Abschlussarbeiten</h4>

    <?php for($k = 0; $k < count($module); $k++){ ?>
        <div class='modul_text_<?php echo $module[$k]['kategorie']; ?>'>
            <?php echo $module[$k]['kategorie']; ?></div>
            <div class='modul_shadow_<?php echo $module[$k]['kategorie']; ?>'></div>
            <div class='modul_shadow_white'></div>
    <table class='modul_table_uebersicht_<?php echo $module[$k]['kategorie'];?>'>

            <tr>
                <th><a class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#modul_<?php echo $module[$k]['modul_id']; ?>' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></th>
                <th><b><titel style="line-height:15px;"><?php echo $module[$k]['nachrueckv_status']; ?> 
                <?php if($module[$k]["kategorie"] == "Seminararbeit"){
                                echo  $module[$k]["modulbezeichnung"];
                            } else {  echo  $module[$k]["professur"];} ?> 
                            </titel></b><br>
                            <?php if($module[$k]["kategorie"] == "Abschlussarbeit"){
                                ?><div class='border_round'><b><?php echo $module[$k]['abschlusstyp']; ?></b></div>
                            <?php } ?>
                    <div class='border_round'><b><?php echo $module[$k]['verfahren_anzeige']; ?></b></div>
                    <div class='border_round'><i class='far fa-calendar'></i> <b><?php echo $module[$k]['semester']; ?></b></div>
                    <div class='border_round'><i class='far fa-clock'></i> <b><?php echo $module[$k]['start_anzeige'] .' - '. $module[$k]['ende_anzeige']; ?> </b></div>
                </th>
                <th style="width:192px; height:85px">
                    <button align="center" style='color:white;' class="<?php echo $module[$k]['btn_form']?>">
                        <span>
                            <a align="center" style='color:white;'  <?php echo $module[$k]['state']; ?>>  
                                <?php echo $module[$k]['btn_msg']?>
                            </a>
                        </span>
                    </button></br>
                        <div style="margin-left:34px" class='border_round'><b><?php echo "Kickoff: ".$module[$k]['kickoff_anzeige']; ?> </b></div>
                </th></center>
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
                    <?php $themen = $this->modulUebersichtThemen($module[$k]['modul_id'],''); for ($p = 0; $p < count($themen); $p++) {?>   
                    <tr>
                        <td><a class='collapsed' id='coll' data-toggle='collapse' data-parent='#accordion' href='#inhalt_<?php echo $themen[$p]["thema_id"];?>' aria-expanded='true'><i class='fa' aria-hidden='true'></i></a></td>
                        <td><?php echo $themen[$p]["themenbezeichnung"];?> </td>
                        <td><center> <?php echo $themen[$p]["benutzer"];?></center></td>
                        <td><center><div class='<?php echo $themen[$p]["thema_verfuegbarkeit"];?>'.><?php echo $themen[$p]["thema_verfuegbarkeit"];?></div></center></td>
                    </tr>
                    <tr class='nopadding'>
                        <td class='nopadding' colspan='6'>
                            <div id='inhalt_<?php echo $themen[$p]["thema_id"];?>' class='collapse' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>
                                <div class='information_content'>
                                    <b class='information_titel'>Inhaltliche Informationen:</b><br>
                                        <div class='information_content_inhalt'> 
                                            <b>Bevorzugter Studiengang:</b>  <?php echo $module[$k]["studiengang"];?><br>
                                            <b>Empfohlenen Vorkenntnisse: </b>
                                            <?php $vorkenntnisse = $this->modulUebersichtVorkenntisse($themen[$p]['thema_id']); for ($l = 0; $l < count($vorkenntnisse); $l++) {?> 
                                            <?php  echo $vorkenntnisse[$l]['bezeichnung']; }?> <br>
                                            <b>Hinweise:</b> <?php echo $module[$k]["hinweise"];?> <br>
                                            <b>Beschreibung:</b> <?php echo $themen[$p]["themenbeschreibung"];?> <br>
                                             <br>             
                                          <tags>
                                            <?php $tags = $this->modulUebersichtTags($themen[$p]['thema_id']); for ($y = 0; $y < count($tags); $y++) {?>                                                 
                                                <a href="#" class="badge badge-primary"><?php echo $tags[$y]['tag_bezeichnung'];?></a>                                                           
                                            <?php }?>
                                             </tags>         
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
