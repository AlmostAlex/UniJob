
<br>
<h4>Seminar- und Abschlussarbeiten</h4>
<uebersichtTags>
<!--<div class='suche'>-->
<ul class="tags">
<li><a style='<?php echo $search_s; ?>'> <?php echo $semester; ?> <delete onclick="r_semester();"><?php echo $x_s; ?></delete></a></li>
<li><a style='<?php echo $search_a; ?>'> <?php echo $art; ?> <delete onclick="r_art();"><?php echo $x_a; ?></delete></a></li>
<li><a style='<?php echo $search_b; ?>'> <?php echo $betreuer_anzeige; ?> <delete onclick="r_betreuer();"><?php echo $x_b; ?></delete></a></li>

<?php for ($i = 0; $i < count($tags_array); $i++) {?>
<li>
    <a style='<?php echo $display;?>'  style='<?php echo $search_f; ?>'> &nbsp; <?php echo $tags_array[$i]; ?> 
        <div style='float:right; <?php echo $display;?>' value='<?php echo $tags_array[$i];?>' id='remove'>&nbsp; x &nbsp;</div>
    </a>
</li>
<?php }?>
</ul>
<!--</div>-->
</uebersichtTags>
<br>
<div id="semester_f" class='modul_anzeige'>

<?php if(empty($module)){echo "Es wurden keine Module/Themen der Filterung entsprechend gefunden!";} ?>

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
                    <?php $themen = $this->modulUebersichtThemen($module[$k]['modul_id'],$abfrage_th); for ($p = 0; $p < count($themen); $p++) {?>   
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
                                            <?php echo $vorkenntnisse[$l]['bezeichnung']; }?> <br>
                                            <b>Hinweise:</b> <?php echo $module[$k]["hinweise"];?> <br>
                                            <b>Beschreibung:</b> <?php echo $themen[$p]["themenbeschreibung"];?> <br>
                                                    <br>
                                         
                                          <tags>
                                            <?php $tags = $this->modulUebersichtTags($themen[$p]['thema_id']); for ($y = 0; $y < count($tags); $y++) {?>   
                                                
                                                <div class="badge badge-primary" id='add_tf' value='<?php echo $tags[$y]['tag_bezeichnung'];?>'><?php echo $tags[$y]['tag_bezeichnung'];?></div> 
                                                           
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
               